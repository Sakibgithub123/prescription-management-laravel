@extends('admin.master')

@section('content')
<style>
    label {
        color: #003366;
        font-weight: bold;
    }
    ::placeholder {
        color: #003366;
    }
</style>
<div class="content">
    <h4 class="page-title text-center py-2" style="background-color:#007bff; color:#fff; font-weight: 900;">All Doctors</h4>
    <!-- search by name -->
    <div class="search">
        <form action="{{route('doctor.list')}}" method="get">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search By Doctor Name" aria-label="Search By Doctor Name" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
    </div>

    <div class="row mt-5">
        <div class="col-sm-4 col-3">
            <!-- <h4 class="page-title">Doctors</h4> -->
            <h4 class="focus-label text-primary">Doctors List</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <button class="btn btn-primary btn-rounded float-right font-weight-bold" data-bs-toggle="modal" data-bs-target="#addDoctorModal"><i class="fa fa-plus"></i> Add Doctor</button>
        </div>

    </div>
    <div class="row doctor-grid ">
    @forelse($doctors as $doctor)
        <div class="col-md-4 col-sm-4  col-lg-3 doctor-list  ">
            <div class="profile-widget my-4 border border-primary ">
                <div class="doctor-img text-center ">
                    <a class="avatar border border-primary" href="{{route('doctor.details',['id'=>$doctor->id])}}">
                        @if(!$doctor->profile_image)
                        <img alt="{{substr($doctor->name,0,1)}}" src="{{asset('superAdmin')}}/assets/img/doctor-thumb-03.jpg">
                        @else
                        <img alt="{{substr($doctor->name,0,2)}}" src="{{asset('storage/images/'.$doctor->profile_image)}}">
                        @endif

                    </a>
                </div>
                <div class="dropdown profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right p-1">
                        <!-- <button class="dropdown-item" id="editBtn" data-editId="{{$doctor->id}}" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                        <button class="dropdown-item" id="deleteBtn" data-deleteId="{{$doctor->id}}" data-target="#delete_doctor"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                        <button class="dropdown-item"><i class="fa fa-eye"></i> <a class="text-black" href="{{route('doctor.details',['id'=>$doctor->id])}}">More</a></button> -->
                        <button class="btn-sm btn-block btn btn-primary" id="editBtn" data-editId="{{$doctor->id}}" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                        <button class="btn-sm btn-block btn btn-danger" id="deleteBtn" data-deleteId="{{$doctor->id}}" data-name="{{$doctor->name}}" data-target="#delete_doctor"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                        <button class="btn-sm btn-block btn btn-info"><i class="fa fa-eye"></i> <a class="text-white" href="{{route('doctor.details',['id'=>$doctor->id])}}">More</a></button>
                    </div>
                </div>
                <h4 class="doctor-name text-ellipsis"><a href="{{route('doctor.details',['id'=>$doctor->id])}}">{{$doctor->name}}</a></h4>
                <div class="doc-prof">{{$doctor->specialist}}</div>
                <div class="doc-prof">
                    <!-- <input data-statusId="{{$doctor->id}}" id="statusBtn" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $doctor->status ? 'checked' : '' }}> -->

                    <span class="{{$doctor->status==1 ? 'text-primary': 'text-danger'}} d-flex justify-content-center align-items-center  gap-1  p-2">
                        <span class="h6"><input data-statusId="{{$doctor->id}}" id="statusBtn" class="toggle-class {{$doctor->status==1 ? 'text-primary': 'text-danger'}}" type="checkbox" data-onstyle="success" data-offstyle="danger" {{ $doctor->status ? 'checked' : '' }}></span>
                        <span class="h6 fw-bold">{{$doctor->status==1 ? "Enable": "Disable"}}</span>
                    </span>
                </div>
                <div class="user-country">
                    <i class="fa fa-map-marker"></i> {{$doctor->address}}
                </div>
            </div>
        </div>
        @empty
            <li class="list-group-item list-group-item-danger text-center h1">Doctor Not Found.</li>
        @endforelse


        <!-- ---------- -->
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="see-all">
                <!-- see-all-btn -->
                <button id="load-more" class="btn fw-bold btn-outline-primary">Load More</button>
            </div>
        </div>
    </div>
</div>


