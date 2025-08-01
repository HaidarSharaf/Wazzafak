<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Job Applications | Wazzafak')]
class AppliedJobs extends Component
{
    public $applied_jobs = [];

    public function mount(){
//        $this->applied_jobs = auth()->user()->appliedJobs()->with('jobListing')->get();
    }

    public function render()
    {
        return view('livewire.applied-jobs');
    }
}
