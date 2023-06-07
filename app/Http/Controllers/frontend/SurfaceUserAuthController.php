<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\SurfaceUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class SurfaceUserAuthController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['validation'=>$validator->errors()], 422);
        }

        $authAttempt = Auth::guard('surface_user')->attempt([
            'email'=> $request->email,
            'password'=>$request->password
        ]);


        if(!$authAttempt){
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user  = SurfaceUser::where('email', $request->email)->first();

        if($user->locked==1){
            return response()->json(['message' => 'Your ID is Locked!'], 401);
        }

        $token = $user
                ->createToken('surface_user_auth_token')
                ->plainTextToken;

        return response()->json([
            'message' => 'Logged In',
            'surface_user' => $user->only(["id",
            "name",
            "email",
            "phone",
            "image",
            "locked",
            "online"]),
            'surface_user_auth_token' => $token
        ], 200);

    }

    public function logout(Request $request){
        $user = Auth::user();
        $user->tokens()->delete();
        Auth::guard('surface_user')->logout();

        $response = ['message' => 'Logged Out'];

        return response()->json($response, 200);
    }

    public function register (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:surface_users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'validation' => $validator->errors()
            ];
            return response()->json($response, 422);
        }

        $input = $request->all();

        if($request->hasFile('image')){
            $location  = SurfaceUser::SURFACE_USER_IMAGE_DIR;
            $imageFile = $request->file('image');
            $imageName = Str::random(16).'_dt_'.date('Ymd_His').'.'.$imageFile->getClientOriginalExtension();

            Image::make($imageFile)
            ->fit(150,150, function($constraint){
                $constraint->upsize();
            })->save($location.$imageName);

            $input['image'] = $location.$imageName;
        }

        $input['password'] = bcrypt($input['password']);
        $user = SurfaceUser::create($input);

        $token = $user
                ->createToken('surface_user_auth_token')
                ->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registered Successfully',
            'surface_user' => $user->only(["id",
            "name",
            "email"]),
            'surface_user_auth_token' => $token
        ], 200);
    }
}
