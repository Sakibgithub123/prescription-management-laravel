@extends('admin.master');
@section('content')
<div class="content">
<h4 class="page-title text-center">All Test</h4>
    <div class="row">
        <div class="col-md-6 offset-md-3 shadow p-5">
            <h4 class="page-title text-center">Add Test Form</h4>
            <form id="testForm">
                @csrf
                <div class="form-group">
                    <label>Test Name :</label>
                    <input type="text" name="test" placeholder="write test" class="form-control">
                    <span class="text-danger" id="testErrorMsg"></span>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>

    </div>
    <!-- table -->
    <!-- table -->
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
                        <!-- @foreach($medicines as $medicine)
                        <tr>
                            <td>{{$medicine->id}}</td>
                            <td>{{$medicine->medicine}}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" id="editBtn" data-bs-toggle="modal" data-bs-target="#myModal" data-editId="{{$medicine->id}}"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                                        <button class="dropdown-item" id="deleteBtn" data-deleteId="{{$medicine->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach -->

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
                data: 'tests'
            },
            
            {
                data: 'id',
                render: function(data, type, row) {
                    return `<div class="text-center ml-5">
			            <div class="dropdown dropdown-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
									<div class="dropdown-menu dropdown-menu-right">
										<button class="dropdown-item" id="deleteBtn"   delete-id="` + data + `" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
									</div>
								</div>
								</div>
								`
                }
            },
            // { data: 'salary' }
        ]
    });




    $('#testForm').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            method: 'post',
            url: "{{route('save.test.form')}}",
            data: formData,
            success: function(data) {
                if (data.status === "exit") {

                    $('testErrorMsg').text(data.massage + " " + 'already exists.');
                    return;
                }

                if (data.status === true) {
                    toastr.success( data.massage +" "+'Test Added Success', 'Add Test');
                    table.ajax.reload();
                } else {
                    toastr.error('Something wrong!', 'Try again!');

                }
            },
            error: function(response) {
                $('#testErrorMsg').text(response.responseJSON.errors.test);
            }
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

    })
</script>

@endpush

@endsection