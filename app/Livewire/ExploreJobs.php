<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Explore Jobs | Wazzafak')]
class ExploreJobs extends Component
{
    public function render()
    {
        return view('livewire.explore-jobs');
    }
}
