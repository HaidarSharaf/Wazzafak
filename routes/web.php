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
use App\Livewire\EditJobs;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/update-password', UpdatePassword::class)->name('update-password');
});

Route::get('/', Home::class)->name('home');
Route::get('/jobs/{job_listing}', JobDetails::class)->name('job-listing');



Route::get('/jobs', ExploreJobs::class)->name('explore-jobs');

Route::get('/applications', AppliedJobs::class)->name('my-applications');



Route::get('/posted-jobs', PostedJobs::class)->name('posted-jobs');

Route::get('/job/create', CreateJobs::class)->name('create-job');

Route::get('/job/{job_listing}/edit', EditJobs::class)->name('edit-job');

Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
Route::get('/admin/jobs/manage', ManageJobPosts::class)->name('admin.manage');
Route::get('/admin/job/manage/{job_listing}', ManageJob::class)->name('admin.job.manage');

