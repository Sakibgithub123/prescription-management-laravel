@extends('admin.master')
@section('content')

<style>
    .row1 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 40px;
        color: #fff;
    }
    .doctor-details{
        font-family: 'Lato', sans-serif;
    }
    
    .doctor-details h2 {
            font-size: 25px;
            font-weight: 600;
            /* color: #4CAF50; */
            color: #4b4745;
            font-style: italic;
        }
        .doctor-details .Education {
            font-size: 22px;
            font-weight: 500;
            color: #4b4745;
        }

        .doctor-details span {
            font-size: 20px;
            font-weight: 400;
            color: #173518;
            font-style: italic;
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
    <h2 class="page-title text-center pt-5" style="color:#007bff; font-weight: bold; border-bottom:1px solid #003366; font-size: 30px;font-style:italic;">Prescription Head</h2>
    <!-- table -->
    <div class="row bg-info mt-5">
        <div class="col-md-12">
            <header style="width: 100%;">
                <div class="mt-3 mb-5">
                    <div class="row1 shadow  p-3">
                        <div class="doctor-details d-flex flex-column" style="font-family: 'Lato', sans-serif;">
                            <h2 class="name">Dr. Md Sahidul haque </h2>
                            <span class="qualification Degree">MBBS, Dhaka.</span>
                            <span class="Education Informations">AFC, BCS(Health), Dhaka. </span>
                            <span class="specialist text-white">Child specialist.</span>
                        </div>
                        <div class=" doctor-details text-center">
                            <h2>রোগী দেখার সময়</h2>
                                <div class="text-center d-flex flex-column">
                                    <span class="seating-day">Day: Sun To Thurs</span>
                                    <span class="seating-time">Time: 9am To 8pm</span>
                                </div>
                        </div>
                        <div class="doctor-details p-4 d-flex flex-column" style=" border:1px dotted #003366; " id="chember-details">
                            <h2 class="clinic-name">{{$clinics->clinic_name}} </h2>
                                <span class="location">Address: {{$clinics->location}}.</span>
                                <!-- <h3>location_details</h3> -->
                                <span class="phone no">Phone: 0172345678</span>
                                <span>RegNo: <span class="ml-2 text-white">RG####</span></span>
                        </div>
                    </div>
                </div>
            </header>
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
                    toastr.success('Clinic Added Successfully.', 'Add Clinic!');
                    window.location.href="/add/clinic";

                } else {
                    toastr.error('Something wrong.', 'Try again!');
                }
            },
            error: function(response) {
                $('#mlinic_nameErrorMsg').text(response.responseJSON.errors.clinic_name);
                $('#locationErrorMsg').text(response.responseJSON.errors.location);
            }
        })
    })
    
</script>

@endpush
@endsection