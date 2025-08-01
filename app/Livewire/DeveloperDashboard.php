<?php

namespace App\Livewire;

use App\Models\JobListing;
use App\Models\User;
use Livewire\Component;

class DeveloperDashboard extends Component
{
    public ?User $user;
    public $active_apps = 0;
    public $accepted_apps = 0;
    public $featured_jobs = [];


    public function mount()
    {
        $this->user = auth()->user();
        $this->active_apps = $this->user->jobApplications()->where('status', 'Pending')->count();
        $this->accepted_apps = $this->user->jobApplications()->where('status', 'Accepted')->count();
        $this->featured_jobs = JobListing::query()
            ->where('status', 'Accepted')
            ->where(function ($query) {
                $developer = $this->user->developer;
                $userStackIds = $this->user->stacks->pluck('id')->toArray();
                $userTechIds = $this->user->technologies->pluck('id')->toArray();

                $query->whereRaw('1 = 0');

                if ($developer && $developer->experience_level) {
                    $query->orWhere('experience', $developer->experience_level);
                }

                if (!empty($userStackIds)) {
                    $query->orWhereIn('stack_id', $userStackIds);
                }

                if (!empty($userTechIds)) {
                    $query->orWhereHas('technologies', function($q) use ($userTechIds) {
                        $q->whereIn('technology_id', $userTechIds);
                    });
                }
            })
            ->get();
    }

    public function render()
    {
        return view('livewire.developer-dashboard');
    }
}
