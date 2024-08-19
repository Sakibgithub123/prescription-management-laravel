<!DOCTYPE html>
<html lang="en">

<!-- forgot-password24:03-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('superAdmin')}}/assets/img/favicon.ico">
    <title>Forget Password</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{asset('superAdmin')}}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('superAdmin')}}/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('superAdmin')}}/assets/css/style.css">

    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
    <!-- sweetalert -->
    <style>
        .form-control {
            border-color: #28a745;

        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
    </style>

</head>

<body>
<!-- <div>
    <h3 class=" bg-primary text-center text-white p-3 mx-5 mt-5">Reset Password</h3>
    </div> -->
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
                <div class="account-box">
                    <form class="setPasswordForm">
                    @csrf
                          <input type="hidden" name="token" value="{{ $token }}">
  
						<div class="account-logo">
                            <a href="#"><img src="{{asset('superAdmin')}}/assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>Enter Your Email</label>
                            <input type="text" name="email" class="form-control" autofocus>
                            <!-- @if ($errors->has('email')) -->
                                      <!-- <span class="text-danger" id="emailError">{{ $errors->first('email') }}</span> -->
                                      <span class="text-danger" id="emailError"></span>
                                  <!-- @endif -->
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control" autofocus>
                            <!-- @if ($errors->has('password')) -->
                                      <span class="text-danger" id="passwordError"></span>
                                  <!-- @endif -->
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="password_confirmation" class="form-control" autofocus>
                            <!-- @if ($errors->has('password_confirmation')) -->
                                      <span class="text-danger" id="password_confirmationError"></span>
                                      <!-- <span class="text-danger" id="password_confirmationError">{{ $errors->first('password_confirmation') }}</span> -->
                                  <!-- @endif -->
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" type="submit">Reset Password</button>
                        </div>
                        <!-- <div class="text-center register-link">
                            <a href="{{route('login-page')}}">Back to Login</a>
                        </div> -->
                    </form>
                </div>
			</div>
        </div>
    </div>
    <script src="{{asset('superAdmin')}}/assets/js/jquery-3.2.1.min.js"></script>
    <script src="{{asset('superAdmin')}}/assets/js/popper.min.js"></script>
    <script src="{{asset('superAdmin')}}/assets/js/bootstrap.min.js"></script>
    <script src="{{asset('superAdmin')}}/assets/js/app.js"></script>


    <script>
         $(document).ready(function(){
        $('#setPasswordForm').on('submit',function(e){
            e.preventDefault();
            let formData=$(this).serialize();
            $.ajax({
                method:'post',
                url:"{{route('freset.password.post')}}",
                data:formData,
                success: function(data){
                    if(data.status = true){
                        toastr.success('message', 'Your password has been changed!');
                        window.location.href='/'
                    }else{
                        toastr.error('Something wrong!', 'Try again!');
                    }
                },
                error: function(response) {
                        $('#emailError').text(response.responseJSON.errors.email);
                        $('#passwordError').text(response.responseJSON.errors.email);
                        $('#password_confirmationError').text(response.responseJSON.errors.password_confirmation);
                        // $('#passwordError').text(response.responseJSON.errors.password);

                    }
            })
        })
        
    })


    </script>




</body>


<!-- forgot-password24:03-->
</html>