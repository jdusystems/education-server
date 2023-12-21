<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ChangePasswordController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\EmailVerificationController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);
Route::post('logout', LogoutController::class)->middleware(`auth:sanctum`);
Route::post('password/changepassword', [ChangePasswordController::class, 'change_password'])->middleware('auth:sanctum');
Route::post('password/email', [ResetPasswordController::class, 'sendResetLinkEmail']);
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->middleware('signed')->name('password.reset');
Route::post('/verify-email', [EmailVerificationController::class, 'verifyEmail']);
