<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class AdminSidebar extends Component
{
    public ?User $user;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.admin.admin-sidebar');
    }
}
