<?php

namespace App\Livewire\Admin;

use App\Models\JobListing;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Manage Jobs | Byte Zone')]
class ManageJobPosts extends Component
{
    public function loadPendingJobs(){
        return JobListing::where('status', 'Pending')->paginate(6);
    }

    public function render()
    {
        return view('livewire.admin.manage-job-posts', [
            'pending_jobs' => $this->loadPendingJobs()
        ]);
    }
}
