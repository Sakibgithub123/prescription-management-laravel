@extends('admin.master')
@section('content')
<div class="content">
<h4 class="page-title text-center py-2" style="background-color:#007bff; color:#fff; font-weight: 900;">All Patient's Prescription</h4>
    <div class="row mt-5">
        <div class="col-sm-4 col-3 pb-4">
            <h4 class="focus-label text-primary">Patient's Prescription List</h4>  
        </div>
        <!-- <div class="col-sm-8 col-9 text-right m-b-20">
			<a href="add-patient.html" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Patient</a>
		</div> -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="patientTable" class="table table-border table-striped custom-table datatable mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Doctor Name</th>
                            <th>Prescription</th>
                            <th>Date</th>
                            <th>Reg no.</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- @foreach($patients as $patient)
                        <tr>
                            <td><img width="28" height="28" src="{{asset('superAdmin')}}/assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> {{$patient->patient_name}}</td>
                            <td>{{$patient->patient_age}}</td>
                            <td>{{$patient->name}}</td>
                            <td>{{date('F jS, Y g:i A', strtotime($patient->created_at))}}</td>
                            <td>{{$patient->reg_no}}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{route('patient.precription',['id'=>$patient->drid])}}"><i class="fa fa-note-sticky"></i>Prescription</a>
                                        <button class="dropdown-item" id="editBtn" data-bs-toggle="modal" data-bs-target="#myModal" data-editId="{{$patient->id}}"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                                        <button class="dropdown-item" id="deleteBtn" data-deleteId="{{$patient->id}}"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
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

<div class="modal" id="myModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">


            <div class="modal-header" style="background-color:#007bff; color:#fff; font-weight: 900;">
                <h4 class="modal-title">Update Patient</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>


            <div class="modal-body">
                <div class="row">
                    <form id="PatientUpdate">
                        @csrf
                        <input type="hidden" name="patientId" id="patientId">
                        <div class="col-sm-12">
                            <div class="form-group w-full">
                                <label>Patient Name</label>
                                <input type="text" id="patientName" name="patient_name" aria-label="name" class="form-control i">
                                <span class="text-danger" id="error_name"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group w-full">
                                <label>Patient Age</label>
                                <input type="text" id="patientAge" name="patient_age" aria-label="name" class="form-control i">
                                <span class="text-danger" id="error_age"></span>
                            </div>
                        </div>
                        <!-- <div class="col-sm-12">
                            <div class="form-group w-full">
                                <label>Visit Fee</label>
                                <input type="text" id="visitFee" name="visit_fee" aria-label="name" class="form-control i">
                                <span class="text-danger" id="error_fee"></span>
                            </div>
                        </div> -->

                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>


</div>


@push('scripts')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    let table = new DataTable('#patientTable', {
        ajax: "{{url('/patient/list/')}}",
        processing: true,
        columns: [{
                data: 'patient_name'
            },
            {
                data: 'patient_age'
            },
            {
                data: 'name'
            },
            // { data: 'investigations',
            // 	render:function(data){
            // 		return JSON.parse(data)
            // 	}
            //  },
            {
                data: 'p_id',
                render: function(data, type, row) {
                    return `
										<a class="btn-sm btn-block btn btn-info" href="{{route('patient.precription',['id'=> ':data' ])}}"><i class="fa fa-eye m-r-5"></i> Show</a>
									
								`.replace(':data', data);
                }
            },
            {
                data: 'date',
                render: function(data) {
                    return new Date(data).toDateString()

                }
            },
            {
                data: 'reg_no'
            },
           
            {
                data: 'p_id',
                render: function(data, type, row) {
                    return `<div class="text-center ml-5">
			            <div class="dropdown dropdown-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
									<div class="dropdown-menu dropdown-menu-right p-2">
										<button class="btn-sm btn-block btn btn-primary" id="editBtn" data-bs-toggle="modal" data-bs-target="#myModal" data-editId="` + data + `"><i class="fa fa-pencil m-r-5"></i> Edit</button>
										<button class="btn-sm btn-block btn btn-danger" id="deleteBtn" delete-id="` + data + `" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
									</div>
								</div>
								</div>
								`
                }
            },
            // { data: 'salary' }
        ]
    });
    $(document).on('click', '#editBtn', function() {


        let id = $(this).attr('data-editId');
        // alert(id)
        $.ajax({
            url: "/get-patient-details",
            data: {
                id: id
            },
            success: function(result) {

                console.log(result.patient_name)

                $('#patientId').val(result.id)
                $('#patientName').val(result.patient_name)
                $('#patientAge').val(result.patient_age)



            }

        })
    })

    $('#PatientUpdate').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize()
        $.ajax({
            method: 'post',
            url: "{{route('update.Patient.DetailsData')}}",
            data: formData,
            success: function(result) {
                if (result.status === true) {
                    toastr.success('Update Doctor Success', 'Update Doctor');
                    $('#myModal').modal('hide');
                    table.ajax.reload();
                } else {
                    toastr.success('something wrong', 'Try Again');

                }

            },
            error: function(response) {
                $('#error_name').text(response.responseJSON.errors.patient_name);
                $('#error_age').text(response.responseJSON.errors.patient_age);
                $('#error_fee').text(response.responseJSON.errors.visit_fee);



            }
        })
    })

    $(document).on('click', '#deleteBtn', function(e) {
        e.preventDefault();
        let id = $(this).attr('delete-id')
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'post',
                    url: '{{route("delete.Patient.DetailsData")}}',
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