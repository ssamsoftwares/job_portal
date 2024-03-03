<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

// Route::middleware('guest')->group(function () {

// Superadmin  Controller Route
Route::get('superadmin/login', [AdminAuthController::class, 'loginView'])->name('superadmin.loginView');
Route::post('superadmin-login-post', [AdminAuthController::class, 'login'])->name('superadmin.login');
Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');

// Auth Controller Route
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('user-login', [AuthController::class, 'loginPost'])->name('userloginPost');

Route::get('registration-form', [AuthController::class, 'candidateRegisterView'])->name('candidateRegistration');
Route::post('candidate-registration', [AuthController::class, 'candidateRegister'])->name('candidateRegister');


Route::get('employer-registration-form', [AuthController::class, 'employerRegisterView'])->name('employerRegistration');
Route::post('employer-registration', [AuthController::class, 'employerRegister'])->name('employerRegister');


Route::get('forgot-password', [ForgetPasswordController::class, 'create'])
->name('password.request');

Route::post('forgot-password', [ForgetPasswordController::class, 'store'])
->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'create'])
->name('password.reset');

Route::post('reset-password', [ResetPasswordController::class, 'store'])
->name('password.update');

Route::get('verifyEmail', [ResetPasswordController::class, 'verifyEmail'])
->name('password.verifyEmail');


// });

?>
