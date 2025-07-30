<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Edit Job | Wazzafak')]
class EditJobs extends Component
{
    public function render()
    {
        return view('livewire.edit-jobs');
    }
}
