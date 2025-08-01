<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Navbar extends Component
{
    public User $user;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function logout()
    {
        auth()->logout();
        $this->redirect(route('login'), navigate: true);
    }
    public function render()
    {
        return view('livewire.navbar');
    }
}
