<?php

use App\Http\Controllers\Frontend\AdController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SurfaceUserAuthController;
use Illuminate\Support\Facades\Route;


Route::post('/surface-user-login', [SurfaceUserAuthController::class, 'login'])->name('surface_user_login');
Route::post('/surface-user-register', [SurfaceUserAuthController::class, 'register'])->name('surface_user_register');

//Add post
Route::controller(AdController::class)->group(function(){
    route::post('ads', 'index');
    route::post('ad', 'show');
});

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/surface-user-logout', [SurfaceUserAuthController::class, 'logout'])->name('surface_user_logout');
});

//This will be POST when making functional, just work on the index function
Route::get('search', [SearchController::class, 'index']);


//Do not uncomment this require/import
// require __DIR__.'/ml.php';
