<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\UpdatePassword;
use App\Livewire\Auth\VerifyEmail;
use App\Livewire\Home;
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
