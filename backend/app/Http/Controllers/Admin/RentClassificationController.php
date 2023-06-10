<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentClassification;
use App\Traits\WebAlertTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RentClassificationController extends Controller
{
    use WebAlertTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rentClassifications = RentClassification::orderBy('from', 'asc')->get();
        return view('backend.admin.rent_classifications.all', compact('rentClassifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'classification' => 'required|min:3|max:100|unique:rent_classifications,classification',
            'from' => 'required|integer|min:0|lt:to',
            'to' => 'required|integer|min:0|gt:from'
        ],
        [
            'from.lt' => 'Taka From should be less than Taka To',
            'to.gt' => 'Taka To should be greater than Taka From',
        ]);

        $rentClassification = new RentClassification();
        $rentClassification->classification = $request->classification;
        $rentClassification->from = $request->from;
        $rentClassification->to = $request->to;
        $rentClassification->slug = Str::slug($request->classification);

        $rentClassification->save();

        return back()
        ->with('alert', $this->successAlert('Created Successfully!'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rentClassification = RentClassification::find($id);
        if(is_null($rentClassification)){
            return response()->json(['msg' => 'Classification Not Found!'], 404);
        }
        return response()->json($rentClassification, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rentClassification = RentClassification::findOrFail($id);
        $request->validate([
            'classification' => 'required|min:3|max:100|unique:rent_classifications,classification,'.$id,
            'from' => 'required|integer|min:0|lt:to',
            'to' => 'required|integer|min:0|gt:from'
        ],
        [
            'from.lt' => 'Taka From should be less than Taka To',
            'to.gt' => 'Taka To should be greater than Taka From',
        ]);

        $rentClassification->classification = $request->classification;
        $rentClassification->from = $request->from;
        $rentClassification->to = $request->to;
        $rentClassification->slug = Str::slug($request->classification);
        $rentClassification->save();

        if(!$rentClassification->wasChanged()){
            return back()
            ->with('alert', $this->infoAlert('No Change!'));
        }

        return back()
        ->with('alert', $this->successAlert('Updated Successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rentClassification = RentClassification::findOrFail($id);
        $rentClassification->delete();
        return back()
        ->with('alert', $this->successAlert('Delete Successfully!'));
    }
}
