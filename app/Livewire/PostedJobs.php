<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Posted Jobs | Wazzafak')]
class PostedJobs extends Component
{
    public $posted_jobs = [];

    public function mount(){
        $this->posted_jobs = auth()->user()->jobListings()->get();
    }


    public function render()
    {
        return view('livewire.posted-jobs');
    }
}