</div>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#007bff; color:#fff; font-weight: 900;">
                <h4 class="modal-title">Update <span id="drName"></span> details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="DoctorUpdate">
                        @csrf
                        <input type="hidden" name="drId" id="drId">
                        <div class="d-flex flex-row gap-1">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group w-full">
                                        <label>Doctor name</label>
                                        <input type="text" id="name" name="name" aria-label="name" class="form-control i">
                                        <span class="text-danger" id="error_name"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Education Informations</label>
                                        <input type="text" id="education_info" name="education_informations" aria-label="name" class="form-control">
                                        <span class="text-danger" id="error_education_informations"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Qualification</label>
                                        <input type="text" id="qualification" name="qualification" aria-label="name" class="form-control">
                                        <span class="text-danger" id="error_qualification"></span>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Department/Specialist</label>
                                        <input type="text" id="specialist" name="specialist" aria-label="name" class="form-control">
                                        <span class="text-danger" id="error_specialist"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>When You Seat</label>
                                        <input type="text" id="whenyouseat" name="whenyouseat" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_whenyouseat"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Seating day</label>
                                        <input type="text" id="seating_day" name="seating_day" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_seating_day"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Institute</label>
                                        <input type="text" id="friday_seating_time" name="friday_seating_time" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_friday_seating_time"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Visit Fee</label>
                                        <input type="text" id="visit_fee" name="visit_fee" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_visit_fee"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" id="phone" name="phone" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_phone"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Birthday</label>
                                        <input type="text" id="birthday" name="birthday" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_birthday"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" id="address" name="address" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_address"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <!-- <input type="text" id="gender" name="gender" aria-label="date" class="form-control"> -->
                                        <select name="gender" id="updateGender" class="form-control">
                                            <option selected>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <span class="text-danger" id="error_gender"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary font-weight-bold" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary font-weight-bold">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- add doctor Modal -->
<div class="modal" id="addDoctorModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#007bff; color:#fff; font-weight: 900;">
                <h4 class="modal-title text-center">Add Doctor</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="addDoctorForm">
                        @csrf
                        <div class="d-flex flex-row gap-1">
                            <div class="col-sm-6">
                                <div class="col-md-12">
                                    <div class="form-group w-full">
                                        <label>Doctor name</label>
                                        <input type="text" id="name" name="name" aria-label="name" class="form-control i">
                                        <span class="text-danger" id="error_addname"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Education Informations</label>
                                        <input type="text" id="education_info" name="education_informations" aria-label="name" class="form-control">
                                        <span class="text-danger" id="error_addeducation_informations"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Qualification</label>
                                        <input type="text" id="qualification" name="qualification" aria-label="name" class="form-control">
                                        <span class="text-danger" id="error_addqualification"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Department/Specialist</label>
                                        <input type="text" id="specialist" name="specialist" aria-label="name" class="form-control">
                                        <span class="text-danger" id="error_addspecialist"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>When You Seat</label>
                                        <input type="text" id="whenyouseat" name="whenyouseat" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_addwhenyouseat"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Seating day</label>
                                        <input type="text" id="seating_day" name="seating_day" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_addseating_day"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Institute</label>
                                        <input type="text" id="friday_seating_time" name="friday_seating_time" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_addfriday_seating_time"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Visit Fee</label>
                                        <input type="text" id="visit_fee" name="visit_fee" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_addvisit_fee"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" id="phone" name="phone" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_addphone"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Birthday</label>
                                        <input type="date" id="birthday" name="birthday" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_addbirthday"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" id="address" name="address" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_addaddress"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option selected>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <span class="text-danger" id="error_addgender"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" id="email" name="email" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_email"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>password</label>
                                        <input type="text" id="password" name="password" aria-label="date" class="form-control">
                                        <span class="text-danger" id="error_password"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary font-weight-bold" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- --- -->

