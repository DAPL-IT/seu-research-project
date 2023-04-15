@extends('backend.layout')

@section('title')
Manage Rent Classifications
@endsection

@section('panel_title')
Manage Rent Classifications
@endsection

@section('main')
<div class="col-xl-8">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">All Rent Classifications</h6>
        </div>
        <div class="card-body overflow-x-auto">
            <table class="table table-flushed table-hover">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 10%">#ID</th>
                        <th>Classification</th>
                        <th>Range (BDT)</th>
                        <th>Slug</th>
                        <th style="width: 20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($rentClassifications as $rentClassification)
                    <tr>
                        <td>
                            <span class="badge badge-dark">#{{$rentClassification->id}}</span>
                        </td>
                        <td>{{$rentClassification->classification}}</td>
                        <td>
                            {{ $rentClassification->from }} - {{ $rentClassification->to }}
                        </td>
                        <td>{{$rentClassification->slug}}</td>
                        <td>
                            <button class="btn btn-sm btn-primary edit-btn" data-toggle="modal" data-target="#rentTypeModal" id="{{$rentClassification->id}}" >
                                <i class="fas fa-edit"></i>
                            </button>
                            <a class="btn btn-sm btn-danger delete-btn text-white" href="{{route('admin.manage.rent.classifications.delete', ['id'=>$rentClassification->id])}}">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="rentClassificationModal" role="dialog" aria-labelledby="rentClassificationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="rentClassificationModalLabel">Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <span id="apiFetchStatus">Fetching...</span>
                <form action="" method="post" id="rentClassificationEditForm" class="d-none">
                    @csrf
                    <div class="form-group">
                        <label for="rentClassificationEditInput">Classification</label>
                        <input type="text" name="classification" id="rentClassificationEditInput" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="rentClassificationEditInputFrom">Taka From</label>
                        <input type="number" name="from" class="form-control" min="0" step="1" id="rentClassificationEditInputFrom">
                    </div>
                    <div class="form-group">
                        <label for="rentClassificationEditInputTo">Taka To</label>
                        <input type="number" name="to" class="form-control" min="0" step="1" id="rentClassificationEditInputTo">
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
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Add New</h6>
        </div>
        <div class="card-body">
            <form action="{{route('admin.manage.rent.classifications.add')}}" method="post">
                @csrf
                <div class="form-group">
                    <label >Classification</label>
                    <input type="text" name="classification" class="form-control">
                </div>
                <div class="form-group">
                    <label >Taka From</label>
                    <input type="number" name="from" class="form-control" min="0" step="1">
                </div>
                <div class="form-group">
                    <label >Taka To</label>
                    <input type="number" name="to" class="form-control" min="0" step="1">
                </div>
                <div class="form-group">
                    <button class="btn btn-sm btn-primary mt-2"><i class="fas fa-plus"></i>&ensp;Submit</button>
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
    $('#rentClassificationModal').modal('show');
    const id = $(this).attr('id');
    const url = `rent-classifications/edit/${id}`;

       $.get(url)
        .done(function(data){
            $('#apiFetchStatus').text('');
            $('#rentClassificationEditInput').val(data.classification);
            $('#rentClassificationEditInputFrom').val(data.from);
            $('#rentClassificationEditInputTo').val(data.to);
            $('#rentClassificationEditForm').attr('action', `rent-classifications/update/${id}`)
            $('#rentClassificationEditForm').removeClass('d-none');
        })
        .fail(function(err){
            $('#apiFetchStatus').text('Error: '+err.status+' '+err.responseJSON.msg);
        });
    });

    $('#rentClassificationModal').on('hidden.bs.modal', function (e) {
        $('#apiFetchStatus').text('Fetching...');
        $('#rentClassificationEditForm').addClass('d-none');
    });

    $('.delete-btn').on('click', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');

        Swal.fire({
            title: 'Want to Delete?',
            text: "You won't be able to revert this operation!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});
</script>

@endsection
