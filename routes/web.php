<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Candidates\DashboardController as CandidatesDashboardController;
use App\Http\Controllers\Employer\DashboardController as EmployerDashboardController;
use App\Http\Controllers\Employer\SettingController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\ProfileController;
use Illuminate\Support\Facades\Redirect;
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


// terms & conditions
Route::get('/terms-conditions', function () {
    return;
})->name('terms-conditions');

Route::get('/', function () {
    return Redirect::route('login');
});


// SUPERADMIN ROUTE
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {

        // dashboard
        Route::get('/dashboard', DashboardController::class)->name('admin.dashboard');

        // Profile Controller

        Route::get('/profile', [ProfileController::class, 'editProfile'])->name('admin.profile.edit');
        Route::post('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
        Route::post('/profile/update-password', [ProfileController::class, 'update_password'])->name('profile.update_password');

    });   // CLOSUP Prefix

});


// EMPLOYER ROUTE
Route::middleware(['employer'])->group(function () {
    Route::prefix('employer')->group(function () {

        // dashboard
        Route::get('/dashboard', EmployerDashboardController::class)->name('employer.dashboard');

        // Setting Controller
        Route::get('/verification-form', [SettingController::class, 'employerverificationForm'])->name('employer.employerverificationForm');
        
        Route::get('/profile', [SettingController::class, 'profilePreview'])->name('employer.profilePreview');

        Route::get('/settings', [SettingController::class, 'settings'])->name('employer.settings');

        Route::post('/company-info/{id?}', [SettingController::class, 'companyInfo'])->name('employer.companyInfo');

        Route::post('/founding-info/{id?}', [SettingController::class, 'foundingInfo'])->name('employer.foundingInfo');

        Route::post('/social-media-profile/{id?}', [SettingController::class, 'socialMediaProfile'])->name('employer.socialMediaProfile');

        Route::post('/account-setting/{id?}', [SettingController::class, 'accountsetting'])->name('employer.accountsetting');

        Route::post('/update-password', [SettingController::class, 'updatePassword'])->name('employer.updatePassword');




    }); // CLOSUP Prefix
});


// CANDIDATE ROUTE

Route::middleware(['candidate'])->group(function () {
    Route::prefix('candidate')->group(function () {

        // dashboard

        Route::get('/dashboard', CandidatesDashboardController::class)->name('candidate.dashboard');


        // Profile Controller

    });   // CLOSUP Prefix

});











require __DIR__ . '/auth.php';
