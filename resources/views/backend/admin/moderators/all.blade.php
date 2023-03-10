@extends('backend.layout')

@section('title')
Moderators
@endsection

@section('panel_title')
Moderators
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
                      <th style="width: 10%">Image</th>
                      <th>Name</th>
                      <th style="width: 5%">Locked?</th>
                      <th style="width: 5%">Online?</th>
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
            ajax: "{{route('admin.manage.moderators.all')}}",
            responsive: true,
            lengthMenu: [10, 25, 50],
            pageLength: 10,
            order: [[0, 'desc']],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'image', name: 'image',
                orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'locked', name: 'locked'},
                {data: 'online', name: 'online'},
                {data: 'account', name: 'account',
                orderable: false, searchable: false},
            ],
        });
    });
  </script>
@endsection
