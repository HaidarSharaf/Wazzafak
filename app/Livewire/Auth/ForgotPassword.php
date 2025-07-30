<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Forgot Password | Wazzafak')]
class ForgotPassword extends Component
{
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate(
            [
                'email' => ['required', 'string', 'email', 'exists:users,email'],
            ],
            [
                'email.exists' => __('We can’t find a user with the given email address in our records.'),
            ]
        );

        try{
            Password::sendResetLink($this->only('email'));
            session()->flash('status', __('A reset link will be sent to your email address.'));
        } catch (\Exception $e){
            session()->flash('error', __('An error occurred while sending the reset link. Please try again later.'));
        }
        $this->reset('email');
    }
    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
