<?php

use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::post("/forgot-password", [AuthController::class, "forgotPassword"]);
Route::post("/send-sms-forgot", [AuthController::class, "sendSms"]);
Route::resource("/categories", CategoryController::class);
Route::resource("/departments", DepartmentController::class);
Route::resource("/subjects", SubjectController::class);
Route::resource("/educations", EducationController::class);
Route::resource("/regions", RegionController::class);
Route::get("/regionsWithDistricts", [RegionController::class, "withDistricts"]);
Route::get("/regions/{region}/districts", [RegionController::class, "districts"]);
Route::resource("/districts", DistrictController::class);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::post("/reset-password", [AuthController::class, "resetPassword"]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/send-sms', [RegisterController::class, 'sendSms']);
Route::post('/send-only-sms', [RegisterController::class, 'sendSmsOnly']);
