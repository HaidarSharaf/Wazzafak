<?php

namespace App\Providers;

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
    }
}
