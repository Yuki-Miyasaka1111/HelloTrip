<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\HotelController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\Auth\AuthenticatedSessionController;
use App\Http\Controllers\User\Auth\ConfirmablePasswordController;
use App\Http\Controllers\User\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\User\Auth\EmailVerificationPromptController;
use App\Http\Controllers\User\Auth\UserActivationController;
use App\Http\Controllers\User\Auth\ResetPasswordController;
use App\Http\Controllers\User\Auth\PasswordResetLinkController;
use App\Http\Controllers\User\Auth\RegisteredUserController;
use App\Http\Controllers\User\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');

})->name('user.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('user.register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('user.login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->middleware('guest')->name('user.password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('user.password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->middleware('guest')->name('user.password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'store'])->middleware('guest')->name('user.password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])->middleware('auth')->name('user.verification.notice');
Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['auth', 'signed', 'throttle:6,1'])->name('user.verification.verify');
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['auth', 'throttle:6,1'])->name('user.verification.send');

Route::get('/activate/{token}', [UserActivationController::class, 'activate'])->middleware('guest')->name('user.activate');

Route::view('/registration-success', 'user.auth.registration-success')->name('user.registration.success');
Route::view('/activation-success', 'user.auth.activation-success')->name('user.activation.success');
Route::view('/activation-failed', 'user.auth.activation-failed')->name('user.activation.failed');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])->middleware('auth')->name('user.password.confirm');
Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:web')->name('user.logout');


//トップページ
Route::get('/', [HomeController::class, 'index'])->name('user.top');
Route::prefix('hotels')->group(function () {
    // 各施設ページ
    Route::prefix('{hotel_id}')->group(function () {
        Route::get('/', [HotelController::class, 'index'])->name('hotel.index');
    });
    Route::prefix('{category}')->group(function () {
        Route::get('/', [HotelController::class, 'category'])->name('hotel.category');
    });
});
