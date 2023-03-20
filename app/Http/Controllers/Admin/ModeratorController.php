<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ModeratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $moderators = DB::table('users')
            ->where('role', 'moderator')
            ->orderBy('id', 'desc');

            $data = DataTables::of($moderators)
                    ->editColumn('id', '<span class="badge badge-dark">#{{$id}}</span>')
                    ->editColumn('image', function ($row) {
                        $image = is_null($row->image) ? 'images/no-image.jpg' : $row->image;

                        return '<img src="'.asset($image).'" alt="" class="table-image">';
                    })
                    ->editColumn('locked', function ($row){
                        $status = $row->locked == 0 ? 'YES' : 'NO';
                        $color = ['YES'=> 'danger', 'NO'=> 'success'];
                        return '<span class="badge badge-'.$color[$status].'">'.$status.'</span>';
                    })
                    ->editColumn('online', function ($row){
                        $status = $row->online == 1 ? 'YES' : 'NO';
                        $color = ['NO'=> 'danger', 'YES'=> 'success'];
                        return '<span class="badge badge-'.$color[$status].'">'.$status.'</span>';
                    })
                    ->addColumn('account', function ($row){
                        return '<a href="'.route('admin.manage.moderators.single', ['id'=>$row->id]).'" class="btn btn-sm btn-primary"><i class="fas fa-tools"></i>&ensp;Manage</a>';
                    })
                    ->rawColumns([
                    'id',
                    'image',
                    'locked',
                    'online',
                    'account'])
                    ->make(true);

            return $data;
        }
        return view('backend.admin.moderators.all');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.moderators.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('backend.admin.moderators.single');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
