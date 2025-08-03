<?php

namespace App\Livewire;

use App\Models\JobListing;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class JobApplicants extends Component
{
    public ?JobListing $job_listing;
    public $applications = [];

    public function mount($job_listing)
    {
        $this->job_listing = $job_listing;
        $this->loadApps();
    }

    #[On('appsUpdated')]
    public function loadApps(){
        $this->applications = $this->job_listing->jobApplications()
            ->orderByRaw("CASE
                WHEN status = 'Accepted' THEN 1
                WHEN status = 'Pending' THEN 2
                WHEN status = 'Rejected' THEN 3
                ELSE 4
            END")
            ->orderBy('created_at', 'desc')
            ->get();
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

        $this->loadApps();

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

        $this->loadApps();

        session()->flash('message', 'Application rejected.');
    }

    public function render()
    {
        return view('livewire.job-applicants');
    }
}
