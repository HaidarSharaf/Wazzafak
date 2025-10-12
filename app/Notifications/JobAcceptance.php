<?php

namespace App\Notifications;

use App\Models\JobListing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobAcceptance extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public JobListing $job_listing
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Job Post Accepted')
            ->view('emails.job-acceptance', [
                'company_name' => $this->job_listing->getCompanyNameAttribute(),
                'job_title' =>  $this->job_listing->experience . ": " . $this->job_listing->getStackNameAttribute(),
            ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'job_acceptance',
            'company_name' => $this->job_listing->getCompanyNameAttribute(),
            'job_title' =>  $this->job_listing->experience . ": " . $this->job_listing->getStackNameAttribute(),
        ];
    }
}
