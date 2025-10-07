<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Job Applications | Wazzafak')]
class Applications extends Component
{
    Use WithPagination;

    #[Url(as: 's', except: '')]
    public $status = '';

    #[Url(as: 'd', except: '')]
    public $app_date = '';

    public User $user;

    public $statuses = ['Pending', 'Accepted', 'Rejected'];

    public function mount(){
        $this->user = auth()->user();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['status', 'app_date'])) {
            $this->resetPage();
        }
    }

    public function getAppliedJobs(){
        return $this->user->appliedJobs()
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
        $this->status = '';
        $this->app_date = '';
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.applications', [
            'applied_jobs' => $this->getAppliedJobs()
        ]);
    }
}
