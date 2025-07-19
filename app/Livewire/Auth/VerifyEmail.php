<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Notifications\EmailVerification;
use Exception;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class VerifyEmail extends Component
{
    #[Validate('required|digits:6|numeric')]
    public $otp = '';

    public $email = '';

    public ?User $user;

    public bool $valid = true;

    public function mount(){
        $this->user = Auth::user();

        $this->email = $this->user->email;

        if($this->user->email_verified_at){
            $this->redirect(route('home'), navigate: true);
            return;
        }

        if(!$this->user->otp_code || !$this->user->otp_expires_at || !$this->user->otp_sent_at || $this->expiredOtp()) {
            $this->sendOtp();
        }
    }

    public function sendOtp()
    {
        if(now()->diffInSeconds($this->user->otp_sent_at) < 30) {
            session()->flash('status', 'An OTP code was already sent to your email. Please check your inbox.');
            return;
        }

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $this->user->forceFill([
            'otp_code' => Hash::make($otp),
            'otp_expires_at' => now()->addMinutes(10),
            'otp_sent_at' => now()
        ])->save();

        try {
            $this->user->notify(new EmailVerification($otp));
            $this->valid = true;
            session()->flash('status', 'An OTP code was sent to your email.');
        } catch (Exception $e) {
            session()->flash('error', 'Failed to send OTP. Please try again.');
        }
    }

    public function verifyOtp(){
        $this->validate();

        if (!$this->user->otp_code) {
            $this->valid = false;
            session()->flash('error', 'No valid OTP found. Please request a new one.');
            return;
        }

        if ($this->expiredOtp()) {
            $this->valid = false;
            $this->clearOtp();
            session()->flash('error', 'OTP has expired. Please request a new one.');
            return;
        }

        if (Hash::check($this->otp, $this->user->otp_code)) {
            $this->user->forceFill([
                'email_verified_at' => now(),
                'otp_code' => null,
                'otp_expires_at' => null,
                'otp_sent_at' => null,
            ])->save();

            session()->flash('message', 'Email verified successfully!');
            $this->redirect(route('home'), navigate: true);
        } else{
            session()->flash('error', 'Invalid OTP code.');
        }
        $this->reset(['otp']);
    }

    private function clearOtp()
    {
        $this->user->forceFill([
            'otp_code' => null,
            'otp_expires_at' => null,
            'otp_sent_at' => null,
        ])->save();
    }

    private function expiredOtp(): bool
    {
        return $this->user->otp_expires_at && now()->greaterThan($this->user->otp_expires_at);
    }

    public function render()
    {
        return view('livewire.auth.verify-email');
    }
}
