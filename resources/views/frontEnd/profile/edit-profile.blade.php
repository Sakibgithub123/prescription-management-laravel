@extends('frontEnd.master');
@section('content')
<style>
     label{
        color: #003366;
        font-weight: bold;
    }
    ::placeholder{
        color: #003366;

    }
    input{
        border: 1px solid #007bff;
    }
</style>
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Edit Profile</h4>
        </div>
    </div>
    <form id="updateUserForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="userId" name="user_id" value="{{Auth::user()->id}}">
        <div class="card-box">
            <h3 class="card-title">Basic Informations</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-img-wrap">
                        @if(!$editProfile->profile_image)
                        <a href="#"><img class="avatar" src="{{asset('superAdmin')}}/assets/img/doctor-03.jpg" alt="{{$editProfile->name}}"></a>
                        @else
                        <img class="inline-block" id="output" src="{{asset('storage/images/'.$editProfile->profile_image)}}" alt="{{$editProfile->name}}">
                        @endif
                        <div class="fileupload btn">
                            <span class="btn-text"><i class="fa fa-camera" aria-hidden="true"></i></span>
                            <input class="upload" type="file" name="profile_image" accept="image/*" onchange="loadFile(event)">
                        </div>
                    </div>
                    <div class="profile-basic">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="focus-label">Name</label>
                                    <input type="text" name="name" class="form-control floating" value="{{$editProfile->name}}">
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Last Name</label>
                                                <input type="text" class="form-control floating" value="Doe">
                                            </div>
                                        </div> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="focus-label">Birth Date</label>
                                    <!-- <div class="cal-icon"> -->
                                        <input name="birthday" class="form-control floating datetimepicker" type="text" value="{{$editProfile->birthday}}">
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group  select-focus">
                                    <label class="focus-label">Gendar</label>
                                    <select name="gender" class="select form-control floating">
                                        <option selected>{{$editProfile->gender}}</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-box">
            <h3 class="card-title">Contact Informations</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="focus-label">Address</label>
                        <input type="text" name="address" class="form-control floating" value="{{$editProfile->address}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="focus-label">Email</label>
                        <input type="text" name="email" class="form-control floating" value="{{$editProfile->email}}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="focus-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control floating" value="{{$editProfile->phone}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-box">
            <h3 class="card-title">Education Informations</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="focus-label">Education Informations</label>
                        <input type="text" name="education_informations" class="form-control floating" value="{{$editProfile->education_informations}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="focus-label">Qualification</label>
                        <input type="text" name="qualification" class="form-control floating" value="{{$editProfile->qualification}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="focus-label">Specialist/Department</label>

                        <input type="text" name="specialist" class="form-control floating datetimepicker" value="{{$editProfile->specialist}}">

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="focus-label">When You Seat</label>

                        <input type="text" name="whenyouseat" class="form-control floating datetimepicker" value="{{$editProfile->whenyouseat}}">

                    </div>
                </div>

            </div>
        </div>
        <div class="text-center m-t-20">
            <button name="submit" class="btn btn-primary submit-btn font-weight-bold" type="submit">Save</button>
        </div>
    </form>
</div>

@push('scripts')



<script type="text/javascript">
    $(document).ready(function() {
        $('#updateUserForm').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();
            $.ajax({
                url: "{{route('save.profile.edit')}}",
                method: 'post',
                // data: formData,
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.status == 'success') {
                        // alert('ok');
                        toastr.success('Profile Update!', 'Profile updated successfully!')
                        $('.profile_image').attr('src', data.profile_image).show();
                    } else {
                        toastr.error('Something wrong!', 'Try again!');
                    }
                }
            })
        })
    });
    var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>


@endpush

@endsection