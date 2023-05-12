<?php

namespace App\Http\Controllers\Rent_Ads;

use App\Http\Controllers\Controller;
use App\Models\RentAd;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Traits\WebAlertTrait;

class RentAdController extends Controller
{
    use WebAlertTrait;

    private $status = [
        'rejected' => 0,
        'approved' => 1,
        'pending'  => 2,
    ];
    /**
     * Display a listing of the resource.
     */
    public function getAllForAdmin(Request $request)
    {
        $requestStatus = $request->status;

        if(!(array_key_exists($requestStatus, $this->status))){
            return redirect()->back();
        }

        $approvedRentAds = RentAd::where('status', $this->status[$requestStatus])
        ->orderBy('id', 'desc')
        ->with('rent_type', 'poster', 'moderator', 'area');

        if($request->ajax()){

            $data = DataTables::of($approvedRentAds)
                    ->editColumn('id', '<span class="badge badge-dark">#{{$id}}</span>')
                    ->editColumn('title', '{{substr($title, 0, 15)}}...')
                    ->addColumn('rent_type', function($row){
                        return $row->rent_type->type;
                    })
                    ->addColumn('area', function($row){
                        return $row->area->name;
                    })
                    ->addColumn('poster', function($row){
                        $profile = '<a href="'.route('users.single', ['role'=>Auth::user()->role, 'id'=>$row->poster->id]).'">'.$row->poster->email.'</a>';
                        return $profile;
                    })
                    ->addColumn('moderator', function($row){
                        $profile = '<a class="badge badge-secondary" href="'.route('admin.manage.moderators.single', ['id'=>$row->moderator->id]).'">#MID-'.$row->moderator->id.'</a>';
                        return $profile;
                    })
                    ->addColumn('action', function($row){
                        $manage = '<a href="'.route('manage.rent_ads.show', ['role'=>Auth::user()->role,'id'=>$row->id]).'" class="btn btn-sm btn-primary"><i class="fas fa-tools"></i>&ensp;Manage</a>';

                        return $manage;
                    })
                    ->rawColumns([
                    'id',
                    'poster',
                    'moderator',
                    'action'
                    ])
                    ->make(true);

            return $data;
        }
        return view('backend.rent_ads.all_for_admin', compact('requestStatus'));
    }

    public function getAllForModerator(Request $request){
        $requestStatus = $request->status;

        if(!(array_key_exists($requestStatus, $this->status))){
            return redirect()->back();
        }

        $approvedRentAds = RentAd::where('status', $this->status[$requestStatus])
        ->where('moderator_id', Auth::user()->id)
        ->orderBy('id', 'desc')
        ->with('rent_type', 'poster', 'area');

        if($request->ajax()){

            $data = DataTables::of($approvedRentAds)
                    ->editColumn('id', '<span class="badge badge-dark">#{{$id}}</span>')
                    ->editColumn('title', '{{substr($title, 0, 15)}}...')
                    ->addColumn('rent_type', function($row){
                        return $row->rent_type->type;
                    })
                    ->addColumn('area', function($row){
                        return $row->area->name;
                    })
                    ->addColumn('poster', function($row){
                        $profile = '<a href="'.route('users.single', ['role'=>Auth::user()->role, 'id'=>$row->poster->id]).'">'.$row->poster->email.'</a>';
                        return $profile;
                    })
                    ->addColumn('action', function($row){
                        $manage = '<a href="'.route('manage.rent_ads.show', ['role'=>Auth::user()->role,'id'=>$row->id]).'" class="btn btn-sm btn-primary"><i class="fas fa-tools"></i>&ensp;Manage</a>';

                        return $manage;
                    })
                    ->rawColumns([
                    'id',
                    'poster',
                    'action'
                    ])
                    ->make(true);

            return $data;
        }
        return view('backend.rent_ads.all_for_moderator', compact('requestStatus'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {   $requestId = $request->id;
        $rentAd = RentAd::with('rent_type', 'poster', 'moderator', 'area')->findOrFail($requestId);
        //dd($rentAd);
        return view('backend.rent_ads.single', compact('rentAd'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $requestId = $request->id;
        $rentAd = RentAd::findOrFail($requestId);
        $rentAd->status = $request->status;
        $rentAd->save();
        return redirect()->back()->with('alert', $this->successAlert('Updated Successfully!!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
