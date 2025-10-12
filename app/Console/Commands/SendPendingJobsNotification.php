<?php

namespace App\Console\Commands;

use App\Mail\PendingJobs;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendPendingJobsNotification extends Command
{
    protected $signature = 'jobs:notify-pending';
    protected $description = 'Send email notification about pending jobs to admins';

    public function handle()
    {
        $pendingJobs = JobListing::where('status', 'Pending')
            ->get();

        $pendingCount = $pendingJobs->count();

        if ($pendingCount === 0) {
            $this->info('No pending jobs. Email not sent.');
            return Command::SUCCESS;
        }

        $admins = User::where('role', 'admin')->get();

        if ($admins->isEmpty()) {
            $this->warn('No admin users found to send notification.');
            return Command::FAILURE;
        }

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(
                new PendingJobs($pendingCount)
            );
        }

        $this->info("Pending jobs notification sent to {$admins->count()} admin(s). Total pending jobs: {$pendingCount}");

        return Command::SUCCESS;
    }
}
