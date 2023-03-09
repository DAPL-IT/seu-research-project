@extends('backend.layout')

@section('title')
Add New Moderator
@endsection

@section('panel_title')
Add New Moderator
@endsection

@section('main')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="modName">Name</label>
                            <input type="text" name="" id="modName" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="modPhone">Phone</label>
                            <input type="tel" name="" id="modPhone" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="modEmail">Email</label>
                            <input type="email" name="" id="modEmail" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="modNID">NID</label>
                            <input type="text" name="" id="modNID" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="modPwd">Set Password</label>
                            <input type="text" name="" id="modPwd" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="currAddrField">Current Address</label>
                            <textarea class="form-control" name="" id="currAddrField" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="parAddrField">Parmanent Address</label>
                            <textarea class="form-control" name="" id="parAddrField" rows="3" placeholder="Leave it empty if Parmanent Addr. is same as Current Addr."></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-sm btn-primary mt-4"><i class="fas fa-plus"></i>&ensp;Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

