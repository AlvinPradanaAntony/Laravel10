<?php

use App\Http\Controllers\Auth\Admin\AuthenticatedSessionController as AdminAuthenticatedSessionController;
use App\Http\Controllers\Auth\Admin\ConfirmablePasswordController as AdminConfirmablePasswordController;
use App\Http\Controllers\Auth\Admin\EmailVerificationNotificationController as AdminEmailVerificationNotificationController;
use App\Http\Controllers\Auth\Admin\EmailVerificationPromptController as AdminEmailVerificationPromptController;
use App\Http\Controllers\Auth\Admin\NewPasswordController as AdminNewPasswordController;
use App\Http\Controllers\Auth\Admin\PasswordResetLinkController as AdminPasswordResetLinkController;
use App\Http\Controllers\Auth\Admin\RegisteredUserController as AdminRegisteredUserController;
use App\Http\Controllers\Auth\Admin\VerifyEmailController as AdminVerifyEmailController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('login', [AdminAuthenticatedSessionController::class, 'create'])
                ->name('admin.login');

    Route::post('login', [AdminAuthenticatedSessionController::class, 'store'])
                ->name('admin.login.store');

    Route::get('forgot-password', [AdminPasswordResetLinkController::class, 'create'])
                ->name('admin.password.request');

    Route::post('forgot-password', [AdminPasswordResetLinkController::class, 'store'])
                ->name('admin.password.email');

    Route::get('reset-password/{token}', [AdminNewPasswordController::class, 'create'])
                ->name('admin.password.reset');

    Route::post('reset-password', [AdminNewPasswordController::class, 'store'])
                ->name('admin.password.update');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin,admin']], function () {
    Route::get('verify-email', [AdminEmailVerificationPromptController::class, '__invoke'])
                ->name('admin.verification.notice');

    Route::get('verify-email/{id}/{hash}', [AdminVerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('admin.verification.verify');

    Route::post('email/verification-notification', [AdminEmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('admin.verification.send');

    Route::get('confirm-password', [AdminConfirmablePasswordController::class, 'show'])
                ->name('admin.password.confirm.show');

    Route::post('confirm-password', [AdminConfirmablePasswordController::class, 'store'])
                ->name('admin.password.confirm.store');

    Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])
                ->name('admin.logout');
});
