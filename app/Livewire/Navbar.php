<?php

namespace App\Livewire;

use Livewire\Component;

class Navbar extends Component
{

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
