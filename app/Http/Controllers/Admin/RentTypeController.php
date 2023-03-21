<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentType;
use App\Traits\WebAlertTrait;
use Illuminate\Http\Request;

class RentTypeController extends Controller
{
    use WebAlertTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rentTypes = RentType::orderBy('status', 'desc')->orderBy('id', 'desc')->get();
        return view('backend.admin.rent_types.all', compact('rentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|min:3|max:100'
        ]);

        $rentType = new RentType();
        $rentType->type = $request->type;
        $rentType->save();

        return back()
        ->with('alert', $this->successAlert('Created Successfully!'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rentType = RentType::findOrFail($id);
        return response()->json($rentType, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rentType = RentType::findOrFail($id);
        $request->validate([
            'type' => 'required|min:3|max:100',
            'status' => 'required|integer|between:0,1',
        ]);

        $rentType->type = $request->type;
        $rentType->status = $request->status;
        $rentType->save();

        if(!$rentType->wasChanged()){
            return back()
            ->with('alert', $this->infoAlert('No Change!'));
        }

        return back()
        ->with('alert', $this->successAlert('Updated Successfully!'));

    }
}
