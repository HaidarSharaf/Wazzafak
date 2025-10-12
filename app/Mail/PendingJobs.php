<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PendingJobs extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $pendingCount;

    public function __construct($pendingCount)
    {
        $this->pendingCount = $pendingCount;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "{$this->pendingCount} Job(s) Pending Approval",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pending-jobs',
        );
    }
}
