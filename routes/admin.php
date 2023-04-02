<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\ModeratorController;
use App\Http\Controllers\Admin\RentClassificationController;
use App\Http\Controllers\Admin\RentTypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')
->middleware(['auth', 'role:admin'])
->name('admin.')
->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/profile')
    ->controller(AdminProfileController::class)
    ->name('profile.')
    ->group(function (){
        Route::get('/', 'index')->name('show');
        Route::get('/edit', 'edit')->name('edit');
        Route::post('/update/general', 'updateGeneral')->name('update.general');
        Route::post('/update/image', 'updateImage')->name('update.image');
        Route::post('/update/password', 'updatePassword')->name('update.password');
    });

    Route::prefix("/manage/moderators")
    ->controller(ModeratorController::class)
    ->name('manage.moderators.')
    ->group(function(){
        Route::get('/', 'index')->name('all');
        Route::get('/account/{id}', 'show')->name('single');
        Route::get('/add', 'create')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
    });

    Route::prefix('/manage/rent-types')
    ->controller(RentTypeController::class)
    ->name('manage.rent_types.')
    ->group(function(){
        Route::get('/', 'index')->name('all');
        Route::get('/edit/{id}', 'edit');
        Route::post('/store', 'store')->name('store');
        Route::post('/update/{id}', 'update');
    });

    Route::prefix('/manage/districts')
    ->controller(DistrictController::class)
    ->name('manage.districts.')
    ->group(function(){
        Route::get('/', 'index')->name('all');
        Route::get('/edit/{id}', 'edit');
        Route::post('/store', 'store')->name('add');
        Route::post('/bulk-store', 'bulkStore')->name('bulk.store');
        Route::post('/update/{id}', 'update');
    });

    Route::prefix('/manage/areas')
    ->controller(AreaController::class)
    ->name('manage.areas.')
    ->group(function(){
        Route::get('/', 'index')->name('all');
        Route::get('/edit/{id}', 'edit');
        Route::post('/store', 'store')->name('add');
        Route::post('/bulk-store', 'bulkStore')->name('bulk.store');
        Route::post('/update/{id}', 'update');
    });

    Route::prefix('/manage/rent-classifications')
    ->controller(RentClassificationController::class)
    ->name('manage.rent.classifications.')
    ->group(function(){
        Route::get('/', 'index')->name('all');
        Route::get('/edit/{id}', 'edit');
        Route::get('/delete/{id}', 'destroy')->name('delete');
        Route::post('/store', 'store')->name('add');
        Route::post('/update/{id}', 'update');
    });

});
