<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Traits\WebAlertTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class DistrictController extends Controller
{
    use WebAlertTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $districts = DB::table('districts');

            $data = DataTables::of($districts)
                    ->editColumn('id', '<span class="badge badge-dark">#{{$id}}</span>')
                    ->addColumn('action', function ($row){
                        $edit = '<button class="btn btn-sm btn-primary edit-btn" data-toggle="modal" data-target="#districtModal" id="'.$row->id.'" >
                        <i class="fas fa-edit"></i>&ensp;Edit
                    </button>';

                        return $edit;
                    })
                    ->rawColumns([
                    'id',
                    'action'])
                    ->make(true);

            return $data;
        }
        return view('backend.admin.districts.all');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required|min:3|max:50|unique:districts,name']);
        $district = new District();
        $district->name = $request->name;
        $district->slug = Str::slug($request->name);
        $district->save();

        return back()->with('alert', $this->successAlert('District Added Successfully!'));
    }

    public function bulkStore(Request $request){
        $request->validate([
            'json_file' => 'required|file|mimes:json'],
            ['json_file.mimes' => 'The file must be a JSON file!']);

        $json_file_arr = json_decode(file_get_contents($request->file('json_file')));
        $district_arr = array();

        foreach($json_file_arr as $value){
            $district_arr[] = [
                'name' => $value->name,
                'slug' => Str::slug($value->name),
            ];
        }

        foreach(array_chunk($district_arr, 30) as $chunk){
           District::upsert($chunk, ['name', 'slug']);
        }

        return back()->with('alert', $this->successAlert('Bulk Insertion Operation Performed Successfully!'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $district = District::find($id);
        if(is_null($district)){
            return response()->json(['msg' => 'District Not Found!'], 404);
        }
        return response()->json($district, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $district = District::findOrFail($id);
        $request->validate([
            'name'=>'required|min:3|max:50|unique:districts,name,'.$district->id
        ]);

        $district->name = $request->name;
        $district->save();

        if(!$district->wasChanged()){
            return back()
            ->with('alert', $this->infoAlert('No Change!'));
        }

        return back()
        ->with('alert', $this->successAlert('Updated Successfully!'));
    }
}
