<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* INITIAL TEST ROUTES START */
Route::get('/', function () {
    return view('welcome');
});

Route::get('/blank', function () {
    return view('backend.blank');
});

Route::get('/admin/profile', function () {
    return view('backend.admin.profile.show');
});

Route::get('/admin/dashboard', function (){
    return "HELLO ADMIN";
});

Route::get('/moderator/dashboard', function (){
    return "HELLO MODERATOR";
});

/* INITIAL TEST ROUTES END */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
