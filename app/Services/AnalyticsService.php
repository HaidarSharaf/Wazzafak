<?php

namespace App\Services;

use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\Technology;
use App\Models\Stack;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AnalyticsService
{
    // ===== OVERVIEW STATS =====

    public function getOverviewStats()
    {
        return [
            'total_users' => User::count(),
            'total_developers' => User::where('role', 'developer')->count(),
            'total_recruiters' => User::where('role', 'recruiter')->count(),
            'total_jobs' => JobListing::count(),
            'active_jobs' => JobListing::where('status', 'Accepted')->where('is_disclosed', false)->count(),
            'pending_jobs' => JobListing::where('status', 'Pending')->count(),
            'total_applications' => JobApplication::count(),
            'pending_applications' => JobApplication::where('status', 'Pending')->count(),
        ];
    }

    // ===== JOB STATISTICS =====

    public function getJobStatistics()
    {
        $total = JobListing::count();
        $accepted = JobListing::where('status', 'Accepted')->count();
        $rejected = JobListing::where('status', 'Rejected')->count();
        $pending = JobListing::where('status', 'Pending')->count();

        return [
            'total' => $total,
            'accepted' => $accepted,
            'rejected' => $rejected,
            'pending' => $pending,
            'acceptance_rate' => $total > 0 ? round(($accepted / $total) * 100, 2) : 0,
        ];
    }

    public function getTopTechnologies($limit = 10)
    {
        return Technology::withCount(['jobListings' => function ($query) {
            $query->where('status', 'Accepted');
        }])
            ->having('job_listings_count', '>', 0)
            ->orderByDesc('job_listings_count')
            ->limit($limit)
            ->get();
    }

    public function getTopStacks($limit = 10)
    {
        return JobListing::join('stacks', 'job_listings.stack_id', '=', 'stacks.id')
            ->where('job_listings.status', 'Accepted')
            ->select(
                'stacks.id',
                'stacks.name',
                DB::raw('COUNT(*) as jobs_count'),
                DB::raw('AVG(job_listings.salary) as avg_salary')
            )
            ->groupBy('stacks.id', 'stacks.name')
            ->orderByDesc('jobs_count')
            ->limit($limit)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'jobs_count' => $item->jobs_count,
                    'avg_salary' => round($item->avg_salary, 2),
                ];
            });
    }

    // ===== APPLICATION STATISTICS =====

    public function getApplicationStatistics()
    {
        $total = JobApplication::count();
        $accepted = JobApplication::where('status', 'Accepted')->count();
        $rejected = JobApplication::where('status', 'Rejected')->count();
        $pending = JobApplication::where('status', 'Pending')->count();

        return [
            'total' => $total,
            'accepted' => $accepted,
            'rejected' => $rejected,
            'pending' => $pending,
            'success_rate' => $total > 0 ? round(($accepted / $total) * 100, 2) : 0,
        ];
    }

    // ===== MARKET INSIGHTS =====

    public function getMarketInsights()
    {
        return [
            'most_demanded_stack' => $this->getMostDemandedStack(),
            'highest_paying_stack' => $this->getHighestPayingStack(),
        ];
    }

    private function getMostDemandedStack()
    {
        return JobListing::join('stacks', 'job_listings.stack_id', '=', 'stacks.id')
            ->where('job_listings.status', 'Accepted')
            ->select('stacks.name', DB::raw('COUNT(*) as count'))
            ->groupBy('stacks.name')
            ->orderByDesc('count')
            ->first();
    }

    private function getHighestPayingStack()
    {
        return JobListing::join('stacks', 'job_listings.stack_id', '=', 'stacks.id')
            ->where('job_listings.status', 'Accepted')
            ->select('stacks.name', DB::raw('AVG(salary) as avg_salary'))
            ->groupBy('stacks.name')
            ->orderByDesc('avg_salary')
            ->first();
    }
}
