@extends('backend.layout')

@section('title')
Manage Districts
@endsection

@section('panel_title')
Manage Districts
@endsection

@section('main')
<div class="col-xl-8">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">All Districts</h6>
        </div>
        <div class="card-body overflow-x-auto">
            <table class="table table-flushed table-hover" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 10%">#ID</th>
                        <th>Name</th>
                        <th style="width: 20%">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="districtModal" role="dialog" aria-labelledby="districtModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="districtModalLabel">Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <span id="apiFetchStatus">Fetching...</span>
                <form action="" method="post" id="districtEditForm" class="d-none">
                        @csrf
                    <div class="form-group">
                        <label for="districtEditInput">Name</label>
                        <input type="text" name="name" id="districtEditInput" class="form-control">
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
                    <form action="{{route('admin.manage.districts.add')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="districtName">Name</label>
                            <input type="text" name="name" id="districtName" class="form-control" required>
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
                    <form action="{{route('admin.manage.districts.bulk.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="json_file">Upload District JSON file</label>
                            <input type="file" name="json_file" id="json_file" class="form-control" accept=".json" required>
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
            ajax: "{{route('admin.manage.districts.all')}}",
            responsive: true,
            lengthMenu: [10, 25, 50],
            pageLength: 10,
            order: [[1, 'asc']],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action',
                orderable: false, searchable: false},
            ],
        });

        $('#dataTable').on('click', '.edit-btn', function(){
            $('#districtModal').modal('show');
            const id = $(this).attr('id');
            const url = `districts/edit/${id}`;
            $.get(url)
            .done(function(data){
                $('#apiFetchStatus').text('');
                $('#districtEditInput').val(data.name);
                $('#districtEditForm').attr('action', `districts/update/${id}`)
                $('#districtEditForm').removeClass('d-none');
            })
            .fail(function(err){
                $('#apiFetchStatus').text('Error: '+err.status+' '+err.responseJSON.msg);
            });
        });

        $('#districtModal').on('hidden.bs.modal', function (e) {
            $('#apiFetchStatus').text('Fetching...');
            $('#districtEditForm').addClass('d-none');
        });

    });
  </script>
@endsection

