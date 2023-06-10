@extends('backend.layout')

@section('title')
{{ucwords($requestStatus)}} Rent Ads
@endsection

@section('panel_title')
{{ucwords($requestStatus)}} Rent Ads
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
                      <th>Title</th>
                      <th>Type</th>
                      <th>Area</th>
                      <th>Poster</th>
                      <th>Action</th>
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
            ajax: "{{route('moderator.manage.rent_ads.all', ['status'=>$requestStatus])}}",
            responsive: true,
            lengthMenu: [10, 25, 50],
            pageLength: 10,
            order: [[0, 'desc']],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'rent_type', name: 'rent_type'},
                {data: 'area', name: 'area'},
                {data: 'poster', name: 'poster'},
                {data: 'action', name: 'action'}
            ],
        });
    });
  </script>
@endsection
