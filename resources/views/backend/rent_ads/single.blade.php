@extends('backend.layout')

@section('title')
Manage Rent Ad
@endsection

@section('panel_title')
Manage Rent Ad
@endsection

@section('main')
<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-center align-items-center flex-column">
                    <div class="rent-ad-image-container">
                        <img src="{{asset('images/no-image.jpg')}}" alt="ad_image" class="img-fluid">
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                  <span class="font-weight-bold">Title:</span>
                  <span class="text-break"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Price:</span>
                    <span class="text-break"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Type:</span>
                    <span class="text-break"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Rooms:</span>
                    <span class="text-break"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Bathrooms:</span>
                    <span class="text-break"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Floor:</span>
                    <span class="text-break"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Status:</span>
                    <span class="text-break">
                        <span class="badge badge-success">Approved</span>
                        <span class="badge badge-danger">Rejected</span>
                        <span class="badge badge-info">Pending</span>
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">District:</span>
                    <span class="text-break">

                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Area:</span>
                    <span class="text-break">
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Full Address:</span>
                    <span class="text-break"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Posted By:</span>
                    <span class="text-break"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Date Posted:</span>
                    <span class="text-break"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Last Updated:</span>
                    <span class="text-break"></span>
                </li>
                <li class="list-group-item d-flex flex-column">
                    <span class="font-weight-bold mb-2">Description:</span>
                    <span class="text-break"></span>
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
            <form action="{{route('manage.rent_ads.update', ['role'=>Auth::user()->role, 'id'=>$rentAd->id])}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">--SELECT--</option>
                        <option value="1">Approved</option>
                        <option value="2">Pending</option>
                        <option value="0">Rejected</option>
                        <option value="3">Modifications Required</option>
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
