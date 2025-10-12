<?php

namespace App\Console\Commands;

use App\Mail\DailyAnalytics;
use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyAnalytics extends Command
{
    protected $signature = 'analytics:send-daily';
    protected $description = 'Send daily analytics report to admins';

    public function handle()
    {
        $today = now()->startOfDay();
        $yesterday = now()->subDay()->startOfDay();

        $analytics = $this->collectAnalytics($yesterday, $today);

        $admins = User::where('role', 'admin')->get();

        if ($admins->isEmpty()) {
            $this->warn('No admin users found to send analytics.');
            return Command::FAILURE;
        }

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(
                new DailyAnalytics($analytics)
            );
        }

        $this->info("Daily analytics report sent to {$admins->count()} admin(s).");

        return Command::SUCCESS;
    }

    protected function collectAnalytics($yesterday, $today)
    {
        $jobsPostedToday = JobListing::whereBetween('created_at', [$yesterday, $today])->count();

        $jobsAcceptedToday = JobListing::where('status', 'Accepted')
            ->whereBetween('updated_at', [$yesterday, $today])
            ->count();

        $jobsRejectedToday = JobListing::where('status', 'Rejected')
            ->whereBetween('updated_at', [$yesterday, $today])
            ->count();

        $totalJobsReviewed = $jobsAcceptedToday + $jobsRejectedToday;
        $acceptanceRate = $totalJobsReviewed > 0
            ? round(($jobsAcceptedToday / $totalJobsReviewed) * 100, 2)
            : 0;
        $rejectionRate = $totalJobsReviewed > 0
            ? round(($jobsRejectedToday / $totalJobsReviewed) * 100, 2)
            : 0;

        $topTechnologies = JobListing::whereBetween('created_at', [$yesterday, $today])
            ->with('technologies')
            ->get()
            ->pluck('technologies')
            ->flatten()
            ->groupBy('id')
            ->map(function ($group) {
                return [
                    'name' => $group->first()->name,
                    'count' => $group->count()
                ];
            })
            ->sortByDesc('count')
            ->take(10)
            ->values();

        $topStacks = JobListing::whereBetween('created_at', [$yesterday, $today])
            ->with('stack')
            ->get()
            ->groupBy('stack_id')
            ->map(function ($group) {
                return [
                    'name' => $group->first()->stack->name ?? 'Unknown',
                    'count' => $group->count()
                ];
            })
            ->sortByDesc('count')
            ->take(5)
            ->values();

        $applicationsToday = JobApplication::whereBetween('created_at', [$yesterday, $today])->count();

        $applicationsAcceptedToday = JobApplication::where('status', 'Accepted')
            ->whereBetween('updated_at', [$yesterday, $today])
            ->count();

        $applicationsRejectedToday = JobApplication::where('status', 'Rejected')
            ->whereBetween('updated_at', [$yesterday, $today])
            ->count();

        $totalApplicationsReviewed = $applicationsAcceptedToday + $applicationsRejectedToday;
        $recruiterAcceptanceRate = $totalApplicationsReviewed > 0
            ? round(($applicationsAcceptedToday / $totalApplicationsReviewed) * 100, 2)
            : 0;

        return [
            'date' => $yesterday->format('F d, Y'),
            'jobs' => [
                'posted' => $jobsPostedToday,
                'accepted' => $jobsAcceptedToday,
                'rejected' => $jobsRejectedToday,
                'acceptance_rate' => $acceptanceRate,
                'rejection_rate' => $rejectionRate,
            ],
            'technologies' => $topTechnologies,
            'stacks' => $topStacks,
            'applications' => [
                'total' => $applicationsToday,
                'accepted' => $applicationsAcceptedToday,
                'rejected' => $applicationsRejectedToday,
                'acceptance_rate' => $recruiterAcceptanceRate,
            ],
        ];
    }
}
