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
                            <div style="width: 150px; height:150px">
                                <img src="@if (is_null(Auth::user()->image))
                                {{asset('images/no-image.jpg')}}
                                @else
                                {{asset(Auth::user()->image)}}
                            @endif" alt="" class="img img-fluid rounded-circle">
                            </div>
                        </div>
                        <div >
                            <h2 class="m-b-5">Marshall Nichols</h2>
                            <p class="text-opacity font-size-13">@Marshallnich</p>
                            <p class="text-dark m-b-20">Frontend Developer, UI/UX Designer</p>
                            <a href="{{route('moderator.profile.edit')}}" class="btn btn-primary btn-tone btn-sm"><i class="fas fa-edit"></i>&ensp;EDIT</a>
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
                                    <p class="col font-weight-semibold"> Marshall123@gmail.com</p>
                                </li>
                                <li class="row">
                                    <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                        <i class="fas fa-phone"></i>&ensp;
                                        <span>Phone: </span>
                                    </p>
                                    <p class="col font-weight-semibold"> +12-123-1234</p>
                                </li>
                                <li class="row">
                                    <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                        <i class="fas fa-map-marker-alt"></i>&ensp;
                                        <span>Curr.Addr: </span>
                                    </p>
                                    <p class="col font-weight-semibold"> Los Angeles, CA</p>
                                </li>
                                <li class="row">
                                    <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                        <i class="fas fa-thumbtack"></i>&ensp;
                                        <span>Per.Addr: </span>
                                    </p>
                                    <p class="col font-weight-semibold"> Los Angeles, CA</p>
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
