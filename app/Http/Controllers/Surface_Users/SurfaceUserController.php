<?php

namespace App\Http\Controllers\Surface_Users;

use App\Http\Controllers\Controller;
use App\Models\SurfaceUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class SurfaceUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if($request->ajax()){
            $users = DB::table('surface_users')
            ->where('locked', 0)
            ->orderBy('id', 'desc');

            $data = DataTables::of($users)
                    ->editColumn('id', '<span class="badge badge-dark">#{{$id}}</span>')
                    ->addColumn('account', function ($row){
                        return '<a href="'.route('users.single', ['role'=>Auth::user()->role, 'id'=>$row->id]).'" class="btn btn-sm btn-primary"><i class="fas fa-tools"></i>&ensp;Manage</a>';
                    })
                    ->rawColumns([
                    'id',
                    'account'
                    ])
                    ->make(true);

            return $data;
        }
        return view('backend.surface_users.all');
    }

        /**
     * Display a listing of the resource.
     */
    public function lockedUsers(Request $request)
    {

        if($request->ajax()){
            $users = DB::table('surface_users')
            ->where('locked', 1)
            ->orderBy('id', 'desc');

            $data = DataTables::of($users)
                    ->editColumn('id', '<span class="badge badge-dark">#{{$id}}</span>')
                    ->addColumn('account', function ($row){
                        return '<a href="'.route('users.single', ['role'=>Auth::user()->role, 'id'=>$row->id]).'" class="btn btn-sm btn-primary"><i class="fas fa-tools"></i>&ensp;Manage</a>';
                    })
                    ->rawColumns([
                    'id',
                    'account'
                    ])
                    ->make(true);

            return $data;
        }
        return view('backend.surface_users.locked');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        return view('backend.surface_users.single');
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
