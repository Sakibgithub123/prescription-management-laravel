<!DOCTYPE html>
<html lang="en">


<!-- register24:03-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>MediCareOPS-Signup</title>
    <link rel="stylesheet" type="text/css" href="{{asset('superAdmin')}}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('superAdmin')}}/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('superAdmin')}}/assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->

</head>

<body>
    <div class="main-wrapper  account-wrapper" style="background-color: #3399FF;">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box shadow">

                    <form method="POST" action="{{ route('register') }}" class="form-signin">
                        @csrf
                        <div class="account-logo">
                            <a><img src="{{asset('superAdmin')}}/assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <h4 class="page-title text-center" style="color:#007bff; font-weight: 900;">MediCareOPS</h4>
                        @if(session('message'))
                        <div class="alert alert-{{ session('alert-type') }}">
                            {{ session('message') }}
                        </div>
                        @endif
                        <h4 class="text-center text-warning" id="textMsg"></h4>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="tab" id="tab-1">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" value="{{old('name')}}" name="name" class="form-control border border-primary rounded" placeholder="Enter your name">
                            </div>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label>Education Informations</label>
                                <input type="text" value="{{old('education_informations')}}" name="education_informations" class="form-control border border-primary rounded" placeholder="Ex:BSMMU(PG Hospital),Dhaka">
                            </div>

                            <div class="form-group">
                                <label>Qualification Degree</label>
                                <textarea class="form-control border border-primary rounded" value="{{old('qualification')}}" name="qualification" id="Qualification" cols="30" rows="10" placeholder="Ex:MBBS, FCPS(Chormo o Jouno), MCPS(Chormo o Jouno)"></textarea>
                            </div>

                            <div class="form-group text-right ">
                                <button class="btn btn-primary account-btn" onclick="run(1,2)" type="button">Next</button>
                            </div>
                            <div class="text-center login-link">
                                Already have an account? <a href="{{route('login-page')}}">Login</a>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="form-group">
                                <label>Department/Specialist</label>
                                <input type="text" name="specialist" value="{{old('specialist')}}" class="form-control border border-primary rounded" placeholder="Ex:Chormo,Alargy,Jouno o sex rog specialist">
                            </div>
                            <div class="form-group">
                                <label>Seating Time</label>
                                <input type="text" name="whenyouseat" value="{{old('whenyouseat')}}" class="form-control border border-primary rounded">
                            </div>
                            <div class="form-group">
                                <label>Seating day</label>
                                <input type="text" name="seating_day" value="{{old('seating_day')}}" class="form-control border border-primary rounded">
                            </div>
                            <div class="form-group">
                                <label>Institute</label>
                                <input type="text" name="friday_seating_time" value="{{old('friday_seating_time')}}" class="form-control  border border-primary rounded">
                            </div>
                            <div class="form-group">
                                <label>Visit Fee</label>
                                <input type="text" name="visit_fee" value="{{old('visit_fee')}}" class="form-control border border-primary rounded">
                            </div>
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" name="phone" value="{{old('phone')}}" class="form-control border border-primary rounded" placeholder="Enter phone nmber">
                            </div>
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="d-flex justify-between gap-5">
                                <div class="form-group ">
                                    <button class="btn btn-primary account-btn" onclick="run(2,1)" type="button">Previous</button>
                                </div>
                                <div class="form-group ml-5">
                                    <button class="btn btn-primary account-btn" onclick="run(2,3)" type="button">Next</button>
                                </div>
                            </div>
                            <div class="text-center login-link">
                                Already have an account? <a href="{{route('login-page')}}">Login</a>
                            </div>

                        </div>
                        <div class="tab" id="tab-3">
                            <div class="form-group">
                                <label>Birthday</label>
                                <input type="date" name="birthday" value="{{old('birthday')}}" class="form-control border border-primary rounded">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" value="{{old('address')}}" class="form-control border border-primary rounded" placeholder="Ex:714 Burwell Heights Road, Bridge City, TX, 77611">
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" id="gender" class="form-control border border-primary rounded">
                                    <option selected>Choose Gender</option>
                                    <option value="Male" {{"Male"===old('gender')? 'selected' : ''}}>Male</option>
                                    <option value="Female" {{"Female"===old('gender')? 'selected' : ''}}>Female</option>
                                </select>
                                <!-- <input type="text" class="form-control border border-primary rounded"> -->
                            </div>
                            <div class="d-flex justify-between gap-5">
                                <div class="form-group ">
                                    <button class="btn btn-primary account-btn" onclick="run(3,2)" type="button">Previous</button>
                                </div>
                                <div class="form-group ml-5">
                                    <button class="btn btn-primary account-btn" onclick="run(3,4)" type="button">Next</button>
                                </div>
                            </div>
                            <div class="text-center login-link">
                                Already have an account? <a href="{{route('login-page')}}">Login</a>
                            </div>

                        </div>

                        <div class="tab" id="tab-4">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" value="{{old('email')}}" class="form-control border border-primary rounded" placeholder="Enter your email address">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control border border-primary rounded" placeholder="Enter your password">
                                <input type="checkbox" onclick="showPass()"> <span class="showpass">Show Password</span>
                            </div>
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control border border-primary rounded" placeholder="Enter confirm password">
                            </div>

                            <div class="form-group text-left">
                                <button class="btn btn-primary account-btn" onclick="run(4,3)" type="button">Previous</button>
                            </div>

                            <div class="form-group checkbox">
                                <label>
                                    <input type="checkbox" id="checkBox" onclick="signupFunction(this.checked)"> I have read and agree the Terms & Conditions
                                </label>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn " id="signupBtn" type="submit">Signup</button>
                            </div>
                            <div class="text-center login-link">
                                Already have an account? <a href="{{route('login-page')}}">Login</a>
                            </div>
                        </div>
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
        console.log(checkBox.checked);

        $(".tab").css("display", "none");
        $("#tab-1").css("display", "block");

        function run(hideTab, showTab) {
            if (hideTab < showTab) { // If not press previous button
                // Validation if press next button
                var currentTab = 0;
                x = $('#tab-' + hideTab);
                y = $(x).find(".form-control")
                for (i = 0; i < y.length; i++) {
                    if (y[i].value == "") {
                        $(y[i]).css("background", "#ffdddd");
                        $('#textMsg').text('Please fill up this field!');
                        return false;
                    } else {
                        $(y[i]).css("background", "#fff");
                        $('#textMsg').text('');
                    }
                }
            }


            // Switch tab
            $("#tab-" + hideTab).css("display", "none");
            $("#tab-" + showTab).css("display", "block");
            $(".form-control").css("background", "#fff");
        }
        ///checkbox
        if (checkBox.checked === false) {
            $('#signupBtn').css('opacity', '0.4')
            $('#signupBtn').attr('disabled', 'disabled');
        }

        function signupFunction(r) {
            if (r === true) {
                $('#signupBtn').css('opacity', '1');
                $('#signupBtn').removeAttr('disabled')
                console.log(r);
            } else {
                $('#signupBtn').css('opacity', '0.4')
                $('#signupBtn').attr('disabled', 'disabled');

            }
        }

         //show password
        function showPass() {
            var x = document.getElementById('password');
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
<!-- register24:03-->
</html>