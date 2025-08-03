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
    public $pending_jobs = [];

    public function mount(){
        $this->pending_jobs = JobListing::where('status', 'Pending')->get();
    }

    public function render()
    {
        return view('livewire.admin.manage-job-posts');
    }
}
