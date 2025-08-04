<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Posted Jobs | Wazzafak')]
class PostedJobs extends Component
{
    Use WithPagination;

    #[Url(as: 's', except: '')]
    public $status = '';

    #[Url(as: 'd', except: '')]
    public $app_date = '';

    public $statuses = ['Pending', 'Accepted', 'Rejected'];

    public function getPostedJobs()
    {
        return auth()->user()->jobListings()
            ->orderBy('created_at', 'desc')
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->when($this->app_date === 'this_week', function ($query) {
                $query->whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek(),
                ]);
            })
            ->when($this->app_date === 'this_month', function ($query) {
                $query->whereBetween('created_at', [
                    now()->startOfMonth(),
                    now()->endOfMonth(),
                ]);
            })
            ->paginate(6);
    }

    public function resetFilters()
    {
        $this->reset(['status', 'app_date']);
        $this->resetPage(pageName: 'posted-jobs');
    }

    public function render()
    {
        return view('livewire.posted-jobs', [
            'posted_jobs' => $this->getPostedJobs(),
        ]);
    }
}
