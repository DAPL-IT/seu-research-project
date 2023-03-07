<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModeratorProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.moderator.profile.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('backend.moderator.profile.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateGeneral(Request $request)
    {
        //
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
