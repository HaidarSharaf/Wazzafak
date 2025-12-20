<?php

namespace App\Livewire\Admin;

use App\Services\AnalyticsService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Admin Dashboard | Wazzafak')]
class AdminDashboard extends Component
{

    public $overviewStats = [];
    public $jobStats = [];
    public $applicationStats = [];
    public $topTechnologies = [];
    public $topStacks = [];
    public $marketInsights = [];

    protected $analytics;

    public function boot(AnalyticsService $analytics)
    {
        $this->analytics = $analytics;
    }

    public function mount()
    {
        $this->loadAnalytics();
    }

    public function loadAnalytics()
    {
        $this->overviewStats = $this->analytics->getOverviewStats();
        $this->jobStats = $this->analytics->getJobStatistics();
        $this->applicationStats = $this->analytics->getApplicationStatistics();
        $this->topTechnologies = $this->analytics->getTopTechnologies(10);
        $this->topStacks = $this->analytics->getTopStacks(10);
        $this->marketInsights = $this->analytics->getMarketInsights();
    }

    public function render()
    {
        return view('livewire.admin.admin-dashboard');
    }
}
