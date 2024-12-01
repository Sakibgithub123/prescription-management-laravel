<!DOCTYPE html>
<html lang="en">
<!-- login23:11-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('superAdmin')}}/assets/img/favicon.ico">
    <title>MediCareOPS - Medical & Hospital</title>
    <!-- <title>Preclinic - Medical & Hospital - Bootstrap 4 Admin Template</title> -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{asset('superAdmin')}}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('superAdmin')}}/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('superAdmin')}}/assets/css/style.css">

    <!-- Home Template Main CSS File -->
    <link rel="stylesheet" type="text/css" href="{{asset('superAdmin')}}/assets/css/bootstrap.min.css">
    <link href="{{asset('homeAsset')}}/assets/css/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    <div class="main-wrapper account-wrapper" style="background-color: #3399FF;">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box" >
                    <!-- action="{{ route('login') }}" -->
                    <form id="loginForm" class="form-signin">
                        @csrf
                        <div class="account-logo">
                            <a><img src="{{asset('superAdmin')}}/assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <h4 class="page-title text-center" style="color:#007bff; font-weight: 900;">MediCareOPS</h4>
                        <div class="form-group">
                            <p class="text-center text-danger" id="errorMessage"></p>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" autofocus="" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <p id="emailError"></p>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <p id="passwordError"></p>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{asset('superAdmin')}}/assets/js/jquery-3.2.1.min.js"></script>
    <script src="{{asset('superAdmin')}}/assets/js/popper.min.js"></script>
    <script src="{{asset('superAdmin')}}/assets/js/bootstrap.min.js"></script>
    <script src="{{asset('superAdmin')}}/assets/js/jquery.slimscroll.js"></script>
    <script src="{{asset('superAdmin')}}/assets/js/app.js"></script>
    <!-- toastr -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                // alert('ok')
                let formData = $(this).serialize();
                $.ajax({
                    method: 'post',
                    url: "{{route('adminlogin')}}",
                    data: formData,
                    success: function(data) {
                        if (data.status === true) {
                            window.location=data.redirect;
                            toastr.success('Login Success.', 'Login!');
                        } else {
                            toastr.error('Something wrong.', 'Try again!');
                            $('#errorMessage').text("Email or Password don't match!");
                        }
                    },
                    error: function(response) {
                        // $('#emailError').text(response.responseJSON.errors.email);
                        // $('#passwordError').text(response.responseJSON.errors.password);
                    }
                })
            })
        })
    </script>
</body>
</html>