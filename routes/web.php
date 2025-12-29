<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CustomerCaseController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataEntryController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReservationController;
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

        Route::group(['prefix' => 'data_entries'], function () {
            Route::get('', [DataEntryController::class, 'index']);
            Route::get('create', [DataEntryController::class, 'create']);
            Route::get('edit/{id}', [DataEntryController::class, 'edit']);
            Route::post('create', [DataEntryController::class, 'store']);
            Route::post('update/{id}', [DataEntryController::class, 'update']);
            Route::post('delete', [DataEntryController::class, 'destroy']);
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
            Route::get('by_specialization/{id}', [DoctorController::class, 'by_specialization']);
            Route::post('create', [DoctorController::class, 'store']);
            Route::post('update/{id}', [DoctorController::class, 'update']);
            Route::post('delete', [DoctorController::class, 'destroy']);
        });

        Route::group(['prefix' => 'customers'], function () {
            Route::get('', [CustomerController::class, 'index']);
            Route::get('create', [CustomerController::class, 'create']);
            Route::get('edit/{id}', [CustomerController::class, 'edit']);
            Route::post('create', [CustomerController::class, 'store']);
            Route::post('update/{id}', [CustomerController::class, 'update']);
            Route::post('delete', [CustomerController::class, 'destroy']);
        });

        Route::group(['prefix' => 'reservations'], function () {
            Route::get('', [ReservationController::class, 'index']);
            Route::get('create', [ReservationController::class, 'create']);
            Route::get('edit/{id}', [ReservationController::class, 'edit']);
            Route::post('create', [ReservationController::class, 'store']);
            Route::post('update/{id}', [ReservationController::class, 'update']);
            Route::post('delete', [ReservationController::class, 'destroy']);
        });

        Route::group(['prefix' => 'expenses'], function () {
            Route::get('', [ExpenseController::class, 'index']);
            Route::get('create', [ExpenseController::class, 'create']);
            Route::get('edit/{id}', [ExpenseController::class, 'edit']);
            Route::post('create', [ExpenseController::class, 'store']);
            Route::post('update/{id}', [ExpenseController::class, 'update']);
            Route::post('delete', [ExpenseController::class, 'destroy']);
        });

        Route::group(['prefix' => 'cases'], function () {
            Route::get('', [CustomerCaseController::class, 'index']);
            Route::get('create', [CustomerCaseController::class, 'create']);
            Route::get('edit/{id}', [CustomerCaseController::class, 'edit']);
            Route::get('view/{id}', [CustomerCaseController::class, 'show']);
            Route::post('create', [CustomerCaseController::class, 'store']);
            Route::post('update/{id}', [CustomerCaseController::class, 'update']);
            Route::post('delete', [CustomerCaseController::class, 'destroy']);
            Route::get('status/{status}/{id}', [CustomerCaseController::class, 'status']);
        });

        Route::group(['prefix' => 'reports'], function () {
            Route::get('{filter}', [ReportController::class, 'index']);
            Route::get('view/{id}', [ReportController::class, 'show']);
        });

    });
});
