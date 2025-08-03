<?php

namespace App\Livewire\Admin;

use App\Models\JobListing;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Manage Job | Byte Zone')]
class ManageJob extends Component
{
    public ?JobListing $job_listing;
    public ?User $user;
    public $rejection_message = '';

    public function mount(JobListing $job_listing){
        $this->job_listing = $job_listing;
        $this->user = User::where('id', $this->job_listing->user_id)->first();
    }



    public function render()
    {
        return view('livewire.admin.manage-job');
    }
}
