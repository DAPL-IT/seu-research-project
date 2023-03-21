<?php

namespace App\Http\Controllers\Surface_Users;

use App\Http\Controllers\Controller;
use App\Models\SurfaceUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\WebAlertTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class SurfaceUserController extends Controller
{
    use WebAlertTrait;
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
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user_id = $request->id;
        $surface_user = SurfaceUser::where('id', $user_id)->firstOrFail();
        return view('backend.surface_users.single', compact('surface_user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user_id = $request->id;
        $surface_user = SurfaceUser::where('id', $user_id)->firstOrFail();

        $request->validate([
            'locked' =>'required',
            'nid' =>'nullable|max:13|unique:surface_users,nid,'. $surface_user->id,
        ]);

        $surface_user->nid = $request->nid;
        $surface_user->locked = $request->locked;
        $surface_user->save();

        if(!$surface_user->wasChanged()){
            return redirect()
            ->back()
            ->with('alert', $this->infoAlert('No Changes were Made!'));
        }

        return redirect()
        ->back()
        ->with('alert', $this->successAlert('User info is Updated Successfully!!'));
    }

}
