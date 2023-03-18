<?php

use Illuminate\Support\Facades\Route;


require __DIR__.'/admin.php';
require __DIR__.'/moderator.php';

require __DIR__.'/surface_user.php';


/* INITIAL TEST ROUTES START */
Route::get('/', function () {
    return view('welcome');
});



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
