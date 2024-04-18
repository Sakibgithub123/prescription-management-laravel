@extends('frontEnd.master');
@section('title')
Medilab-Settings
@endsection

@section('content')
<div class="content">
    <h4 class="page-title text-center">Password Change </h4>
    <div class="row">
        <div class="col-md-6 offset-md-3 shadow p-5 ">
            <h4 class="page-title text-center my-2">Change Your Password</h4>
            <form id="changePassForm">
                <div class="row">
                    <div class="col-sm-12">
                        @csrf
                        <input type="hidden" name="UserId" value="{{Auth::user()->id}}">
                        <div class="form-group">
                            <label>Old password</label>
                            <input type="password" name="old_password" class="form-control">
                            <span class="text-danger" id="old_passwordErrorMsg"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>New password</label>
                            <input type="password" name="new_password" class="form-control">
                            <span class="text-danger" id="new_passwordErrorMsg"></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Confirm password</label>
                            <input type="password" name="confirm_password" class="form-control">
                            <span class="text-danger" id="confirm_passwordErrorMsg"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center m-t-20 ">
                        <!-- <input type="submit" class="btn btn-primary submit-btn" value="Update Password"> -->
                        <input type="submit" class="btn btn-primary" value="Update Password">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')

<!-- <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> -->

<script>
    $(document).ready(function() {
        $('#changePassForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                method: 'post',
                url: "{{route('save.change.password')}}",
                data: formData,
                success: function(data) {
                    if (data.status = 'success') {
                        toastr.success("Update Password Successfully!", "Update Password!");
                    } else {
                        toastr.error("Something wrong!", "Try again");
                    }
                },
                error: function(response) {
                    $('#old_passwordErrorMsg').text(response.responseJSON.errors.old_password);
                    $('#new_passwordErrorMsg').text(response.responseJSON.errors.new_password);
                    $('#confirm_passwordErrorMsg').text(response.responseJSON.errors.confirm_password);
                },

            });
        })

    });
</script>
@endpush

@endsection

<!-- ghgfhg  fgfg -->