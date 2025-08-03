<?php

namespace App\Livewire;

use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\User;
use App\Notifications\JobRejection;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Job Details | Wazzafak')]
class JobDetails extends Component
{

    public ?JobListing $job_listing;
    public ?User $user;
    public $rejection_message = '';

    public function mount(JobListing $job_listing){
        $this->job_listing = $job_listing;
        $this->user = User::where('id', $this->job_listing->user_id)->first();
    }

    public function hasUserApplied()
    {
        return auth()->user()
            ->appliedJobs()
            ->where('job_listing_id', $this->job_listing->id)
            ->exists();
    }

    public function isUserAccepted()
    {
        return auth()->user()
            ->appliedJobs()
            ->where('job_listing_id', $this->job_listing->id)
            ->where('job_applications.status', 'Accepted')
            ->exists();
    }

    public function isUserRejected()
    {
        return auth()->user()
            ->appliedJobs()
            ->where('job_listing_id', $this->job_listing->id)
            ->where('job_applications.status', 'Rejected')
            ->exists();
    }


    public function acceptJob()
    {
        $this->authorize('accept-job-listing', $this->job_listing);

        $this->job_listing->update([
            'status' => 'Accepted'
        ]);

        session()->flash('message', 'Job accepted successfully!');
    }

    public function rejectJob()
    {
        $this->authorize('reject-job-listing', $this->job_listing);

        $this->validate([
            'rejection_message' => 'required|string',
        ]);

        $this->job_listing->update([
            'status' => 'Rejected',
            'rejection_message' => $this->rejection_message
        ]);

        $this->user->notify(new JobRejection($this->rejection_message, $this->job_listing));

        session()->flash('message', 'Job rejected successfully!');
    }

    public function applyForJob()
    {
        $this->authorize('apply-for-job', $this->job_listing);

        JobApplication::create([
            'job_listing_id' => $this->job_listing->id,
            'user_id' => auth()->id(),
            'status' => 'Pending'
        ]);

        session()->flash('message', 'Application submitted successfully!');
    }

    #[On('discloseJob')]
    public function discloseJob($acceptedApplicationId = null)
    {
        $this->authorize('disclose-job-listing', $this->job_listing);

        $this->job_listing->update([
            'is_disclosed' => true
        ]);

        $query = $this->job_listing->jobApplications()
            ->where('status', '!=', 'Rejected');

        if ($acceptedApplicationId) {
            $query->where('id', '!=', $acceptedApplicationId);
        }

        $query->update([
            'status' => 'Rejected'
        ]);

        $this->job_listing = $this->job_listing->fresh();

        $this->dispatch('appsUpdated');

        session()->flash('message', 'Job disclosed.');
    }

    public function render()
    {
        return view('livewire.job-details');
    }
}
