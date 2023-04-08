<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\RentType;
use App\Models\Area;
use App\Models\SurfaceUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('/areas', function(){
//     $areas = Area::select('name')->orderBy('name', 'asc')->get();
//     $arr = [];
//     foreach($areas as $area){
//         $arr[] = $area['name'];
//     }

//     return $arr;
// });


// Route::get('/test', function(){
//     $data = User::whereHas('rent_ads')->with('rent_ads')->get();

//     return $data;
// });
