@extends('backend.layout')

@section('title')
Profile
@endsection

@section('panel_title')
Profile
@endsection

@section('main')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-xl-6 mb-xl-0 mb-4">
                    <div class="d-md-flex align-items-center">
                        <div class="mr-md-4 mr-0 mb-md-0 mb-4">
                            <div class="profile-image-container">
                                <img class="profile-image img-fluid" src="@if (is_null(Auth::user()->image))
                                {{asset('images/no-image.jpg')}}
                                @else
                                {{asset(Auth::user()->image)}}
                            @endif" alt="profile_image" />
                            </div>
                        </div>
                        <div >
                            <h2 class="m-b-5">{{ $auth_admin->name }}</h2>
                            <p class="text-opacity font-size-13">@ {{ strtoupper($auth_admin->role) }}</p>
                            {{--  <p class="text-dark m-b-20">Frontend Developer, UI/UX Designer</p>  --}}
                            <a href="{{route('admin.profile.edit')}}" class="btn btn-primary btn-tone btn-sm"><i class="fas fa-edit"></i>&ensp;EDIT</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="row">
                        <div class="d-xl-none d-block border-top col-12 mb-xl-0 mb-4"></div>
                        <div class="d-xl-block d-none border-left col-1"></div>
                        <div class="col">
                            <ul class="list-unstyled m-t-10">
                                <li class="row">
                                    <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                        <i class="fas fa-envelope"></i>&ensp;
                                        <span>Email: </span>
                                    </p>
                                    <p class="col font-weight-semibold"> {{ $auth_admin->email }}</p>
                                </li>
                                <li class="row">
                                    <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                        <i class="fas fa-phone"></i>&ensp;
                                        <span>Phone: </span>
                                    </p>
                                    <p class="col font-weight-semibold"> {{ $auth_admin->phone }}</p>
                                </li>
                                <li class="row">
                                    <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                        <i class="fas fa-map-marker-alt"></i>&ensp;
                                        <span>Curr.Addr: </span>
                                    </p>
                                    <p class="col font-weight-semibold"> {{ $auth_admin->current_address }}</p>
                                </li>
                                <li class="row">
                                    <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                        <i class="fas fa-thumbtack"></i>&ensp;
                                        <span>Per.Addr: </span>
                                    </p>
                                    <p class="col font-weight-semibold"> {{ $auth_admin->permanent_address }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
