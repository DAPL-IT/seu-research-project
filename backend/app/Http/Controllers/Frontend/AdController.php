<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RentAd;
use App\Models\User;
use App\Models\Area;
use App\Models\RentType;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
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
            'rooms' => 'required|integer|gte:bathrooms',
            'bathrooms' => 'required|integer|lte:rooms',
            'floor' => 'required|integer',
            'square_feet' => 'required|integer|min:100',
            'full_address' => 'required',
            'description' => 'required',
            'rent_type_id' => 'required',
            'area_id' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:5121'
        ],[
            'image.max' => 'Maximum image size allowed is 5MB',
            'rooms.gte' => 'Room numbers should be greater than or equal to bathroom numbers',
            'bathrooms.lte' => 'Bathroom numbers should be greater than or equal to room numbers'
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

        $moderator_id = User::where('role', 'moderator')
           ->where('locked', 0)
           ->inRandomOrder()
           ->first()
           ->id;

        $rent_ad->moderator_id = $moderator_id;

        if($request->hasFile('image')){
            $location  = RentAd::IMAGE_DIR;
            $imageFile = $request->file('image');
            $imageName = Str::random(24).'_dt_'.date('Ymd_His').'.'.$imageFile->getClientOriginalExtension();

            Image::make($imageFile)
            ->resize(1920,960)
            ->encode(null, 50)
            ->save($location.$imageName);

            $rent_ad->image = $location.$imageName;
        }

        $rent_ad->save();

        return response()->json(['message' => 'Rent Ad has been created'], 200);
    }

    public function areaList (Request $request)
    {
        $area_list = Area::orderBy('name','asc')->paginate(25);
        return response()->json(['areas' => $area_list], 200);
    }

    public function areaSearch (Request $request)
    {
        $area_list = Area::where('name','LIKE',"%{$request->q}%")->get();
        return response()->json(['areas' => $area_list], 200);
    }

    public function rentTypeList (Request $request)
    {
        $rent_type_list = RentType::orderBy('id','asc')->get();
        return response()->json(['rent_types' => $rent_type_list], 200);
    }

    public function getAdsByUser(Request $request){
        $loggedInUserId = Auth::user()->id;
        $ads = RentAd::where('poster_id', $loggedInUserId)
                     ->orderBy('id','desc')
                     ->get();

        return response()->json(['ads'=>$ads], 200);
    }

    public function deleteByUser(Request $request){

        $loggedInUserId = Auth::user()->id;
        $ad = RentAd::where('poster_id', $loggedInUserId)
                    ->where('id', $request->id)
                    ->first();

        if($ad == null){
            return response()->json(['error'=>'Not Found!'], 404);
        }

        if(str_contains($ad->image, 'demo.jpg') == false && file_exists($ad->image)){
            unlink($ad->image);
        }

        $ad->delete();

        return response()->json(['message'=>'Ad Deleted!'], 200);
    }

}
