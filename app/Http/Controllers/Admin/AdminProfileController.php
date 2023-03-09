<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\WebAlertTrait;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use File;
use Image;

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
        $admin = User::find($auth_admin->id);

        $this->validate($request, [
            'name' =>'required',
            'email' =>'required|email|unique:users,email',
            'phone' => 'unique:users,phone|max:15',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->current_address = $request->current_address;
        $admin->permanent_address = $request->permanent_address;

        $admin->save();
        return redirect()->back()->with('alert', $this->successAlert('Profile is Updated Successfully!!'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateImage(Request $request)
    {
        $auth_admin = Auth::user();
        $admin = User::find($auth_admin->id);

        if($request->hasFile('image')){
            if(file_exists(public_path($admin->image))){
                File::delete(public_path($admin->image));
                $location  = User::ADMIN_IMAGE_DIR;
                $imageFile = $request->file('image');
                $imageName = mt_rand(10000, 99999).'_image.'.$imageFile->getClientOriginalExtension();
                Image::make($imageFile)->resize(200,200)->save($location.$imageName);
                $admin->image = $location.$imageName;
                $admin->save();
                return redirect()->back()->with('alert', $this->successAlert('Image is Updated Successfully!!'));
            }
            else{
                $location  = User::ADMIN_IMAGE_DIR;
                $imageFile = $request->file('image');
                $imageName = mt_rand(10000, 99999).'_image.'.$imageFile->getClientOriginalExtension();
                Image::make($imageFile)->resize(200,200)->save($location.$imageName);
                $admin->image = $location.$imageName;
                $admin->save();
                return redirect()->back()->with('alert', $this->successAlert('Image is Updated Successfully!!'));
            }

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePassword(Request $request)
    {
        $auth_admin = Auth::user();
        $admin = User::find($auth_admin->id);

        $this->validate($request, [
            'current_password' =>'required',
            'new_password' =>'required',
            'password' => 'required',
        ]);

        
    }

}
