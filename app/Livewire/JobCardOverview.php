<?php

namespace App\Livewire;

use App\Models\JobListing;
use App\Models\User;
use Livewire\Component;

class JobCardOverview extends Component
{
    public ?JobListing $job_listing;
    public ?User $user;
    public $admin_page = false;

    public function mount(JobListing $job_listing)
    {
        $this->job_listing = $job_listing;
        $this->user = auth()->user();
    }

    public function hasUserApplied()
    {
        return auth()->user()
            ->appliedJobs()
            ->where('job_listing_id', $this->job_listing->id)
            ->exists();
    }

    public function render()
    {
        return view('livewire.job-card-overview');
    }
}
