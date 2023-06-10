<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\District;
use App\Traits\WebAlertTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class AreaController extends Controller
{
    use WebAlertTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $districts = District::orderBy('name', 'asc')->get();

        if($districts->count()==0){
            return redirect()->route('admin.manage.districts.all')->with('alert', $this->warningAlert('Please Add Districts First!'));
        }

        if($request->ajax()){
            $areas = Area::with('district');
            $data = DataTables::of($areas)
                    ->editColumn('id', '<span class="badge badge-dark">#{{$id}}</span>')
                    ->addColumn('district', function($row){
                        return $row->district->name;
                    })
                    ->addColumn('action', function ($row){
                        $edit = '<button class="btn btn-sm btn-primary edit-btn" data-toggle="modal" data-target="#areaModal" id="'.$row->id.'" >
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
        return view('backend.admin.areas.all', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3|max:100',
            'district_id' => 'required|integer',
        ]);

        Area::updateOrCreate([
            'name' => $request->name,
            'district_id' => $request->district_id,
        ],['slug' => Str::slug($request->name)]);

        return back()->with('alert', $this->successAlert('Area Added Successfully!'));
    }

    public function bulkStore(Request $request){
        $request->validate([
            'json_file' => 'required|file|mimes:json',
            'district_id' => 'required|integer|',
            ],
            ['json_file.mimes' => 'The file must be a JSON file!']);

        $json_file_arr = json_decode(file_get_contents($request->file('json_file')));
        $district_arr = array();

        foreach($json_file_arr as $value){
            $district_arr[] = [
                'name' => $value->name,
                'slug' => Str::slug($value->name),
                'district_id' => $request->district_id,
            ];
        }

        foreach(array_chunk($district_arr, 50) as $chunk){
           Area::upsert($chunk, ['name', 'slug', 'district_id']);
        }

        return back()->with('alert', $this->successAlert('Bulk Insertion Operation Performed Successfully!'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $area = Area::find($id);
        if(is_null($area)){
            return response()->json(['msg' => 'Area Not Found!'], 404);
        }
        return response()->json($area, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $area = Area::find($id);

        $request->validate([
            'name'=>'required|min:3|max:100',
            'district_id' => 'required|integer',
        ]);

        $areaSlug = Str::slug($request->name);

        $areaExists = Area::where('slug', $areaSlug)
        ->where('district_id', $request->district_id)
        ->whereNot('id', $area->id)
        ->first();

        if($areaExists){
            return back()->with('alert', $this->errorAlert('This area with the district name already exists!'));
        }

        $area->name = $request->name;
        $area->district_id = $request->district_id;
        $area->slug = $areaSlug;
        $area->save();

        if(!$area->wasChanged()){
            return back()->with('alert', $this->infoAlert('No Change!'));
        }

        return back()->with('alert', $this->successAlert('Area Updated Successfully!'));
    }

}
