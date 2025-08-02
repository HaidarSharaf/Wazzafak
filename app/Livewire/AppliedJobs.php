<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('Job Applications | Wazzafak')]
class AppliedJobs extends Component
{
    #[Url(as: 's', except: '')]
    public $status = '';

    #[Url(as: 'd', except: '')]
    public $app_date = '';

    public $statuses = ['Pending', 'Accepted', 'Rejected'];


    public function getAppliedJobs(){
        return auth()->user()->appliedJobs()
            ->orderBy('job_applications.created_at', 'desc')
                ->when($this->status, function ($query) {
                    return $query->where('job_applications.status', $this->status);
                })
                ->when($this->app_date, function ($query) {
                    if ($this->app_date === 'this_week') {
                        return $query->whereBetween('job_applications.created_at', [
                            now()->startOfWeek(),
                            now()->endOfWeek(),
                        ]);
                    } elseif ($this->app_date === 'this_month') {
                        return $query->whereBetween('job_applications.created_at', [
                            now()->startOfMonth(),
                            now()->endOfMonth(),
                        ]);
                    }
                })
                ->get();
    }

    public function resetFilters()
    {
        $this->status = '';
        $this->app_date = '';
    }

    public function render()
    {
        return view('livewire.applied-jobs', [
            'applied_jobs' => $this->getAppliedJobs()
        ]);
    }
}
