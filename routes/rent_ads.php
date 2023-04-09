<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rent_Ads\RentAdController;

Route::middleware(['auth'])
->group(function () {

    Route::controller(RentAdController::class)
    ->group(function (){

        Route::prefix('/admin/manage/rent-ads')
        ->name('admin.manage.rent_ads.')
        ->middleware(['role:admin'])
        ->group(function(){
            Route::get('/{status}', 'getAllForAdmin')->name('all');
        });

        Route::prefix('{role}/manage/rent-ads')
        ->name('manage.rent_ads.')
        ->group(function(){
            Route::get('/details/{id}', 'show')->name('show');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'destroy')->name('delete');
        });

        Route::prefix('/moderator/manage/rent-ads')
        ->name('moderator.manage.rent_ads.')
        ->middleware(['role:moderator'])
        ->group(function(){
            Route::get('/{status}', 'getAllForModerator')->name('all');
        });

    });
});

