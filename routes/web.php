<?php

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
use App\Livewire\Jobs;
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

Route::get('/jobs', ExploreJobs::class)->name('explore-jobs');

Route::get('/jobs/{job_listing}', JobDetails::class)->name('job');

Route::get('/my-applications', AppliedJobs::class)->name('my-applications');

Route::get('/job/create', CreateJobs::class)->name('create-job');

Route::get('/job/{job_listing}/edit', CreateJobs::class)->name('edit-job');