<script>
    $('#addDoctorForm').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize()
        $.ajax({
            method: 'post',
            url: "{{route('add.doctor') }}",
            data: formData,
            success: function(result) {
                if (result.status === true) {
                    toastr.success('Add Doctor Success!', 'Add Doctor');
                    $('#myModal').modal('hide');
                    // window.location.href = "/doctor-list";
                } else {
                    toastr.success('Add Doctor Failed!', 'Adding Failed');
                }
            },
            error: function(response) {
                $('#error_addname').text(response.responseJSON.errors.name);
                $('#error_addeducation_informations').text(response.responseJSON.errors.education_informations);
                $('#error_addqualification').text(response.responseJSON.errors.qualification);
                $('#error_addspecialist').text(response.responseJSON.errors.specialist);
                $('#error_addwhenyouseat').text(response.responseJSON.errors.whenyouseat);
                $('#error_addseating_day').text(response.responseJSON.errors.seating_day);
                $('#error_addfriday_seating_time').text(response.responseJSON.errors.friday_seating_time);
                $('#error_addvisit_fee').text(response.responseJSON.errors.visit_fee);
                $('#error_addphone').text(response.responseJSON.errors.phone);
                $('#error_addbirthday').text(response.responseJSON.errors.birthday);
                $('#error_addaddress').text(response.responseJSON.errors.address);
                $('#error_addgender').text(response.responseJSON.errors.gender);
                $('#error_email').text(response.responseJSON.errors.email);
                $('#error_password').text(response.responseJSON.errors.password);
            }
        })
    })

    $(document).on('click', '#editBtn', function() {
        // e.preventDefault();
        let id = $(this).attr('data-editId');
        // alert(id)
        $.ajax({
            url: "{{route('doctor.list.data')}}",
            data: {
                id: id
            },
            success: function(result) {
                console.log(result.name)
                $('#dept').text(result.name)
                $('#drId').val(result.id)
                // $('#drName').innerText(result.name)
                $('#name').val(result.name)
                $('#education_info').val(result.education_informations)
                $('#qualification').val(result.qualification)
                $('#specialist').val(result.specialist)
                $('#whenyouseat').val(result.whenyouseat)
                $('#seating_day').val(result.seating_day)
                $('#friday_seating_time').val(result.friday_seating_time)
                $('#visit_fee').val(result.visit_fee)
                $('#phone').val(result.phone)
                $('#birthday').val(result.birthday)
                $('#address').val(result.address)
                // $('#gender').val(result.gender)
                // $('#gender').find(result.gender).trigger('change');
                $('#updateGender option[value="' + result.gender + '"]').prop('selected', true).trigger("change");
            }

        })
    })
    // -------------------
    $('#DoctorUpdate').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize()
        $.ajax({
            method: 'post',
            url: "{{route('doctor.list.update')}}",
            data: formData,
            success: function(result) {
                if (result.status === true) {
                    toastr.success('Update Doctor Success!', 'Update Doctor');
                    $('#myModal').modal('hide');
                    window.location.href = "/doctor-list";
                } else {
                    // return redirect('/doctor-list/data'); 
                    toastr.success('Something Went Wrong!', 'Try Again');
                }
            },
            error: function(response) {
                $('#error_name').text(response.responseJSON.errors.name);
                $('#error_education_informations').text(response.responseJSON.errors.education_informations);
                $('#error_qualification').text(response.responseJSON.errors.qualification);
                $('#error_specialist').text(response.responseJSON.errors.specialist);
                $('#error_whenyouseat').text(response.responseJSON.errors.whenyouseat);
                $('#error_seating_day').text(response.responseJSON.errors.seating_day);
                $('#error_friday_seating_time').text(response.responseJSON.errors.friday_seating_time);
                $('#error_visit_fee').text(response.responseJSON.errors.visit_fee);
                $('#error_phone').text(response.responseJSON.errors.phone);
                $('#error_birthday').text(response.responseJSON.errors.birthday);
                $('#error_address').text(response.responseJSON.errors.address);
                $('#error_gender').text(response.responseJSON.errors.gender);
            }
        })
    });
    // ---------------------------
    $(document).on('click', '#deleteBtn', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-deleteId')
        let name = $(this).attr('data-name')
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete "+name+"!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'post',
                    url: '{{route("doctor.delete")}}',
                    data: {
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.status === true) {
                            Swal.fire(
                                'Deleted!',
                                name+ 'has been deleted.',
                                'success'
                            )
                            location.reload();
                        }
                       
                    }
                })
            }
        })
    })
    // --------------
    $(document).on('click', '#statusBtn', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-statusId');
        let status = $(this).prop('checked') == true ? 1 : 0;
        let showStatus = status === 1 ? "Enable" : "Disable";
        Swal.fire({
            title: 'Are you sure?',
            // text: "You won't be able to revert this!",
            text: "You want to " + showStatus + "  this Doctor!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, " + showStatus + " it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'get',
                    url: '{{route("doctor.status")}}',
                    data: {
                        'id': id,
                        'status': status,
                    },
                    success: function(data) {
                        Swal.fire(
                            "" + showStatus + "!",
                            "Doctor has been " + showStatus + ".",
                            'success'
                        )
                        window.location.href = "/doctor-list";
                    }
                })
            }
        })
    })


    // load more
    $(document).ready(function() {
        var postsPerPage = 12;
        var totalPosts = $('.doctor-list').length;
        var loadedPosts = postsPerPage;

        $('.doctor-list').hide();
        $('.doctor-list:lt(' + loadedPosts + ')').show();

        $('#load-more').click(function() {
            loadedPosts += postsPerPage;
            $('.doctor-list:lt(' + loadedPosts + ')').show();

            if (loadedPosts >= totalPosts) {
                $(this).hide();
            }else {
            $(this).show();
        }

        });
        // if (loadedPosts >= totalPosts) {
        //     $('#load-more').hide();
        // } else {
        //     $('#load-more').show();
        // }

    });
</script>
@endpush

@endsection