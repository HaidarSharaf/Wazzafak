<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyAnalytics extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $analytics;

    public function __construct($analytics)
    {
        $this->analytics = $analytics;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Daily Analytics Report - ' . now()->format('M d, Y'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.daily-analytics',
        );
    }

    public function attachments(): array
    {
        $pdfContent = Pdf::loadView('pdf.daily-analytics', [
            'analytics' => $this->analytics
        ])->output();

        return [
            Attachment::fromData(
                fn () => $pdfContent,
                'Daily_Analytics_Report_' . now()->format('Y-m-d') . '.pdf'
            )->withMime('application/pdf'),
        ];
    }
}
