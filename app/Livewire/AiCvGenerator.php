<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('AI CV Generator | Wazzafak')]
class AiCvGenerator extends Component
{
    public function render()
    {
        return view('livewire.ai-cv-generator');
    }
}
