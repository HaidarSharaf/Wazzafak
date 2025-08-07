<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Job Applications | Wazzafak')]
class AppliedJobs extends Component
{
    Use WithPagination;

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
            ->when($this->app_date === 'this_week', function ($query) {
                $query->whereBetween('job_applications.created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek(),
                ]);
            })
            ->when($this->app_date === 'this_month', function ($query) {
                $query->whereBetween('job_applications.created_at', [
                    now()->startOfMonth(),
                    now()->endOfMonth(),
                ]);
            })
            ->paginate(6);
    }

    public function resetFilters()
    {
        $this->reset([
            'status',
            'app_date',
        ]);
        $this->resetPage(pageName: 'applications');
    }

    public function render()
    {
        return view('livewire.applied-jobs', [
            'applied_jobs' => $this->getAppliedJobs()
        ]);
    }
}
