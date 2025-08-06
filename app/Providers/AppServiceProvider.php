<?php

namespace App\Providers;

use App\Models\JobListing;
use App\Models\User;
use App\Policies\JobListingPolicy;
use App\Policies\UserPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */



    public function boot(): void
    {
        Model::automaticallyEagerLoadRelationships();

        Gate::define('access-admin-panel', [UserPolicy::class, 'accessAdminPanel']);
        Gate::define('access-recruiter-dashboard', [UserPolicy::class, 'accessRecruiterDashboard']);
        Gate::define('access-developer-dashboard', [UserPolicy::class, 'accessDeveloperDashboard']);

        Gate::define('access-home', function ($user = null) {
            if (!$user) return true;
            return Gate::allows('access-developer-dashboard') || Gate::allows('access-recruiter-dashboard');
        });

        Gate::define('view-job-listing', [JobListingPolicy::class, 'view']);
        Gate::define('poster-view-job-listing', [JobListingPolicy::class, 'posterView']);
        Gate::define('accept-job-listing', [JobListingPolicy::class, 'accept']);
        Gate::define('reject-job-listing', [JobListingPolicy::class, 'reject']);
        Gate::define('view-job-applicants', [JobListingPolicy::class, 'viewApplicants']);
        Gate::define('manage-job-applicants', [JobListingPolicy::class, 'manageApplicants']);
        Gate::define('disclose-job-listing', [JobListingPolicy::class, 'disclose']);
        Gate::define('apply-for-job', [JobListingPolicy::class, 'apply']);
        Gate::define('create-job-listing', [JobListingPolicy::class, 'create']);
    }
}
