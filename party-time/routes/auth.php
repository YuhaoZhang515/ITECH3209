<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/superadmin/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('superadmin.register');

Route::post('/superadmin/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/superadmin/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('superadmin.login');

Route::post('/superadmin/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/superadmin/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('superadmin.password.request');

Route::post('/superadmin/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('superadmin.password.email');

Route::get('/superadmin/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('superadmin.password.reset');

Route::post('/superadmin/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('superadmin.password.update');

Route::get('/superadmin/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('superadmin.verification.notice');

Route::get('/superadmin/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('superadmin.verification.verify');

Route::post('/superadmin/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('superadmin.verification.send');

Route::get('/superadmin/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('superadmin.password.confirm');

Route::post('/superadmin/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/superadmin/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('superadmin.logout');
