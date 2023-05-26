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

    Route::prefix('/project')->group(function () {

        // ホテル情報
        Route::prefix('hotel')->group(function () {
            Route::prefix('{hotel_id?}')->group(function () {
                Route::get('/', [HotelController::class, 'index'])->name('project.hotel.index');
                Route::get('/basic-information', [HotelController::class, 'editBasicInformation'])->name('project.hotel.editBasicInformation');
                Route::post('/basic-information', [HotelController::class, 'storeBasicInformation'])->name('project.hotel.storeBasicInformation');
                Route::put('/basic-information', [HotelController::class, 'updateBasicInformation'])->name('project.hotel.updateBasicInformation');
    
                Route::get('/concept', [HotelController::class, 'editConcept'])->name('project.hotel.editConcept');
                Route::post('/concept', [HotelController::class, 'storeConcept'])->name('project.hotel.storeConcept');
                Route::put('/concept', [HotelController::class, 'updateConcept'])->name('project.hotel.updateConcept');
    
                Route::get('/facilities', [HotelController::class, 'editFacilities'])->name('project.hotel.editFacilities');
                Route::post('/facilities', [HotelController::class, 'storeFacilities'])->name('project.hotel.storeFacilities');
                Route::put('/facilities', [HotelController::class, 'updateFacilities'])->name('project.hotel.updateFacilities');
    
                Route::get('/features', [HotelController::class, 'editFeatures'])->name('project.hotel.editFeatures');
                Route::post('/features', [HotelController::class, 'storeFeatures'])->name('project.hotel.storeFeatures');
                Route::put('/features', [HotelController::class, 'updateFeatures'])->name('project.hotel.updateFeatures');

                // キャンペーン情報
                Route::prefix('campaign')->group(function () {
                    Route::get('/register', [CampaignController::class, 'createCampaign'])->name('project.campaign.createCampaign');
                    Route::post('/register', [CampaignController::class, 'storeCampaign'])->name('project.campaign.storeCampaign');
                    Route::put('/register', [CampaignController::class, 'updateCampaign'])->name('project.campaign.updateCampaign');

                    Route::get('/manage', [CampaignController::class, 'manageCampaign'])->name('project.campaign.manageCampaign');
                    // Route::post('/manage', [CampaignController::class, 'storeManageCampaign'])->name('project.campaign.storeManageCampaign');
                    // Route::put('/manage', [CampaignController::class, 'updateManageCampaign'])->name('project.campaign.updateManageCampaign');
                    
                    Route::prefix('{campaign_id?}')->group(function () {
                        Route::get('/', [CampaignController::class, 'index'])->name('project.campaign.index');
                    });
                });
            });
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