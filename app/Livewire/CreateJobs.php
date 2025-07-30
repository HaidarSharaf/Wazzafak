<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create a Job | Wazzafak')]
class CreateJobs extends Component
{

    public function create(){

    }

    public function render()
    {
        return view('livewire.create-jobs');
    }
}
