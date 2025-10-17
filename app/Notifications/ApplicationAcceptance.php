<?php

namespace App\Notifications;

use App\Models\JobListing;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationAcceptance extends Notification implements ShouldQueue
{
    use Queueable;

    protected $name;

    protected $applicant_name;
    protected $jobListing;
    protected $interviewDateTime;
    protected $interviewLocation;
    protected $zoomData;
    protected $isRecruiter;

    public function __construct(
        string $name,
        JobListing $jobListing,
        Carbon $interviewDateTime,
        string $interviewLocation,
        ?array $zoomData = null,
        ?string $applicantName = null,
        bool $isRecruiter = false
    ) {
        $this->name = $name;
        $this->jobListing = $jobListing;
        $this->interviewDateTime = $interviewDateTime;
        $this->interviewLocation = $interviewLocation;
        $this->zoomData = $zoomData;
        $this->applicantName = $applicantName;
        $this->isRecruiter = $isRecruiter;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $formattedDate = $this->interviewDateTime->format('l, F j, Y');
        $formattedTime = $this->interviewDateTime->format('g:i A');

        if ($this->isRecruiter) {
            return (new MailMessage)
                ->subject('Interview Scheduled - ' . $this->jobListing->getStackNameAttribute())
                ->view('emails.application-acceptance-recruiter', [
                    'recruiter_name' => $this->name,
                    'candidate_name' => $this->applicantName,
                    'job_title' => $this->jobListing->experience . ": " . $this->jobListing->getStackNameAttribute(),
                    'interview_date' => $formattedDate,
                    'interview_time' => $formattedTime,
                    'interview_location' => $this->interviewLocation === 'online_meeting' ? 'Online Meeting (Zoom)' : 'In-Person',
                    'is_online' => $this->interviewLocation === 'online_meeting',
                    'zoom_start_url' => $this->zoomData['start_url'] ?? null,
                    'zoom_meeting_id' => $this->zoomData['id'] ?? null,
                    'zoom_password' => $this->zoomData['password'] ?? null,
                ]);
        } else {
            return (new MailMessage)
                ->subject('Interview Scheduled - ' . $this->jobListing->getStackNameAttribute())
                ->view('emails.application-acceptance-developer', [
                    'applicant_name' => $this->name,
                    'company_name' => $this->jobListing->getCompanyNameAttribute(),
                    'job_title' => $this->jobListing->experience . ": " . $this->jobListing->getStackNameAttribute(),
                    'interview_date' => $formattedDate,
                    'interview_time' => $formattedTime,
                    'interview_location' => $this->interviewLocation === 'online_meeting' ? 'Online Meeting (Zoom)' : 'In-Person',
                    'is_online' => $this->interviewLocation === 'online_meeting',
                    'zoom_join_url' => $this->zoomData['join_url'] ?? null,
                    'zoom_meeting_id' => $this->zoomData['id'] ?? null,
                    'zoom_password' => $this->zoomData['password'] ?? null,
                ]);
        }
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'interview_scheduled',
            'job_listing_id' => $this->jobListing->id,
            'job_title' => $this->jobListing->getStackNameAttribute(),
            'interview_date' => $this->interviewDateTime->toDateTimeString(),
            'interview_location' => $this->interviewLocation,
            'zoom_join_url' => $this->zoomData['join_url'] ?? null,
            'zoom_start_url' => $this->isRecruiter ? ($this->zoomData['start_url'] ?? null) : null,
            'zoom_meeting_id' => $this->zoomData['id'] ?? null,
            'zoom_password' => $this->zoomData['password'] ?? null,
            'applicant_name' => $this->applicant_name,
            'is_recruiter' => $this->isRecruiter,
        ];
    }
}
