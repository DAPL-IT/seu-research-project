<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\WebAlertTrait;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminProfileController extends Controller
{

    use WebAlertTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth_admin = Auth::user();
        return view('backend.admin.profile.show', compact('auth_admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $auth_admin = Auth::user();
        return view('backend.admin.profile.edit', compact('auth_admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateGeneral(Request $request)
    {
        $auth_admin = Auth::user();
        $admin = User::where('id', $auth_admin->id)->firstOrFail();

        $request->validate([
            'name' =>'required|min:3|max:150',
            'email' =>'required|email|unique:users,email,'.$auth_admin->id,
            'phone' => 'required|max:15|unique:users,phone,'.$auth_admin->id,
            'current_address' => 'required|max:250',
            'permanent_address' => 'nullable|max:250'
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->current_address = $request->current_address;
        $admin->permanent_address = $request->permanent_address;

        $admin->save();

        if(!$admin->wasChanged()){
            return redirect()
            ->route('admin.profile.show')
            ->with('alert', $this->infoAlert('No Changes were Made!'));
        }

        return redirect()
        ->route('admin.profile.show')
        ->with('alert', $this->successAlert('Profile is Updated Successfully!!'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateImage(Request $request)
    {
        $auth_admin = Auth::user();
        $admin = User::where('id', $auth_admin->id)->firstOrFail();

        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|min:1|max:5121'
        ]);

        if(file_exists($admin->image)){
            unlink($admin->image);
        }

        $location  = User::ADMIN_IMAGE_DIR;
        $imageFile = $request->file('image');
        $imageName = Str::random(16).'_dt_'.date('Ymd_His').'.'.$imageFile->getClientOriginalExtension();

        Image::make($imageFile)
        ->fit(150,150, function($constraint){
            $constraint->upsize();
        })->save($location.$imageName);

        $admin->image = $location.$imageName;

        $admin->save();

        return redirect()
        ->route('admin.profile.show')
        ->with('alert', $this->successAlert('Profile Image is Updated Successfully!!'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePassword(Request $request)
    {
        $auth_admin = Auth::user();
        $admin = User::where('id', $auth_admin->id)->firstOrFail();

        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:8|max:32|confirmed',
        ],
        [
            'new_password.confirmed' => 'The new password and Retyped new password did not match',
        ]);

        if(!(Hash::check($request->current_password, $admin->password))){
            return back()->with('alert', $this->errorAlert('Current password was incorrect!'));
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()
        ->route('admin.profile.show')
        ->with('alert',$this->successAlert('Password is Updated Successfully!!'));
    }

}
