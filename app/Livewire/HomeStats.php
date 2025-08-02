<?php

namespace App\Livewire;

use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\User;
use Livewire\Component;

class HomeStats extends Component
{

    public $devs_count = 0;
    public $recruiters_count = 0;
    public $jobs_count = 0;
    public $accepted_apps_count = 0;

    public function mount()
    {
        $this->devs_count = User::where('role', 'developer')->count();
        $this->recruiters_count = User::where('role', 'recruiter')->count();
        $this->jobs_count = JobListing::where('is_disclosed', 0)->count();
        $this->accepted_apps_count = JobApplication::where('status', 'accepted')->count();
    }
    public function render()
    {
        return view('livewire.home-stats');
    }
}
