<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Middleware\Lang;
use Illuminate\Support\Facades\Route;

Route::middleware([Lang::class])->group(function () {

    Route::get('auth/login', [AuthController::class, 'login'])->name("login");
    Route::post('auth/login', [AuthController::class, 'auth']);

    Route::group(['middleware' => 'auth'], function () {

        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('', [DashboardController::class, 'index']);
        Route::get('home', [DashboardController::class, 'index']);

        Route::group(['prefix' => 'settings'], function () {
            Route::get('', [SettingController::class, 'index']);
            Route::get('language/{lang}', [SettingController::class, 'language']);
            Route::get('theme/{theme}', [SettingController::class, 'theme']);
            Route::get('about', [SettingController::class, 'about']);
            Route::get('terms', [SettingController::class, 'terms']);
            Route::post('', [SettingController::class, 'update']);
            Route::get('about', [SettingController::class, 'about']);
            Route::post('update', [SettingController::class, 'update']);
        });

        Route::group(['prefix' => 'admins'], function () {
            Route::get('', [AdminController::class, 'index']);
            Route::get('create', [AdminController::class, 'create']);
            Route::get('edit/{id}', [AdminController::class, 'edit']);
            Route::get('view/{id}', [AdminController::class, 'show']);
            Route::get('logs/{id}', [AdminController::class, 'logs']);
            Route::get('logs', [AdminController::class, 'logs']);
            Route::post('create', [AdminController::class, 'store']);
            Route::post('update/{id}', [AdminController::class, 'update']);
            Route::post('delete', [AdminController::class, 'destroy']);
            Route::get('deleted', [AdminController::class, 'deleted']);
            Route::get('restore/{id}', [AdminController::class, 'restore']);
            Route::get('force_delete', [AdminController::class, 'force_delete']);
        });

        Route::group(['prefix' => 'specializations'], function () {
            Route::get('', [SpecializationController::class, 'index']);
            Route::get('create', [SpecializationController::class, 'create']);
            Route::get('edit/{id}', [SpecializationController::class, 'edit']);
            Route::post('create', [SpecializationController::class, 'store']);
            Route::post('update/{id}', [SpecializationController::class, 'update']);
            Route::post('delete', [SpecializationController::class, 'destroy']);
        });

        Route::group(['prefix' => 'doctors'], function () {
            Route::get('', [DoctorController::class, 'index']);
            Route::get('create', [DoctorController::class, 'create']);
            Route::get('edit/{id}', [DoctorController::class, 'edit']);
            Route::post('create', [DoctorController::class, 'store']);
            Route::post('update/{id}', [DoctorController::class, 'update']);
            Route::post('delete', [DoctorController::class, 'destroy']);
        });
    });
});
