@extends('admin.master')
@section('content')
<style>
    .row1 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 40px;
    }
    .row1{
        /* background-color:#003366 ; */
        color: #fff;
    }
    label{
        color: #003366;
        font-weight: bold;
    }
    ::placeholder{
        color: #003366;

    }
</style>

<div class="content">
<h4 class="page-title text-center py-2" style="background-color:#007bff; color:#fff; font-weight: 900;">About Clinic</h4>
    <div class="row pt-5">
        <div class="col-md-6 offset-md-3 shadow p-5  bg-primary">
            <h4 class="page-title text-center font-bold" style="color:#fff; font-weight: bold;">Add Chember/Clinic Form</h4>
            <form id="clinicForm">
                @csrf
                <input type="hidden" name="clinicId" value="{{$clinics->id}}">
                <div class="form-group">
                    <label>Clinic/Chember Name :</label>
                    <input type="text" name="clinic_name" value="{{$clinics->clinic_name}}" class="form-control">
                    <span class="text-danger" id="mlinic_nameErrorMsg"></span>
                </div>
                <div class="form-group">
                    <label>Clinic Location :</label>
                    <input type="text" name="location" value="{{$clinics->location}}" class="form-control">
                    <span class="text-danger" id="locationErrorMsg"></span>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary" style="background-color:#003366; color:#fff; font-weight: bold;">Add</button>
                </div>
            </form>
        </div>

    </div>

    <!-- table -->
    <div class="row bg-info mt-5">
        <div class="col-md-12">
            <header style="width: 100%;">
                <div class="my-5">
                <!-- <h4 class="page-title text-center" style="color:#003366; font-weight: bold;">Clinic Details</h4> -->
                    <div class="row1 shadow  p-3">
                        <div class="doctor-details">
                            <h2 class="name">Md Sahidul haque </h2>
                            <p class="qualification Degree">MBBS Dhaka</p>
                            <h3 class="Education Informations">AFC,BCS,Dhaka </h3>
                            <p class="specialist text-white">Child specialist</p>
                        </div>
                        <div class=" doctor-details text-center">
                            <h2>Time to see the patient </h1>
                                <div class="text-center">
                                    <p class="seating-day">Sun To Thurs</p>
                                    <p class="seating-time">9am To 8pm</p>
                                </div>
                        </div>
                        <div class="doctor-details" id="chember-details">
                            <h2 class="clinic-name">{{$clinics->clinic_name}} </h1>
                                <p class="location">Address: {{$clinics->location}}</p>
                                <!-- <h3>location_details</h3> -->
                                <p class="phone no">Phone: 0172345678</p>
                                <p>RegNo: <span class="ml-2 text-white">RG####</span></p>
                        </div>
                    </div>


                </div>


            </header>
            <!-- <div class="table-responsive">
                <table id="addClinicTable" class="table table-border table-striped custom-table datatable mb-0">
                    <thead>
                        <tr>
                            <th>Clinic Name</th>
                            <th>Location</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div> -->
        </div>
    </div>

</div>


@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    let table = new DataTable('#addClinicTable', {
        ajax: "{{url('/add/clinic')}}",
        processing: true,
        columns: [{
                data: 'clinic_name'
            },
            {
                data: 'location'
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
    $('#clinicForm').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            method: 'post',
            url: "{{route('save.clinic.form')}}",
            data: formData,
            success: function(data) {
                if (data.status === true) {
                    toastr.success('Clinic Added Successfully!', 'Add Clinic');
                    window.location.href="/add/clinic";

                } else {
                    toastr.error('Something wrong!', 'Try again!');
                }
            },
            error: function(response) {
                $('#mlinic_nameErrorMsg').text(response.responseJSON.errors.clinic_name);
                $('#locationErrorMsg').text(response.responseJSON.errors.location);
            }
        })
    })
    // $(document).on('click', '#deleteBtn', function(e) {
    //     e.preventDefault();
    //     let id = $(this).attr('delete-id')
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 method: 'post',
    //                 url: '{{route("delete.clinic")}}',
    //                 data: {
    //                     'id': id,
    //                     '_token': '{{ csrf_token() }}'
    //                 },
    //                 success: function(data) {

    //                     if (data.status === true) {
    //                         Swal.fire(
    //                             'Deleted!',
    //                             'Your file has been deleted.',
    //                             'success'
    //                         )
    //                         table.ajax.reload();
    //                     }

    //                 }
    //             })

    //         }
    //     })

    // })
</script>

@endpush
@endsection