@extends('backend.layout')

@section('title')
Manage Rent Ad
@endsection

@section('panel_title')
Manage Rent Ad
@endsection

@section('main')
<div class="col-lg-7">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-center align-items-center flex-column">
                    <div class="rent-ad-image-container">
                        @if ($rentAd->image != null)
                        <img src="{{asset('images/rentAds/'.$rentAd->image)}}" alt="ad_image" class="img-fluid">
                        @else
                        <img src="{{asset('images/no-image.jpg')}}" alt="ad_image" class="img-fluid">
                        @endif
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                  <span class="font-weight-bold">Title: {{ $rentAd->title }}</span>
                  <span class="text-break"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Price:</span>
                    <span class="text-break"> {{ $rentAd->price }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Type:</span>
                    <span class="text-break"> {{ $rentAd->rent_type->type }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Rooms:</span>
                    <span class="text-break"> {{ $rentAd->rooms }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Bathrooms:</span>
                    <span class="text-break"> {{ $rentAd->bathrooms }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Floor:</span>
                    <span class="text-break"> {{ $rentAd->floor }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Status:</span>
                    <span class="text-break">
                        @if ($rentAd->status == 1)
                        <span class="badge badge-success">Approved</span>
                        @elseif ($rentAd->status == 2)
                        <span class="badge badge-danger">Rejected</span>
                        @elseif ($rentAd->status == 0)
                        <span class="badge badge-info">Pending</span>
                        @else
                        <span class="badge badge-warning">Modifications Required</span>
                        @endif
                    </span>
                </li>

                <li class="list-group-item d-flex flex-column">
                    <span class="font-weight-bold">Address:</span>
                    <span class="text-break">District: {{ $rentAd->area->district->name }}, Area: {{ $rentAd->area->name }}, Location: {{ $rentAd->full_address }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Posted By:</span>
                    <span class="text-break">{{ $rentAd->poster->name }}</span>
                </li>
                <li class="list-group-item d-flex align-items-center flex-lg-row flex-column">
                    <span class="font-weight-bold">Timeline:</span>
                    <span class="text-break">
                        <span class="badge badge-primary ml-2">Posted: {{ date('d/m/y',strtotime($rentAd->created_at)) }}</span>
                    </span>
                    <span class="text-break">
                        <span class="badge badge-primary ml-2">Updated: {{ date('d/m/y',strtotime($rentAd->updated_at)) }}</span>
                    </span>
                </li>
                <li class="list-group-item d-flex flex-column">
                    <span class="font-weight-bold mb-2">Externals:</span>
                    <span class="text-break">
                        <small>Video URL:&ensp; <a href="{{ $rentAd->video_url }}">Link Here</a> </small>
                    </span>
                    <span class="text-break">
                        <small>Map URL:&ensp; <a href="{{ $rentAd->map_url }}">Link Here</a> </small>
                    </span>
                </li>
                <li class="list-group-item d-flex flex-column">
                    <span class="font-weight-bold mb-2">Description:</span>
                    <span class="text-break">{{ $rentAd->description }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="col-lg-5">
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
                        @if ($rentAd->status == 0)
                        <option value="0" selected>Pending</option>
                        <option value="1">Approved</option>
                        <option value="2">Rejected</option>
                        <option value="3">Modifications Required</option>
                        @elseif ($rentAd->status == 1)
                        <option value="0">Pending</option>
                        <option value="1" selected>Approved</option>
                        <option value="2">Rejected</option>
                        <option value="3">Modifications Required</option>
                        @elseif ($rentAd->status == 2)
                        <option value="0">Pending</option>
                        <option value="1">Approved</option>
                        <option value="2" selected>Rejected</option>
                        <option value="3">Modifications Required</option>
                        @elseif ($rentAd->status == 3)
                        <option value="0">Pending</option>
                        <option value="1">Approved</option>
                        <option value="2">Rejected</option>
                        <option value="3" selected>Modifications Required</option>
                        @else
                        <option value="">--SELECT--</option>
                        <option value="1">Approved</option>
                        <option value="2">Pending</option>
                        <option value="0">Rejected</option>
                        <option value="3">Modifications Required</option>
                        @endif
                    </select>
                </div>
                <div class="form-group mt-3">
                    <a href="" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash"></i>&ensp;Delete Ad</a>
                    <button class="btn btn-primary btn-sm " type="submit"><i class="fas fa-edit"></i>&ensp;Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('extra_scripts')
<script>
$(document).ready(function(){

    $('.delete-btn').on('click', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');

        Swal.fire({
            title: 'Want to Delete?',
            text: "You won't be able to revert this operation!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});
</script>

@endsection
