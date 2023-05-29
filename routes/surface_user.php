<?php

use App\Http\Controllers\Surface_Users\SurfaceUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/cms/{role}/manage/users')
->middleware(['auth'])
->name('users.')
->group(function () {
    Route::controller(SurfaceUserController::class)
    ->group(function (){
        Route::get('/', 'index')->name('show');
        Route::get('/locked', 'lockedUsers')->name('locked');
        Route::get('/account/{id}', 'show')->name('single');
        Route::post('/account/edit/{id}', 'update')->name('update');
    });
});
