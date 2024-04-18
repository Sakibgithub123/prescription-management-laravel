@extends('admin.master');
@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-6 offset-md-3 shadow p-5">
            <h4 class="page-title text-center">Add Investigation Form</h4>
            <form id="investigationForm">
                @csrf
                <div class="form-group">
                    <label>Investigation Name :</label>
                    <input type="text" name="investigation" placeholder="write investigation" class="form-control">
                    <span class="text-danger" id="investigationErrorMsg"></span>
                </div>

                <div class="text-right">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                </div>
            </form>
        </div>

    </div>
    <!-- table -->
    <div class="row">
    <h4 class="page-title text-center">All Investigation</h4>
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
                        <!-- @foreach($investigations as $investigation)
                        <tr>
                        <td>{{$investigation->id}}</td>
                            <td>{{$investigation->investigation}}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" id="editBtn" data-bs-toggle="modal" data-bs-target="#myModal" data-editId="{{$investigation->id}}"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                                        <button class="dropdown-item" id="deleteBtn" data-deleteId="{{$investigation->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
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
										<button class="dropdown-item" id="deleteBtn"   delete-id="` + data + `" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
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
                        toastr.success('Add Investigation Success', 'Add Investigation');
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

    })
    $(document).on('click', '#deleteBtn', function(e) {
        e.preventDefault();
        let id = $(this).attr('delete-id');
        // alert(id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You wan't  to delete this investigation!",
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
                                'Your file has been deleted.',
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