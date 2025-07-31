<?php

namespace App\Livewire;

use App\Models\JobListing;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Job Details | Wazzafak')]
class JobDetails extends Component
{
    public ?JobListing $job_listing;
    public ?User $user;

    public function mount(JobListing $job_listing){
        $this->job_listing = $job_listing;
        $this->user = User::where('id', $this->job_listing->user_id)->first();
    }

    public function acceptJob()
    {
        // Logic to handle job acceptance
        // This could involve updating the job listing status, notifying the user, etc.
        session()->flash('message', 'Job accepted successfully!');
    }

    public function rejectJob()
    {
        // Logic to handle job rejection
        // This could involve updating the job listing status, notifying the user, etc.
        session()->flash('message', 'Job rejected successfully!');
    }

    public function deleteJob()
    {
        // Logic to handle job rejection
        // This could involve updating the job listing status, notifying the user, etc.
        session()->flash('message', 'Job rejected successfully!');
    }

    public function applyForJob()
    {
        // Logic to handle job application
        // This could involve creating an application record, sending notifications, etc.
        session()->flash('message', 'Application submitted successfully!');
    }

    public function discloseJob()
    {
        // Logic to handle job application
        // This could involve creating an application record, sending notifications, etc.
        session()->flash('message', 'Application submitted successfully!');
    }

    public function render()
    {
        return view('livewire.job-details');
    }
}
