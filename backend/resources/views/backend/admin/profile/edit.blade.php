@extends('backend.layout')

@section('title')
Profile Edit
@endsection

@section('panel_title')
Profile Edit
@endsection

@section('main')
<div class="col-12">
    <div class="card mb-4">
        <div class="card-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pill-general-tab" data-toggle="pill" href="#pill-general" role="tab" aria-controls="pill-general" aria-selected="true">General</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pill-profile-pic-tab" data-toggle="pill" href="#pill-profile-pic" role="tab" aria-controls="pill-profile-pic" aria-selected="false">Profile Picture</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pill-pwd-tab" data-toggle="pill" href="#pill-pwd" role="tab" aria-controls="pill-pwd" aria-selected="false">Password</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pill-general" role="tabpanel" aria-labelledby="pill-general-tab">
                    <form class="mt-4" method="POST" action="{{route('admin.profile.update.general')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nameField">Name</label>
                                    <input type="text" class="form-control" id="nameField" name="name" value="{{ $auth_admin->name }}" >
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="emailField">Email</label>
                                    <input type="email" class="form-control" id="emailField" name="email" value="{{ $auth_admin->email }}" >
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="phoneField">Phone</label>
                                    <input type="text" class="form-control" id="phoneField" name="phone", value="{{ $auth_admin->phone }}" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="currAddrField">Current Address</label>
                                    <textarea class="form-control" name="current_address" id="currAddrField" rows="3">{{ $auth_admin->current_address }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="parAddrField">Parmanent Address</label>
                                    <textarea class="form-control" name="permanent_address" id="parAddrField" rows="3" placeholder="Leave it empty if Parmanent Addr. is same as Current Addr.">{{ $auth_admin->permanent_address }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary btn-sm mt-4 " type="submit"><i class="fas fa-edit"></i>&ensp;Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="pill-profile-pic" role="tabpanel" aria-labelledby="pill-profile-pic-tab">
                    <form class="mt-4" method="POST" enctype="multipart/form-data" action="{{route('admin.profile.update.image')}}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="profile-image-container">
                                        <img class="profile-image img-fluid" src="@if (is_null(Auth::user()->image))
                                        {{asset('images/no-image.jpg')}}
                                        @else
                                        {{asset(Auth::user()->image)}}
                                    @endif" alt="profile_image" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>New Profile Picture</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="proPicField" name="image" accept=".jpg, .jpeg, .png" required>
                                        <label class="custom-file-label" for="proPicField">Choose Image</label>
                                        <small class="text-danger d-block mt-3">Maximum Image Size: 5MB, Recommended dimension is 150*150</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary btn-sm mt-3" type="submit"><i class="fas fa-edit"></i>&ensp;Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="pill-pwd" role="tabpanel" aria-labelledby="pill-pwd-tab">
                    <form class="mt-4" method="POST" action="{{route('admin.profile.update.password')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="currPwd">Current Password</label>
                                    <input type="password" class="form-control" id="currPwd" name="current_password" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="newPwd">New Password</label>
                                    <input type="password" class="form-control" id="newPwd" name="new_password" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="retypeNewPwd">Retype New Password</label>
                                    <input type="password" class="form-control" id="retypeNewPwd" name="new_password_confirmation" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary btn-sm mt-4" type="submit"><i class="fas fa-edit"></i>&ensp;Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
