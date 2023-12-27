<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\EmailVerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\VerificationCodeController;


Route::post('/forgot-password', [ForgotPasswordController::class, 'sendVerificationCode']);
Route::post('/verify-code', [VerificationCodeController::class, 'verify']);
Route::post('/change-password', [ResetPasswordController::class, 'reset']);
Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);
Route::post('logout', LogoutController::class)->middleware(`auth:sanctum`);
Route::post('/verify-email', [EmailVerificationController::class, 'verifyEmail']);
