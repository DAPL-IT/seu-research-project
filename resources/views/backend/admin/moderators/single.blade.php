@extends('backend.layout')

@section('title')
Manage Moderator
@endsection

@section('panel_title')
Manage Moderator
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
                        <img src="{{asset('images/no-image.jpg')}}" alt="" class="profile-image img-fluid">
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                  <span class="font-weight-bold">Name:</span>
                  <span class="text-break">Saleh Ibne Omar</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Email:</span>
                    <span class="text-break">salehibneomar@gmail.com</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Phone:</span>
                    <span class="text-break">+8801700000000</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">NID:</span>
                    <span class="text-break">123456789</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Account Locked ?:</span>
                    <span class="badge badge-success">NO</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Is Online ?:</span>
                    <span class="badge badge-danger">NO</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Joined:</span>
                    <span class="text-break">02/05/2023</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold mr-lg-5 mr-0">Current Address:</span>
                    <span class="text-justify">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio assumenda id, non totam laboriosam expedita cumque incidunt amet facere cupiditate?
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold mr-lg-5 mr-0">Permanent Address:</span>
                    <span class="text-justify">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio assumenda id, non totam laboriosam expedita cumque incidunt amet facere cupiditate?
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
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label for="modNid">NID</label>
                    <input type="text" name="" id="modNid" class="form-control">
                </div>
                <div class="form-group">
                    <label for="modAccStatus">Account Status</label>
                   <select name="" id="modAccStatus" class="form-control" required>
                        <option >--SELECT--</option>
                        <option value="0">Locked</option>
                        <option value="1">Unlocked</option>
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
