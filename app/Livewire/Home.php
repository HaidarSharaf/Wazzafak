<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home | Wazzafak')]
class Home extends Component
{
    public ?User $user = null;

    public function mount()
    {
        if(auth()->check()) {
            $this->user = auth()->user();
        }
    }

    public function render()
    {
        return view('livewire.home');
    }
}
