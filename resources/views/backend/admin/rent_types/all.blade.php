@extends('backend.layout')

@section('title')
Manage Rent Types
@endsection

@section('panel_title')
Manage Rent Types
@endsection

@section('main')
<div class="col-lg-8">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">All Rent Types</h6>
        </div>
        <div class="card-body overflow-x-auto">
            <table class="table table-flushed table-hover">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 10%">#ID</th>
                        <th>Type</th>
                        <th style="width: 15%">Status</th>
                        <th style="width: 20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rentTypes as $single)
                        <tr>
                            <td>
                                <span class="badge badge-dark">#{{$single->id}}</span>
                            </td>
                            <td>{{$single->type}}</td>
                            <td>
                                @if ($single->status)
                                <span class="badge badge-success">Live</span>
                                @else
                                <span class="badge badge-danger">Archived</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-btn" data-toggle="modal" data-target="#rentTypeModal" id="{{$single->id}}" >
                                    <i class="fas fa-edit"></i>&ensp;Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="rentTypeModal" tabindex="-1" role="dialog" aria-labelledby="rentTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="rentTypeModalLabel">Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <span id="apiFetchStatus">Fetching...</span>
                <form action="" method="post" id="rentTypeEditForm" class="d-none">
                    @csrf
                    <div class="form-group">
                        <label for="rentType">Type</label>
                        <input type="text" name="type" id="rentTypeEditInput" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="rentTypeStatus">Status</label>
                        <select name="status" id="rentTypeStatus" class="form-control">
                            <option value="1">Live</option>
                            <option value="0">Archived</option>
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

<div class="col-lg-4">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Add New</h6>
        </div>
        <div class="card-body">
            <form action="{{route('admin.manage.rent_types.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="rentType">Type</label>
                    <input type="text" name="type" id="rentType" class="form-control">
                </div>

                <div class="form-group">
                    <button class="btn btn-sm btn-primary mt-4"><i class="fas fa-plus"></i>&ensp;Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('extra_scripts')
    <script>
        $(document).ready(function(){
            $('.edit-btn').click(function(){
                $('#rentTypeModal').modal('show');
                const id = $(this).attr('id');
                const url = `rent-types/edit/${id}`;
               $.get(url)
                .done(function(data){
                    $('#apiFetchStatus').text('');
                    $('#rentTypeEditInput').val(data.type);
                    $('#rentTypeStatus').val(data.status);
                    $('#rentTypeEditForm').attr('action', `rent-types/update/${id}`)
                    $('#rentTypeEditForm').removeClass('d-none');
                })
                .fail(function(err){
                    $('#apiFetchStatus').text('Error Occured!');
                });
            });

            $('#rentTypeModal').on('hidden.bs.modal', function (e) {
                $('#apiFetchStatus').text('Fetching...');
                $('#rentTypeEditForm').addClass('d-none');
            });
        });
    </script>
@endsection
