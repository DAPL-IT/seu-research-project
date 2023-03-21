<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\WebAlertTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ModeratorController extends Controller
{
    use WebAlertTrait;
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
                        $status = $row->locked == 0 ? 'NO' : 'YES';
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
        $request->validate([
            'name' =>'required|min:3|max:150',
            'email' =>'required|email|unique:users,email',
            'phone' => 'required|max:15|unique:users,phone',
            'nid' => 'nullable|max:13|unique:users,nid',
            'password' => 'required|min:8|max:32',
            'current_address' => 'required|max:250',
            'permanent_address' => 'nullable|max:250'
        ]);

        $moderator = new User();
        $moderator->name = $request->name;
        $moderator->email = $request->email;
        $moderator->phone = $request->phone;
        $moderator->nid = $request->nid;
        $moderator->password = Hash::make($request->password);
        $moderator->current_address = $request->current_address;
        $moderator->permanent_address = $request->permanent_address;
        $moderator->role = 'moderator';

        $moderator->save();

        return redirect()->route('admin.manage.moderators.all')
        ->with('alert',$this->successAlert('Moderator is created Successfully!!'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $moderator = User::where('id', $id)->firstOrFail();
        return view('backend.admin.moderators.single', compact('moderator'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $moderator = User::where('id', $id)->firstOrFail();

        $request->validate([
            'locked' =>'required',
            'nid' =>'nullable|max:13|unique:users,nid,'.$moderator->id,
        ]);

        $moderator->nid = $request->nid;
        $moderator->locked = $request->locked;
        $moderator->save();

        if(!$moderator->wasChanged()){
            return back()
            ->with('alert', $this->infoAlert('No Changes were Made!'));
        }

        return back()
        ->with('alert', $this->successAlert('Moderator info is Updated Successfully!!'));

    }

}
