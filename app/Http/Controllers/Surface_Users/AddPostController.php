<?php

namespace App\Http\Controllers\Surface_Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentAd;

class AddPostController extends Controller
{
    public function getAddPost ()
    {
        $add_posts = RentAd::paginate(25);
        return response()->json(['data' => $add_posts], 200);
    }
}
