<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('superAdmin')}}/assets/img/favicon.ico">
    <title>Update Prescription MediCareOPS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- toats -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,700&family=Nunito:wght@200;300;600&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700;1,800&family=Work+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Lato', sans-serif;
            /* font-family: 'Nunito', sans-serif;
            font-family: 'Open Sans', sans-serif;
            font-family: 'Work Sans', sans-serif; */
            font-style: italic;
        }

        .doctor-details h2 {
            font-size: 25px;
            font-weight: 600;
            /* color: #4CAF50; */
            color: #4b4745;
        }

        .doctor-details .Education {
            font-size: 20px;
            font-weight: 500;
            color: #4CAF50;
        }

        .doctor-details span {
            font-size: 16px;
            font-weight: 400;
            color: #173518;
        }

        .cti h3 {
            font-size: 16px;
        }

        input,
        tbody {
            font-size: 14px;
        }

        form {
            color: #4b4745;
        }

        #tbody tr td {
            margin-left: 10px;
            padding-left: 30px;
        }

        .row1 {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        body {
            background: radial-gradient(ellipse at center,
                    #fffeea 0%,
                    #fffeea 35%,
                    #b7e8eb 100%);
            /* overflow: hidden; */
        }

        /* add new */
        .added_medicine_style {
            /* background-color: #e9ecef; */
            width: 100%;
            padding: 0.375rem 2.25rem 0.375rem 0.75rem;
            -moz-padding-start: calc(0.75rem - 3px);
            font-size: 0.8rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #e9ecef;
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        #medicinetag {
            display: none;
        }

        ul,
        li {
            font-size: 0.8rem;
        }

        th {
            font-size: 14px;
        }

        /* table td{
            font-size: 4px;
        } */
        .aftbfr-select,
        .gender-select {
            color: #6c757d;
        }

        @media screen and (max-width: 480px) {
            .row1 {
                display: flex;
                gap: 6px;
            }

            .doctor-details h2 {
                font-size: 10px;
            }

            .doctor-details .Education {
                font-size: 11px;
            }

            .doctor-details span {
                font-size: 8px;
            }
        }

        @media print {
            @page {
                size: A4 landscape;
                margin: 0;
                padding: 0;
                width: 100%;
                text-align: center;
            }

            button[name="bttn"] {
                display: none;
            }

            .medicine_input {
                display: none;
            }

            .browsers {
                display: none;
            }

            .btn {
                display: none;
            }

            .container a {
                display: none;
            }

            .content {
                background: radial-gradient(ellipse at center,
                        #fffeea 0%,
                        #fffeea 35%,
                        #b7e8eb 100%);
            }

            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .row1 {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 40px;
            }

            /* add new */
            .select2-selection__clear {
                display: none;
            }

            .select2-selection__choice__remove {
                display: none;

            }

            .added_medicine_style {
                border: none;
                outline: none;
            }

            .select2-container--default .select2-selection--multiple {
                border: none;
                outline: none;
                background-color: transparent;
            }

            table {
                margin-top: -20px;
            }

            .cti {
                margin-bottom: 0px;
            }

            #medicinetag {
                display: block;
            }

            #backArrow {
                display: none;
            }

            /* header {page-break-after: always;} */
        }
    </style>
</head>

<body>

    <button style="outline: none; border:none; background: none;" id="backArrow" data-id="{{$prescriptions->id}}" onclick="history.back()"><i
            class="fa fa-arrow-left px-2" aria-hidden="true"></i>Back</button>
    <div>
        <header id="header" style="width: 100%;">
            <div>
                <div class="row1 shadow  p-2">
                    <div class="doctor-details d-flex flex-column">
                        <h2 class="name text-info">{{$doctorDetails->name}} </h2>
                        <span class="qualification Degree">{{$doctorDetails->qualification}}</span>
                        <span class="Education Informations">{{$doctorDetails->education_informations}}</span>
                        <span class="institute">{{$doctorDetails->friday_seating_time}}</span>
                        <span class="specialist text-danger">{{$doctorDetails->specialist}}</span>
                    </div>
                    <div class=" doctor-details text-center">
                        <h2>রোগী দেখার সময়</h1>
                            <div class="text-center d-flex flex-column">
                                <span class="seating-day">প্রতিদিন : {{$doctorDetails->seating_day}}</span>
                                <span class="seating-time">সময় : {{$doctorDetails->whenyouseat}}</span>
                            </div>
                    </div>
                    <div class=" doctor-details d-flex flex-column" id="chember-details">
                        <h2 class="clinic-name">{{$clinicDetails->clinic_name}} </h1>
                            <span class="location">Address: {{$clinicDetails->location}}</span>
                            <!-- <h3>location_details</h3> -->
                            <span class="phone no">Phone: {{$doctorDetails->phone}}</span>
                            <span>RegNo: <span class="ml-2">{{$prescriptions->reg_no}}</span></span>
                    </div>
                </div>
            </div>
        </header>

        <main id="content">
            <!-- ------------------- -->

            <form id="medicineSubmitForm">
                @csrf
                <input type="hidden" name="prescription_id" value="{{$prescriptions->id}}">
                <input type="hidden" name="dr_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="visit_fee" value="{{Auth::user()->visit_fee}}">
                <!-- <input type="hidden" name="reg_no" value="{{$prescriptions->reg_no}}" id=""> -->
                <div class="container-fluid my-4">
                    <div class="row conacani1">
                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-text">Patient name</span>
                                <span class="form-control">{{$prescriptions->patient_name}}</span>
                                <!-- <input type="text" name="patient_name" aria-label="name"
                                    value="{{$prescriptions->patient_name}}" class="form-control"> -->
                            </div>
                            <p class="text-danger" id="patient_nameErrorMsg"></p>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <span class="input-group-text">Gender</span>
                                <span class="form-control">{{$prescriptions->patient_gender}}</span>
                                <!-- <input type="text" name="patient_gender" aria-label="name" class="form-control"> -->
                                <!-- <select name="patient_gender" id="" class="form-control gender-select">
                                    <option selected>{{$prescriptions->patient_gender}}</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select> -->
                            </div>
                            <p class="text-danger" id="patient_genderErrorMsg"></p>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <span class="input-group-text">Age</span>
                                <span class="form-control">{{$prescriptions->patient_age}}</span>
                                <!-- <input type="text" name="patient_age" aria-label="name"
                                    value="{{$prescriptions->patient_age}}" class="form-control"> -->
                            </div>
                            <p class="text-danger" id="patient_ageErrorMsg"></p>
                        </div>
                        <input type="hidden" name="reg_no" value="{{$prescriptions->reg_no}}">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <span class="input-group-text">Date</span>
                                <span class="form-control">{{$prescriptions->date}}</span>
                                <!-- <input type="text" name="date" aria-label="date" value="{{$prescriptions->date}}"
                                    class="form-control"> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 border-end">
                            <div class="flex my-3 conacani2">
                                <div class="col-sm-12">
                                    <h3 class="h5">Chief Complaints</h3>
                                    @if(!empty($prescriptions->complaints))
                                    <ul>
                                        <li>{{$prescriptions->complaints}}</li>
                                    </ul>
                                    @else
                                    <ul>
                                        <li>No complaints</li>
                                    </ul>
                                    @endif
                                    <!-- <div class="input-group">
                                        <input type="text" name="complaints" aria-label="name"
                                            value="{{$prescriptions->complaints}}" placeholder="Enter patient complaints"
                                            class="form-control" style="resize: horizontal; overflow: auto;">
                                    </div> -->
                                </div>
                                <div class="col-sm-12">
                                    <h3 class="h5">Test</h3>
                                    @if(is_array($prescriptions->tests))
                                    <ul>
                                        @foreach(json_decode($prescriptions->tests) as $test)
                                        <li>{{ $test}}</li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <ul>
                                        <li>No tests</li>
                                    </ul>
                                    @endif

                                </div>
                                <div class="col-sm-12">
                                    <h3 class="h5">Investigations</h3>
                                    @if(is_array($prescriptions->investigations))
                                    <ul>
                                        @foreach(json_decode($prescriptions->investigations) as $investigation)
                                        <li>{{ $investigation}}</li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <ul>
                                        <li>No investigation</li>
                                    </ul>
                                    @endif
                                </div>
                                <div class="col-sm-12">
                                    <h3 class="h5">Diagnose</h3>
                                    @if(!empty($prescriptions->diagnoses))
                                    <ul>
                                        <li>{{$prescriptions->diagnoses}}</li>
                                    </ul>
                                    @else
                                    <ul>
                                        <li>No diagnose</li>
                                    </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- ------------------------ -->
                        <div class="col-sm-8 mt-5">
                            <p>RX</p>
                            <div class="bd-highlight">
                                <div class="flex-fill bd-highlight flex-grow-1">
                                    <div class="table position-relative">
                                        <table id="table" class="mt-2 prevent-break table table-bordered">
                                            <thead>
                                                <th class="text-center">Medicine</th>
                                                <th class="text-center">How Much Time</th>
                                                <th class="text-center">Taking Medicine</th>
                                                <th class="text-center">How Much Day</th>
                                            </thead>
                                            <tbody id="tbody">
                                                @php
                                                $medicines = json_decode($prescriptions->medicine ?? '[]');
                                                $howManyTimes = json_decode($prescriptions->howmanytimes ?? '[]');
                                                $afterBefore = json_decode($prescriptions->afterbefore ?? '[]');
                                                $nextDates = json_decode($prescriptions->nextdate ?? '[]');
                                                @endphp

                                                @if(is_array($medicines) && is_array($howManyTimes) && is_array($afterBefore) && is_array($nextDates))
                                                @foreach($medicines as $index => $medicine)
                                                <tr>
                                                    <td>
                                                        <!-- <input class="added_medicine_style" name="medicine[]" type="text"
                                                            value="{{ $medicine }}"> -->
                                                        <p class="added_medicine_style text-center">{{ $medicine }}</p>
                                                    </td>
                                                    <td>
                                                        <!-- <input class="added_medicine_style" name="howmanytimes[]" type="text"
                                                            value="{{ $howManyTimes[$index] ?? '' }}"> -->
                                                        <p class="added_medicine_style text-center">{{ $howManyTimes[$index] ?? '---' }}</p>
                                                    </td>
                                                    <td>
                                                        <!-- <input class="added_medicine_style" name="afterbefore[]" type="text"
                                                            value="{{ $afterBefore[$index] ?? '' }}"> -->
                                                        <p class="added_medicine_style text-center">{{ $afterBefore[$index] ?? '---' }}</p>
                                                    </td>
                                                    <td>
                                                        <!-- <input class="added_medicine_style" name="nextdate[]" type="text"
                                                            value="{{ $nextDates[$index] ?? '' }}"> -->
                                                        <p class="added_medicine_style text-center">{{ $nextDates[$index] ?? '---' }}</p>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="4">No prescription data available.</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ---------- -->
                    </div>
                </div>
                <!-- </div> -->
                <div class="d-grid gap-2 d-md-block m-4">
                    <button onclick="window.print()" class="btn btn-primary" type="button" id="print">Print</button>
                    <button class="btn btn-info text-white" id="review" data-id="{{$prescriptions->id}}">
                    Review Update</button>
                </div>
            </form>


        </main>
        <p id="footer" class="text-center my-2">ধন্যবাদ! স্বাস্থ্যই সম্পদ। নিরাময় প্রতিরোধের চেয়ে ভাল।</p>
    </div>
    <!-- External scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#review', function() {
                let pId = $(this).attr('data-id');
                // alert(patientId);
                $.ajax({
                    url: "{{route('delete.prescription')}}",
                    method: 'post',
                    data: {
                        'pId': pId,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res.status == 'success') {

                            history.back()
                            toastr.info('Back!', 'Back To Review Prescription!')
                        }

                    }
                })

            });
        })
    </script>
</body>

</html>