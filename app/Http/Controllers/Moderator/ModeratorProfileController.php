<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\WebAlertTrait;
use Illuminate\Support\Str;
use App\Models\User;
use Auth;
use Image;

class ModeratorProfileController extends Controller
{
    use WebAlertTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth_moderator = Auth::user();
        return view('backend.moderator.profile.show', compact('auth_moderator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $auth_moderator = Auth::user();
        return view('backend.moderator.profile.edit', compact('auth_moderator'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateGeneral(Request $request)
    {
        $auth_moderator = Auth::user();
        $moderator = User::where('id', $auth_moderator->id)->firstOrFail();

        $request->validate([
            'name' =>'required|min:3|max:150',
            'email' =>'required|email|unique:users,email,'.$auth_moderator->id,
            'phone' => 'required|max:15|unique:users,phone,'.$auth_moderator->id,
            'current_address' => 'required|max:250',
            'permanent_address' => 'nullable|max:250'
        ]);

        $moderator->name = $request->name;
        $moderator->email = $request->email;
        $moderator->phone = $request->phone;
        $moderator->current_address = $request->current_address;
        $moderator->permanent_address = $request->permanent_address;

        $moderator->save();

        if(!$moderator->wasChanged()){
            return redirect()
            ->route('moderator.profile.show')
            ->with('alert', $this->infoAlert('No Changes were Made!'));
        }

        return redirect()
        ->route('moderator.profile.show')
        ->with('alert', $this->successAlert('Profile is Updated Successfully!!'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateImage(Request $request)
    {
        $auth_moderator = Auth::user();
        $moderator = User::where('id', $auth_moderator->id)->firstOrFail();

        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|min:1|max:5121'
        ]);

        if(file_exists($moderator->image)){
            unlink($moderator->image);
        }

        $location  = User::MODERATOR_IMAGE_DIR;
        $imageFile = $request->file('image');
        $imageName = Str::random(16).'_dt_'.date('Ymd_His').'.'.$imageFile->getClientOriginalExtension();

        Image::make($imageFile)
        ->fit(150,150, function($constraint){
            $constraint->upsize();
        })->save($location.$imageName);

        $moderator->image = $location.$imageName;

        $moderator->save();

        return redirect()
        ->route('moderator.profile.show')
        ->with('alert', $this->successAlert('Profile Image is Updated Successfully!!'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePassword(Request $request)
    {
        $auth_moderator = Auth::user();
        $moderator = User::find($auth_moderator->id);

        $this->validate($request, [
            'current_password' =>'required',
            'new_password' =>'required',
            'password' => 'required',
        ]);

            if (password_verify($request->current_password, $moderator->password)){
                if($request->new_password==$request->password){
                    $moderator->password=bcrypt($request->new_password);
                    $moderator->update();
                    return redirect()
                    ->route('moderator.profile.show')
                    ->with('alert', $this->successAlert('Password is Updated Successfully!!'));
                }
                else{
                    return redirect()->back()
                    ->with('alert', $this->errorAlert('Password Confirmation is wrong!!'));
                }
            }
            else{
                return redirect()->back()->with('alert', $this->errorAlert('Current Password did not match!!'));
            }
    }
}
