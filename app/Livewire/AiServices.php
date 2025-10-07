<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('AI Services | Wazzafak')]
class AiServices extends Component
{
    public function render()
    {
        return view('livewire.ai-services');
    }
}
