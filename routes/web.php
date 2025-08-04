<?php

use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\ManageJob;
use App\Livewire\Admin\ManageJobPosts;
use App\Livewire\AppliedJobs;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\UpdatePassword;
use App\Livewire\Auth\VerifyEmail;
use App\Livewire\CreateJobs;
use App\Livewire\ExploreJobs;
use App\Livewire\Home;
use App\Livewire\JobDetails;
use App\Livewire\PostedJobs;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');
    Route::get('/reset-password/{token}',ResetPassword::class)->name('password-reset');
});

Route::middleware(['auth'])->group(function () {
    Route::get('verify-email', VerifyEmail::class)->name('verify-email');
});

Route::get('/', Home::class)->middleware('can:access-home')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/update-password', UpdatePassword::class)->name('update-password');

    Route::get('/jobs/{job_listing}', JobDetails::class)->name('job-listing');

    Route::middleware(['can:access-developer-dashboard'])->group(function () {
        Route::get('/jobs', ExploreJobs::class)->name('explore-jobs');

        Route::get('/applications', AppliedJobs::class)->name('my-applications');
    });

    Route::middleware(['can:access-recruiter-dashboard'])->group(function () {
        Route::get('/posted-jobs', PostedJobs::class)->name('posted-jobs');

        Route::get('/job/create', CreateJobs::class)->name('create-job');
    });
});


Route::middleware(['auth', 'can:access-admin-panel'])->prefix('/admin')->group(function(){
    Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/jobs/manage', ManageJobPosts::class)->name('admin.manage');
    Route::get('/job/manage/{job_listing}', ManageJob::class)->name('admin.job.manage');
});

