<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\ModeratorController;
use App\Http\Controllers\Moderator\ModeratorDashboardController;
use App\Http\Controllers\Moderator\ModeratorProfileController;
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
        Route::get('/show/{id}', 'show')->name('single');
        Route::get('/add', 'create')->name('add');
    });
});

Route::prefix('/moderator')
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


/* INITIAL TEST ROUTES START */
Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
