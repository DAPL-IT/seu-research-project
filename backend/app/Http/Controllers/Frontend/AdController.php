<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentAd;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $add_posts = RentAd::with('rent_type', 'area')->orderBy('id','desc')->paginate(27);
        return response()->json(['ads' => $add_posts], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $add_post = RentAd::with('poster', 'area', 'rent_type')
        ->where('id', $request->id)
        ->first();

        if($add_post==null){
            return response()->json(['message'=>'Ad Not Found!'], 404);
        }

        return response()->json(['ad' => $add_post], 200);
    }

}
