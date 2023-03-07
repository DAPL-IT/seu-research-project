<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\WebAlertTrait;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{

    use WebAlertTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.admin.profile.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('backend.admin.profile.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateGeneral(Request $request)
    {
        // ONLY DEMO
        // $this->validate($request, [
        //     'name' =>'required',
        //     'email' =>'required|email|unique:users,email',
        // ]);

        // return redirect()->back()->with('alert', $this->successAlert('Hello'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateImage(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePassword(Request $request)
    {
        //
    }

}
