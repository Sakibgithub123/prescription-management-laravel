@extends('admin.master');
<style>
    .animation {
        height: 50px;
        overflow: hidden;
        position: relative;
    }

    .animation .p {
        font-size: 2em;
        color: limegreen;
        position: absolute;
        width: 100%;
        height: 100%;
        margin: 0;
        line-height: 50px;
        text-align: center;
        /* Starting position */
        -moz-transform: translateX(100%);
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
        /* Apply animation to this element */
        -moz-animation: animation 35s linear infinite;
        -webkit-animation: animation 35s linear infinite;
        animation: animation 35s linear infinite;
    }

    /* Move it (define the animation) */
    @-moz-keyframes animation {
        0% {
            -moz-transform: translateX(100%);
        }

        100% {
            -moz-transform: translateX(-100%);
        }
    }

    @-webkit-keyframes animation {
        0% {
            -webkit-transform: translateX(100%);
        }

        100% {
            -webkit-transform: translateX(-100%);
        }
    }

    @keyframes animation {
        0% {
            -moz-transform: translateX(100%);
            /* Firefox bug fix */
            -webkit-transform: translateX(100%);
            /* Firefox bug fix */
            transform: translateX(100%);
        }

        100% {
            -moz-transform: translateX(-100%);
            /* Firefox bug fix */
            -webkit-transform: translateX(-100%);
            /* Firefox bug fix */
            transform: translateX(-100%);
        }
    }
</style>
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
<h4 class="page-title text-center py-2" style="background-color:#007bff; color:#fff; font-weight: 900;">Notice</h4>
    <div class="row">
        <div class="animation">
            @foreach($showNotices as $showNotice)
            <p class="p">{{$showNotice->notice}}</p>
            @endforeach

        </div>
        <div class="col-md-6 offset-md-3 shadow p-5 bg-primary">
            <h4 class="page-title text-center" style="color:#fff; font-weight: bold;">Add Notice Form</h4>
            <form id="noticeForm">
                @csrf
                <div class="form-group">
                    <label>Notice :</label>
                    <textarea name="notice" id="" class="form-control" placeholder="Write notice here..." cols="10" rows="10"></textarea>
                    <!-- <input type="text" name="notice" class="form-control"> -->
                    <span class="text-danger" id="noticeError"></span>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary" style="background-color:#003366; color:#fff; font-weight: bold;">Add</button>
                </div>
            </form>
        </div>

    </div>
    <!-- table -->
    <h4 class="page-title text-center mt-5 py-2 border-bottom border-primary" style="color:#007bff; font-weight: 900;">All Notices</h4>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="noticeTable" class="table table-border table-striped custom-table datatable mb-0">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Notice</th>
                            <th>Status</th>
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

     let table = new DataTable('#noticeTable', {
        ajax: "{{url('/notice-page')}}",
        processing: true,
        columns: [{
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'notice',
                
            },
            {
                data: 'status',
                //  class:'text-danger'
                 render:function(data){
                    if(data==='Active'){
                       return '<span class="text-success">'+data+'</span>'
                    }else{
                        return '<span class="text-danger">'+data+'</span>'
                    }
                 }
            },
            {
                // data: 'id',
                data:{id:'id', status:'status'},
                
                render: function(data, type, row) {
                    return `<div class="text-center ml-5">
			            <div class="dropdown dropdown-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
									<div class="dropdown-menu dropdown-menu-right p-2">
										<button class="btn-sm btn-block btn btn-danger" id="deleteBtn"    data-statusId="` + data.id + `" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
										<button class="btn-sm btn-block btn btn-info" id="statusBtn" data-status="` + data.status + `"   data-statusId="` + data.id + `" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-hand-spock-o" aria-hidden="true"></i> ${data.status === 'Active' ? 'Deactivate' : 'Activate'}</button>
									</div>
								</div>
								</div>`
                }
            },
        ]
    })


    $('#noticeForm').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            method: 'post',
            url: "{{route('add.notice.form')}}",
            data: formData,
            success: function(data) {

                if (data.status === true) {
                    toastr.success('Add Notice Success.', 'Add Notice!');
                    table.ajax.reload();
                } else {
                    toastr.error('Something wrong.', 'Try again!');

                }
            },
            error: function(response) {
                $('#noticeError').text(response.responseJSON.errors.notice);
            }
        })
    })
    $(document).on('click', '#deleteBtn', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-statusId')
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this notice!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'post',
                    url: '{{route("delete.notice")}}',
                    data: {
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.status === true) {
                            Swal.fire(
                                'Deleted!',
                                'Notice has been deleted.',
                                'success'
                            )
                            table.ajax.reload();
                        }
                    }
                })
            }
        })
    });
    $(document).on('click', '#statusBtn', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-statusId');
        var status = $(this).attr('data-status') === 'Deactive' ? 'Active' : 'Deactive';
        // alert(status)
        Swal.fire({
            title: 'Are you sure?',
            text: `You wan't  to `+status+` this Notice!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Yes, `+status+` it!`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'post',
                    url: '{{route("notice.status")}}',
                    data: {
                        'id': id,
                        'status': status,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        Swal.fire(
                            'Changed!',
                            "Notice "+status+" successfully.",
                            'success'
                        )
                        table.ajax.reload();
                    }
                })
            }
        })
    });
</script>
@endpush
@endsection