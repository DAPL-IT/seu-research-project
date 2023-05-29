<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\SurfaceUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = SurfaceUser::where('email', $request->email)->first();
        $user->tokens()->delete();
        $response = [
            'message' => 'Logged Out'
        ];

        return response()->json($response, 200);
    }
}
