@extends('admin.master');
@section('content')
<style>
     label{
        color: #003366;
        font-weight: bold;
    }
    ::placeholder{
        color: #003366;

    }
</style>

<div class="content">
<h4 class="page-title text-center py-2" style="background-color:#007bff; color:#fff; font-weight: 900;">Investigation</h4>
    <div class="row my-5">
        <div class="col-md-6 offset-md-3 shadow p-5 bg-primary">
            <h4 class="page-title text-center" style="color:#fff; font-weight: bold;">Add Investigation Form</h4>
            <form id="investigationForm">
                @csrf
                <div class="form-group">
                    <label>Investigation Name :</label>
                    <input type="text" name="investigation" placeholder="write investigation" class="form-control">
                    <span class="text-danger" id="investigationErrorMsg"></span>
                </div>

                <div class="text-right">
                    <input type="submit" class="btn btn-primary" style="background-color:#003366; color:#fff; font-weight: bold;" value="Add">
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                </div>
            </form>
        </div>

    </div>
    <!-- table -->
    <h4 class="page-title text-center py-2 border-bottom border-primary" style="color:#007bff; font-weight: 900;">All Investigation</h4>
    <div class="row">
    <!-- <h4 class="page-title text-center">All Investigation</h4> -->
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="investigationTable" class="table table-border table-striped custom-table datatable mb-0">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Investigation Name</th>

                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    let table = new DataTable('#investigationTable', {
        ajax: "{{url('/investigations/page')}}",
        processing: true,
        columns: [{
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'investigation',
            },
            {
                data: 'id',
                render: function(data, type, row) {
                    return `<div class="text-center ml-5">
			            <div class="dropdown dropdown-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
									<div class="dropdown-menu dropdown-menu-right">
										<button class="btn-sm btn-block btn btn-danger" id="deleteBtn"   delete-id="` + data + `" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
									</div>
								</div>
								</div>`
                }
            },
        ]
    })
    $(document).ready(function() {
        $('#investigationForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{route('save.investigations.form')}}",
                method: 'post',
                data: formData,
                success: function(data) {
                    if (data.status == 'exit') {
                        $('#investigationErrorMsg').text(data.massage + " " + 'already exists.');
                        return;
                    }
                    if (data.status == true) {
                        toastr.success('Add Investigation Success.', 'Add Investigation!');
                        $('#investigationErrorMsg').text('');
                        table.ajax.reload()
                    } else {
                        toastr.error('Something wrong!', 'Try again!');
                    }
                },
                error: function(response) {
                    $('#investigationErrorMsg').text(response.responseJSON.errors.investigation);
                },
            })
        });
    });
    $(document).on('click', '#deleteBtn', function(e) {
        e.preventDefault();
        let id = $(this).attr('delete-id');
        // alert(id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this investigation!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'post',
                    url: '{{route("delete.investigations")}}',
                    data: {
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(data) {

                        if (data.status === true) {
                            Swal.fire(
                                'Deleted!',
                                'Investigation shas been deleted.',
                                'success'
                            )
                            table.ajax.reload();
                        }
                    }
                })
            }
        })
    });
</script>
@endpush
@endsection