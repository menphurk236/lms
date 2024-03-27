<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController as SecUserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('departments', DepartmentController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('employees', EmployeeController::class);
    Route::post('employees/add-video/{id}', [EmployeeController::class, 'AddEmployeeVideos'])->name('employees.add-video');
    Route::delete('employees/delete-video/{id}', [EmployeeController::class, 'RemoveEmployeeVideos'])->name('employees.delete-video');

    Route::resource('users', SecUserController::class);

    Route::resource('videos', VideoController::class);


});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    // Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    // Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::get('result', [HomeController::class, 'result'])->name('result');
    Route::get(
        '/videos/{id}',
        [HomeController::class, 'stream']
    )->name('stream');
});


    Route::group(['prefix'=>'master','as'=>'master.'], function(){
        Route::get('category-video', [MasterController::class, 'CategoryVideo'])->name('category-video');
        Route::get('department', [MasterController::class, 'Department'])->name('department');
        Route::get('employee', [MasterController::class, 'Employee'])->name('employee');
        Route::get('employee-by-department/{id}', [MasterController::class, 'EmployeeByDepartment'])->name('employee-by-department');
        Route::get('video', [MasterController::class, 'Video'])->name('video');
    });
