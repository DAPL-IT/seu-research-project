<?php

use App\Http\Controllers\Moderator\ModeratorDashboardController;
use App\Http\Controllers\Moderator\ModeratorProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('/cms/moderator')
->middleware(['auth', 'role:moderator'])
->name('moderator.')
->group(function () {
    Route::get('/dashboard', [ModeratorDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/profile')
    ->controller(ModeratorProfileController::class)
    ->name('profile.')
    ->group(function (){
        Route::get('/', 'index')->name('show');
        Route::get('/edit', 'edit')->name('edit');
        Route::post('/update/general', 'updateGeneral')->name('update.general');
        Route::post('/update/image', 'updateImage')->name('update.image');
        Route::post('/update/password', 'updatePassword')->name('update.password');
    });

});
