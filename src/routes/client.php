<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Client\ProjectController;
use App\Http\Controllers\Client\HotelController;
use App\Http\Controllers\Client\CampaignController;
use App\Http\Controllers\Client\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Client\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Client\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Client\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Client\Auth\ClientActivationController;
use App\Http\Controllers\Client\Auth\ResetPasswordController;
use App\Http\Controllers\Client\Auth\PasswordResetLinkController;
use App\Http\Controllers\Client\Auth\RegisteredClientController;
use App\Http\Controllers\Client\Auth\VerifyEmailController;
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
})->name('dashboard');

Route::middleware('auth:client')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//管理者用・編集者のみアクセス可能
Route::middleware(['auth:client', 'checkAuthenticated'])->group(function () {
    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');

    Route::prefix('/project/hotel')->group(function () {
        Route::get('/{hotel_id?}', [HotelController::class, 'index'])->name('project.hotel.index');
        Route::prefix('{hotel_id?}')->group(function () {
            Route::get('/concept', [HotelController::class, 'editConcept'])->name('project.hotel.editConcept');
            Route::post('/concept', [HotelController::class, 'storeConcept'])->name('project.hotel.storeConcept');
            Route::put('/concept', [HotelController::class, 'updateConcept'])->name('project.hotel.updateConcept');

            Route::get('/basic-information', [HotelController::class, 'showBasicInformation'])->name('project.hotel.basic_information.edit');
            Route::post('/basic-information', [HotelController::class, 'storeOrUpdateBasicInformation'])->name('project.hotel.basic_information.update');

            Route::get('/facilities', [HotelController::class, 'showFacilities'])->name('project.hotel.facilities.edit');
            Route::post('/facilities', [HotelController::class, 'storeOrUpdateFacilities'])->name('project.hotel.facilities.update');

            Route::get('/features', [HotelController::class, 'showFeatures'])->name('project.hotel.features.edit');
            Route::post('/features', [HotelController::class, 'storeOrUpdateFeatures'])->name('project.hotel.features.update');
        });
        Route::get('/create', [HotelController::class, 'create'])->name('project.hotel.create');
        Route::post('/store', [HotelController::class, 'store'])->name('project.hotel.store');
        Route::get('/edit/{hotel}', [HotelController::class, 'edit'])->name('project.hotel.edit');
        Route::put('/edit/{hotel}', [HotelController::class, 'update'])->name('project.hotel.update');
        Route::get('/show/{hotel}', [HotelController::class, 'show'])->name('project.hotel.show');
        Route::delete('/{hotel}',[HotelController::class, 'destroy'])->name('project.hotel.destroy');

        Route::prefix('campaign')->group(function () {
            Route::get('/', [CampaignController::class, 'index'])->name('project.campaign.index');
            Route::get('/create', [CampaignController::class, 'create'])->name('project.campaign.create');
            Route::post('/store', [CampaignController::class, 'store'])->name('project.campaign.store');
            Route::get('/edit/{campaign}', [CampaignController::class, 'edit'])->name('project.campaign.edit');
            Route::put('/edit/{campaign}', [CampaignController::class, 'update'])->name('project.campaign.update');
            Route::get('/show/{campaign}', [CampaignController::class, 'show'])->name('project.campaign.show');
            Route::delete('/{campaign}',[CampaignController::class, 'destroy'])->name('project.campaign.destroy');
        });
    });
});

//管理者と編集者向けのログインページ遷移
Route::prefix('owner')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('client.home.index');

    Route::get('/register', [RegisteredClientController::class, 'create'])->middleware('guest')->name('client.register');
    Route::post('/register', [RegisteredClientController::class, 'store'])->middleware('guest');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('client.login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->middleware('guest')->name('client.password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('client.password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->middleware('guest')->name('client.password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'store'])->middleware('guest')->name('client.password.update');

    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])->middleware('auth')->name('client.verification.notice');
    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['auth', 'signed', 'throttle:6,1'])->name('client.verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['auth', 'throttle:6,1'])->name('client.verification.send');

    Route::get('/activate/{token}', [ClientActivationController::class, 'activate'])->middleware('guest')->name('client.activate');

    Route::view('/registration-success', 'client.auth.registration-success')->name('client.registration.success');
    Route::view('/activation-success', 'client.auth.activation-success')->name('client.activation.success');
    Route::view('/activation-failed', 'client.auth.activation-failed')->name('client.activation.failed');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])->middleware('auth')->name('client.password.confirm');
    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])->middleware('auth');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:client')->name('client.logout');
});