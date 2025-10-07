<?php

namespace App\Livewire;

use App\Models\JobListing;
use App\Models\User;
use App\Services\AIService;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Smalot\PdfParser\Parser;

class JobApplicants extends Component
{
    Use WithPagination;

    public ?JobListing $job_listing;

    public $aiRecommendation = null;
    public $analyzingCVs = false;
    public $analysisError = null;

    public function mount($job_listing)
    {
        $this->job_listing = $job_listing;
    }

    #[On('appsUpdated')]
    public function loadApps(){
        return $this->job_listing->jobApplications()
            ->orderByRaw("CASE
                WHEN status = 'Accepted' THEN 1
                WHEN status = 'Pending' THEN 2
                WHEN status = 'Rejected' THEN 3
                ELSE 4
            END")
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getPendingApplicationsCount() : int
    {
        return $this->job_listing->jobApplications()
            ->where('status', 'Pending')
            ->count();
    }

    public function analyzeCVsWithAI()
    {
        $this->analyzingCVs = true;
        $this->analysisError = null;

        try {
            $pendingApplications = $this->job_listing->jobApplications()->where('status', 'Pending')->get();

            if ($pendingApplications->count() < 2) {
                throw new \Exception('At least 2 pending applications are required for AI analysis.');
            }

            $cvData = [];
            $parser = new Parser();

            foreach ($pendingApplications as $application) {
                $user = $application->user;
                $developer = $user->developer;

                $cvPath = storage_path('app/public/dev_cvs/' . $developer->cv);

                try {
                    $pdf = $parser->parseFile($cvPath);
                    $cvText = $pdf->getText();
                } catch (\Exception $e) {
                    logger()->error('CV Parsing Error', [
                        'user_id' => $user->id,
                        'error' => $e->getMessage()
                    ]);
                    continue;
                }

                $cvData[] = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'experience' => $application->getApplicantExperienceAttribute(),
                    'stacks' => $application->getApplicantStacksAttribute()->pluck('name')->toArray(),
                    'technologies' => $application->getApplicantTechnologiesAttribute()->pluck('name')->toArray(),
                    'cv_text' => substr($cvText, 0, 3000), // Limit to avoid token limits
                ];
            }

            if (count($cvData) < 2) {
                throw new \Exception('Not enough valid CVs to analyze.');
            }

            // Prepare job requirements
            $jobRequirements = [
                'stack' => $this->job_listing->getStackNameAttribute(),
                'experience' => $this->job_listing->experience,
                'technologies' => $this->job_listing->technologies->pluck('name')->toArray(),
                'salary' => $this->job_listing->salary,
            ];

            // Get AI recommendation
            $aiService = new AIService();
            $this->aiRecommendation = $aiService->analyzeCVsForJob($cvData, $jobRequirements);

        } catch (\Exception $e) {
            $this->analysisError = $e->getMessage();
            logger()->error('CV Analysis Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        } finally {
            $this->analyzingCVs = false;
        }
    }

    public function downloadCV($id)
    {
        $user = User::find($id);
        if (!$user) {
            return;
        }
        $cv_file = $user->developer?->cv;
        if (!$cv_file) {
            return;
        }
        return response()->download(storage_path("app/public/dev_cvs/{$cv_file}"), $user->name . '_CV.pdf');
    }

    public function acceptApplicant($applicationId)
    {
        $this->authorize('manage-job-applicants', $this->job_listing);

        $application = $this->job_listing->jobApplications()->find($applicationId);

        if (!$application) {
            session()->flash('error', 'Application not found.');
            return;
        }

        $application->update([
            'status' => 'Accepted'
        ]);

        $this->dispatch('discloseJob', acceptedApplicationId: $applicationId);

        session()->flash('message', 'Application accepted. Job disclosed.');
    }

    public function rejectApplicant($applicationId)
    {
        $this->authorize('manage-job-applicants', $this->job_listing);

        $application = $this->job_listing->jobApplications()->find($applicationId);

        if (!$application) {
            session()->flash('error', 'Application not found.');
            return;
        }

        $application->update([
            'status' => 'Rejected'
        ]);

        if ($this->aiRecommendation && $this->aiRecommendation['best_applicant_id'] == $applicationId) {
            $this->aiRecommendation = null;
        }

        session()->flash('message', 'Application rejected.');
    }

    public function render()
    {
        return view('livewire.job-applicants', [
            'applications' => $this->loadApps()
        ]);
    }
}
