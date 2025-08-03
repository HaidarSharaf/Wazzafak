<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Admin Dashboard | Byte Zone')]
class AdminDashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.admin-dashboard');
    }
}
