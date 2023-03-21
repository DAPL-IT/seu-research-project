@extends('backend.layout')

@section('title')
Manage User
@endsection

@section('panel_title')
Manage User
@endsection

@section('main')
<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center flex-column">
                    <div class="profile-image-container">
                        @if ($surface_user->image==null)
                        <img src="{{asset('images/no-image.jpg')}}" alt="user_image" class="profile-image img-fluid">
                        @else
                        <img src="{{asset($surface_user->image)}}" alt="user_image" class="profile-image img-fluid">
                        @endif
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                  <span class="font-weight-bold">Name:</span>
                  <span class="text-break">{{ $surface_user->name }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Email:</span>
                    <span class="text-break">{{ $surface_user->email }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Phone:</span>
                    <span class="text-break">{{ $surface_user->phone }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">NID:</span>
                    <span class="text-break">{{ $surface_user->nid }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Account Locked ?:</span>
                    <span class="badge badge-success">
                        @if ($surface_user->locked==1)
                            NO
                        @else
                            YES
                        @endif
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Is Online ?:</span>
                    <span class="badge badge-danger">
                        @if ($surface_user->online==1)
                            YES
                        @else
                            NO
                        @endif
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Joined:</span>
                    <span class="text-break">{{ date('m/d/Y', strtotime($surface_user->created_at)) ?? 'N.A' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold mr-lg-5 mr-0">Current Address:</span>
                    <span class="text-justify">
                        {{ $surface_user->current_address }}
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold mr-lg-5 mr-0">Permanent Address:</span>
                    <span class="text-justify">
                        {{ $surface_user->permanent_address ?? 'N.A' }}
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
        </div>
        {{-- NOTE: id = 1 is a placeholder inside of the route params array, you'll have to pass dynamic data there, e.g. $user->id --}}
        <div class="card-body">
            <form action="{{route('users.update', ['role'=>Auth::user()->role, 'id'=>$surface_user->id])}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="modNid">NID</label>
                    <input type="text" name="nid" value="{{ $surface_user->nid }}" id="modNid" class="form-control">
                </div>
                <div class="form-group">
                    <label for="modAccStatus">Account Status</label>
                   <select name="locked" id="modAccStatus" class="form-control" required>
                    <option @if($surface_user->locked == 0) selected @endif value="0">Locked</option>
                    <option @if($surface_user->locked == 1) selected @endif value="1">Unlocked</option>
                   </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm mt-3 " type="submit"><i class="fas fa-edit"></i>&ensp;Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
