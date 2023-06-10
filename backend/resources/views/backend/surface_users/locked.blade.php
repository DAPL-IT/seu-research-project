@extends('backend.layout')

@section('title')
Locked Users
@endsection

@section('panel_title')
Locked Users
@endsection

@section('main')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive p-3">
            <table class="table table-flushed dt-responsive nowrap table-hover" id="dataTable">
                <thead class="thead-light">
                    <tr>
                      <th style="width: 10%">#ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th style="width: 15%">Account</th>
                    </tr>
                  </thead>
                <tbody>

                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_scripts')
  <script>
    $(document).ready(function(){
        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            lengthMenu: [10, 25, 50],
            pageLength: 10,
            order: [[0, 'desc']],
            ajax: "{{route('users.locked', ['role'=>Auth::user()->role])}}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                // {data: 'locked', name: 'locked'},
                // {data: 'online', name: 'online'},
                {data: 'account', name: 'account',
                orderable: false, searchable: false},
            ],
        });
    });
  </script>
@endsection
