<?php

namespace App\Livewire;

use App\Models\JobApplication;
use App\Models\User;
use Livewire\Component;

class RecruiterDashboard extends Component
{
    public ?User $user;
    public $active_jobs = 0;
    public $pending_applications = 0;
    public $developers_hired = 0;

    public $jobs_performance = [];


    public function mount(){
        $this->user = auth()->user();
        $this->active_jobs = $this->user->jobListings()->where('status', 'Accepted')->where('is_disclosed', 0)->count();
        $this->pending_applications = JobApplication::whereHas('jobListing', fn ($query) => $query->where('user_id', $this->user->id))
            ->where('status', 'Pending')->count();
        $this->developers_hired = JobApplication::whereHas('jobListing', fn ($query) => $query->where('user_id', $this->user->id))
            ->where('status', 'Accepted')->count();
        $this->jobs_performance = $this->user->jobListings()
            ->where('status', 'Accepted')
            ->where('is_disclosed', 0)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.recruiter-dashboard');
    }
}
