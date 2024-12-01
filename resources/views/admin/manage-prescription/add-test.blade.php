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
<h4 class="page-title text-center py-2" style="background-color:#007bff; color:#fff; font-weight: 900;">Test</h4>
    <div class="row my-5">
        <div class="col-md-6 offset-md-3 shadow p-5 bg-primary">
            <h4 class="page-title text-center" style="color:#fff; font-weight: bold;">Add Test Form</h4>
            <form id="testForm">
                @csrf
                <div class="form-group">
                    <label>Test Name :</label>
                    <input type="text" name="test" placeholder="write test" class="form-control">
                    <span class="text-danger" id="testErrorMsg"></span>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary" style="background-color:#003366; color:#fff; font-weight: bold;">Add</button>
                </div>
            </form>
        </div>
    </div>
    <!-- table -->
    <!-- table -->
    <h4 class="page-title text-center py-2 border-bottom border-primary" style="color:#007bff; font-weight: 900;">All Test</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="testTable" class="table table-border table-striped custom-table datatable mb-0">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Test Name</th>
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
    let table = new DataTable('#testTable', {
        ajax: "{{url('/test/page')}}",
        processing: true,
        columns: [{
            render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
        }

            },
            {
                data: 'test'
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
								</div>
								`
                }
            },
            // { data: 'salary' }
        ]
    });



    $(document).ready(function() {
    $('#testForm').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            method: 'post',
            url: "{{route('save.test.form')}}",
            data: formData,
            success: function(data) {
                if (data.status == 'exit') {
                    $('#testErrorMsg').text(data.massage + " " + 'already exists.');
                    return;
                }

                if (data.status === true) {
                    toastr.success( data.massage +" "+'Test Added Success.', 'Add Test!');
                    $('#testErrorMsg').text('');
                    table.ajax.reload();
                } else {
                    toastr.error('Something wrong.', 'Try again!');

                }
            },
            error: function(response) {
                $('#testErrorMsg').text(response.responseJSON.errors.test);
            }
        })
    })
})
    $(document).on('click', '#deleteBtn', function(e) {
        e.preventDefault();
        let id = $(this).attr('delete-id')
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this test!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'post',
                    url: '{{route("delete.test")}}',
                    data: {
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(data) {

                        if (data.status === true) {
                            Swal.fire(
                                'Deleted!',
                                ' Test has been deleted.',
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