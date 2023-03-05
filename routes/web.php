<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Moderator\ModeratorDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::prefix('/admin')
->middleware('role:admin')
->name('admin.')
->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});

Route::prefix('/moderator')
->middleware('role:moderator')
->name('moderator.')
->group(function () {
    Route::get('/dashboard', [ModeratorDashboardController::class, 'index'])->name('dashboard');
});


/* INITIAL TEST ROUTES START */
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/dashboard', function (){
//     return "HELLO ADMIN";
// });


// Route::get('/moderator/dashboard', function (){
//     return "HELLO MODERATOR";
// });

// Route::get('/management/login', function (){
//     return view('auth.management_login');
// });
/* INITIAL TEST ROUTES END */

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
