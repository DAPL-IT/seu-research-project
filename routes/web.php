<?php

use Illuminate\Support\Facades\Route;


require __DIR__.'/admin.php';
require __DIR__.'/moderator.php';

require __DIR__.'/surface_user.php';
require __DIR__.'/rent_ads.php';

Route::get('/{any}', function () {
    return view('index');
})->where('any', '^(?!cms\/).*');


require __DIR__.'/auth.php';
