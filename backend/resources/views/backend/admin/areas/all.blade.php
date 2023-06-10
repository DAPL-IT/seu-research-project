@extends('backend.layout')

@section('title')
Manage Areas
@endsection

@section('panel_title')
Manage Areas
@endsection

@section('main')
<div class="col-xl-8">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">All Areas</h6>
        </div>
        <div class="card-body overflow-x-auto">
            <table class="table table-flushed table-hover" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 10%">#ID</th>
                        <th>Area</th>
                        <th>District</th>
                        <th style="width: 20%">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="areaModal" role="dialog" aria-labelledby="areaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="areaModalLabel">Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <span id="apiFetchStatus">Fetching...</span>
                <form action="" method="post" id="areaEditForm" class="d-none">
                    @csrf
                    <div class="form-group">
                        <label for="areaEditInput">Name</label>
                        <input type="text" name="name" id="areaEditInput" class="form-control">
                    </div>
                    <div class="form-group">
                        <select name="district_id"  class="form-control select-js" style="width:100% !important" id="districtOfAreaEdit" required>
                            @foreach ($districts as $district)
                                <option value="{{$district->id}}" >{{$district->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-right">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="col-xl-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Add New</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.manage.areas.add')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label >District</label>
                            <select name="district_id" class="form-control select-js" style="width:100% !important" required>
                                @foreach ($districts as $district)
                                    <option value="{{$district->id}}" @if($district->name=='Dhaka') selected @endif>{{$district->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-sm btn-primary mt-2"><i class="fas fa-plus"></i>&ensp;Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Bulk Add</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.manage.areas.bulk.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="json_file">Upload Area JSON file</label>
                            <input type="file" name="json_file" id="json_file" class="form-control" accept=".json" required>
                        </div>
                        <div class="form-group">
                            <label >For District</label>
                            <select name="district_id"  class="form-control select-js" style="width:100% !important" required>
                                @foreach ($districts as $district)
                                    <option value="{{$district->id}}" @if($district->name=='Dhaka') selected @endif>{{$district->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary mt-2"><i class="fas fa-plus"></i>&ensp;Submit</button>
                        </div>
                    </form>
                </div>
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
            ajax: "{{route('admin.manage.areas.all')}}",
            responsive: true,
            lengthMenu: [10, 25, 50],
            pageLength: 10,
            order: [[1, 'asc']],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'district', name: 'district'},
                {data: 'action', name: 'action',
                orderable: false, searchable: false},
            ],
        });

        $('.select-js').select2();

        $('#dataTable').on('click', '.edit-btn', function(){
            $('#areaModal').modal('show');
            const id = $(this).attr('id');
            const url = `areas/edit/${id}`;
            $.get(url)
            .done(function(data){
                $('#apiFetchStatus').text('');
                $('#areaEditInput').val(data.name);
                $('#districtOfAreaEdit').val(data.district_id).trigger('change');
                $('#areaEditForm').attr('action', `areas/update/${id}`)
                $('#areaEditForm').removeClass('d-none');
            })
            .fail(function(err){
                $('#apiFetchStatus').text('Error: '+err.status+' '+err.responseJSON.msg);
            });
        });

        $('#areaModal').on('hidden.bs.modal', function (e) {
            $('#apiFetchStatus').text('Fetching...');
            $('#areaEditForm').addClass('d-none');
        });

    });
  </script>
@endsection

