<?php

namespace App\Livewire;

use App\Models\JobListing;
use App\Models\User;
use App\Notifications\ApplicationAcceptance;
use App\Services\AIService;
use App\Services\ZoomService;
use App\Traits\Notifications;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Mockery\Exception;
use Smalot\PdfParser\Parser;

class JobApplicants extends Component
{
    Use WithPagination;
    use Notifications;

    public ?JobListing $job_listing;

    public $aiRecommendation = null;
    public $analyzingCVs = false;
    public $analysisError = null;

    public $interview_location = 'online_meeting';
    public $rejectOthers = true;

    public $interview_date = null;
    public $interview_time = null;

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
                    'cv_text' => substr($cvText, 0, 3000),
                ];
            }

            if (count($cvData) < 2) {
                throw new \Exception('Not enough valid CVs to analyze.');
            }

            $jobRequirements = [
                'stack' => $this->job_listing->getStackNameAttribute(),
                'experience' => $this->job_listing->experience,
                'technologies' => $this->job_listing->technologies->pluck('name')->toArray(),
                'salary' => $this->job_listing->salary,
            ];

            $aiService = new AIService();
            $this->aiRecommendation = $aiService->analyzeCVsForJob($cvData, $jobRequirements);

        } catch (\Exception $e) {
            $this->analysisError = $e->getMessage();
            $this->notify(
                variant: 'danger',
                title: 'CV Analysis Error',
                message: $e->getMessage()
            );
        } finally {
            $this->analyzingCVs = false;
        }
    }

    public function downloadCV($id)
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }
        $cv_file = $user->developer?->cv;
        if (!$cv_file) {
            return null;
        }
        return response()->download(storage_path("app/public/dev_cvs/{$cv_file}"), $user->name . '_CV.pdf');

    }

    public function acceptApplicant($applicationId)
    {
        $this->authorize('manage-job-applicants', $this->job_listing);

        $this->validate([
            'interview_location' => 'required|in:online_meeting,in_person',
            'interview_date' => 'required|date|after_or_equal:today',
            'interview_time' => 'required'
        ], [
            'interview_date.required' => 'Please select an interview date.',
            'interview_date.after_or_equal' => 'Interview date must be today or in the future.',
            'interview_time.required' => 'Please select an interview time.',
        ]);

        $application = $this->job_listing->jobApplications()->find($applicationId);

        if (!$application) {
            $this->notify(
                variant: 'danger',
                title: 'Error',
                message: 'Application not found.'
            );
            return;
        }

        try {
            $recruiter_user = auth()->user();
            $interviewDateTime = Carbon::parse($this->interview_date . ' ' . $this->interview_time);

            $zoomMeetingData = null;

            if ($this->interview_location === 'online_meeting') {
                $zoomService = new ZoomService();

                $topic = "Interview for {$this->job_listing->getStackNameAttribute()} Position - {$application->user->name}";

                $recruiterEmail = $recruiter_user->email;

                $zoomMeetingData = $zoomService->createMeeting(
                    $topic,
                    $interviewDateTime,
                );
            }

            $application->update([
                'status' => 'Accepted'
            ]);

            $applicant = $application->user;

            $applicant->notify(new ApplicationAcceptance(
                $applicant->name,
                $this->job_listing,
                $interviewDateTime,
                $this->interview_location,
                $zoomMeetingData
            ));

            $recruiter_user->notify(new ApplicationAcceptance(
                $recruiter_user->name,
                $this->job_listing,
                $interviewDateTime,
                $this->interview_location,
                $zoomMeetingData,
                $applicant->name,
                true
            ));

            $this->notify(
                variant: 'success',
                title: 'Application Accepted',
                message: "Interview scheduled with {$application->user->name}." .
                ($this->rejectOthers ? " All other applications were rejected and the job post was disclosed." : "")
            );

            if($this->rejectOthers){
                $this->dispatch('discloseJob', acceptedApplicationId: $applicationId);
            }

            $this->reset(['interview_date', 'interview_time', 'interview_location', 'rejectOthers']);

        } catch (Exception $e){
            $this->notify(
                variant: 'danger',
                title: 'Error',
                message: 'Failed to schedule interview. Please try again. ' . $e->getMessage()
            );
        }
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

        $this->notify(
            variant: 'success',
            title: 'Application Rejected',
            message: "You have rejected {$application->user->name}'s application."
        );

        if ($this->aiRecommendation && $this->aiRecommendation['best_applicant_id'] == $applicationId) {
            $this->aiRecommendation = null;
        }
    }

    public function render()
    {
        return view('livewire.job-applicants', [
            'applications' => $this->loadApps()
        ]);
    }
}
