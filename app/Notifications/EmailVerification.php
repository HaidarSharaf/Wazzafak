<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $otp)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Verify Your Email Address')
            ->view('emails.email-verification', [
                'otp' => $this->otp,
                'user' => $notifiable,
                'expiresAt' => now()->addMinutes(10)->format('g:i A'),
            ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'otp' => $this->otp,
            'message' => 'Email verification code sent',
        ];
    }
}
