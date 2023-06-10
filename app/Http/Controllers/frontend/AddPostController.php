<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentAd;

class AddPostController extends Controller
{
    public function getAddPost ()
    {
        $add_posts = RentAd::orderBy('id','desc')->paginate(25);
        return response()->json(['data' => $add_posts], 200);
    }

    public function getSingleAddPost ($id)
    {
        $add_post = RentAd::with('poster', 'area')->findOrFail($id);
        return response()->json(['data' => $add_post], 200);
    }
}
