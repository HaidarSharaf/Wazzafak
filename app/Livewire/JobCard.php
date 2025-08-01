<?php

namespace App\Livewire;

use App\Models\JobListing;
use App\Models\User;
use Livewire\Component;

class JobCard extends Component
{
    public ?JobListing $job_listing;

    public ?User $user;

    public function mount(JobListing $job_listing)
    {
        $this->job_listing = $job_listing;
        $this->user = User::where('id', $this->job_listing->user_id)->first();
    }

    public function render()
    {
        return view('livewire.job-card');
    }
}
