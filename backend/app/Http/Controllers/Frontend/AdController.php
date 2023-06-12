<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RentAd;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

    public function create (Request $request )
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:4|max:100',
            'price' => 'required|numeric',
            'rooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'floor' => 'required|integer',
            'full_address' => 'required',
            'description' => 'required',
            'rent_type_id' => 'required',
            'area_id' => 'required',
        ]);

        if($validator->fails()){
            $response = ['validation' => $validator->errors()];
            return response()->json($response, 422);
        }

        $user = Auth::user();
        $rent_ad = new RentAd();
        $rent_ad->title = $request->title;
        $rent_ad->price = $request->price;
        $rent_ad->rooms = $request->rooms;
        $rent_ad->bathrooms = $request->bathrooms;
        $rent_ad->floor = $request->floor;
        $rent_ad->square_feet = $request->square_feet;
        $rent_ad->full_address = $request->full_address;
        $rent_ad->description = $request->description;
        $rent_ad->is_featured = $request->is_featured;
        $rent_ad->sold_on_site = $request->sold_on_site;
        $rent_ad->map_url = $request->map_url;
        $rent_ad->video_url = $request->video_url;
        $rent_ad->rent_type_id  = $request->rent_type_id;
        $rent_ad->area_id = $request->area_id;
        $rent_ad->poster_id = $user->id;

        //Assign Random moderator...
        $moderatorIds = User::where('role', 'moderator')->where('locked', 0)->pluck('id');
        $randomModeratorId = User::select(DB::raw('FLOOR(RAND() * COUNT(*)) as random_id'))->value('random_id');
        $randomModerator = User::where('id', $randomModeratorId)->first();
        if($randomModerator){
            $rent_ad->moderator_id  = $randomModerator->id;
        }
        //Assign Random moderator...

        //Image Upload...
        if($request->hasFile('image')){
            $location  = RentAd::IMAGE_DIR;
            $imageFile = $request->file('image');
            $imageName = Str::random(16).'_dt_'.date('Ymd_His').'.'.$imageFile->getClientOriginalExtension();

            Image::make($imageFile)
            ->fit(150,150, function($constraint){
                $constraint->upsize();
            })->save($location.$imageName);

            $rent_ad->image = $location.$imageName;
        }
        //Image Upload...

        $rent_ad->save();

        return response()->json(['message' => 'Created Successfully',], 200);
    }

}
