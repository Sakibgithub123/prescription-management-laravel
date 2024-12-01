<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('superAdmin')}}/assets/img/favicon.ico">
    <title>Patient Prescription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- toats -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,700&family=Nunito:wght@200;300;600&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700;1,800&family=Work+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


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
            font-size: 1rem;
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

        /* table td{
            font-size: 4px;
        } */
        .aftbfr-select,
        .gender-select {
            color: #6c757d;
        }

        @media screen and (max-width: 480px) {
            .row1{
                display: flex;
                
                gap: 6px;
            }
            .doctor-details h2 {
                font-size: 10px;
            }
            .doctor-details .Education {
                font-size: 11px;
            }
            .doctor-details span{
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
<!-- antiquewhite -->

<body>
<button style="outline: none; border:none; background: none;" id="backArrow" onclick="history.back()"><i class="fa fa-arrow-left px-2" aria-hidden="true"></i>Back</button>
    <div >
    <header style="width: 100%;">
            <div class="">
            <div class="row1 shadow  p-2 ">
                    <div class="doctor-details d-flex flex-column" >
                        <h2 class="name text-info">{{$prescriptions->name}} </h2>
                        <span class="qualification Degree">{{$prescriptions->qualification}}</span>
                        <span class="Education Informations">{{$prescriptions->education_informations}}</span>
                        <span class="institute">{{$prescriptions->friday_seating_time}}</span>
                        <span class="specialist text-danger">{{$prescriptions->specialist}}</span>
                    </div>
                    <div class="doctor-details   "  >
                        <h2 class="text-center">রোগী দেখার সময়</h2>
                        <div class="text-center d-flex flex-column">
                            <span class="seating-day">প্রতিদিন : {{$prescriptions->seating_day}}</span>
                            <span class="seating-time">সময় : {{$prescriptions->whenyouseat}}</span>
                        </div>
                    </div>
                    <div class="doctor-details  d-flex flex-column"  id="chember-details" >
                        <h2 class="clinic-name">{{$clinicDetails->clinic_name}} </h2>
                        <span class="location">Address: {{$clinicDetails->location}}</span>
                        <!-- <h3>location_details</h3> -->
                        <span class="phone no">Phone: {{$prescriptions->phone}}</span>
                        <span>RegNo: <span class="ml-2">{{$prescriptions->reg_no}}</span></span>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <!-- ------------------- -->
            <form id="medicineSubmitForm">
                @csrf
                <div class="container-fluid my-4">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-text">Patient name</span>
                                <input type="text" name="patient_name" value="{{$prescriptions->patient_name}}" aria-label="name" class="form-control input">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group">
                                <span class="input-group-text">Gender</span>
                                <input type="text" name="patient_gender" value="{{$prescriptions->patient_gender}}" aria-label="name" class="form-control input">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="input-group">
                                <span class="input-group-text">Age</span>
                                <input type="text" name="patient_age" value="{{$prescriptions->patient_age}}" aria-label="name" class="form-control input">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <span class="input-group-text">Date</span>
                                <!-- <input type="text" name="date" value="{{date('F jS, Y g:i A', strtotime($prescriptions->date))}}" aria-label="date" class="form-control input"> -->
                                <input type="text" name="date" value="{{date('d-m-y g:i:s a',strtotime($prescriptions->date))}}" aria-label="date" class="form-control input">
                            </div>
                        </div>
                    </div>
                    <div class="row cti my-3 ">
                        <div class="col-sm-3 col-md-3">
                            <h3 class="text-center">Chief Complaints</h3>
                            <!-- <div class="input-group ">
                                <select class="form-select input  tag1" name="complaints[]" multiple="multiple" aria-label="Default select example">
                                    @if($prescriptions->complaints)
                                    @foreach(json_decode($prescriptions->complaints) as $member)
                                    <option value="{{$member}}" selected>{{$member}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div> -->
                            <div class="input-group">
                                <input type="text" name="complaints" aria-label="name" value="{{$prescriptions->complaints}}" placeholder="Enter patient complaints" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <h3 class="text-center">Test</h3>
                            <div class="input-group ">
                                <select class="form-select input  tag2" name="tests[]" multiple="multiple" aria-label="Default select example">
                                    @if($prescriptions->tests)
                                    @foreach(json_decode($prescriptions->tests) as $member)
                                    <option value="{{$member}}" selected>{{$member}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <h3 class="text-center">Investigations</h3>
                            <div class="input-group text-center">
                                <select class="form-select input  tag3" name="investigations[]" multiple="multiple" aria-label="Default select example">
                                    @if($prescriptions->investigations)
                                    @foreach(json_decode($prescriptions->investigations) as $member)
                                    <option value="{{$member}}" selected>{{$member}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <h3 class="text-center">Diagnose</h3>
                            <!-- <div class="input-group text-center">
                                <select class="form-select input  tag3" name="diagnoses[]" multiple="multiple" aria-label="Default select example">
                                    @if($prescriptions->diagnoses)
                                    @foreach(json_decode($prescriptions->diagnoses) as $member)
                                    <option value="{{$member}}" selected>{{$member}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div> -->
                            <div class="input-group">
                                <input type="text" name="diagnoses" aria-label="name" value="{{$prescriptions->diagnoses}}" placeholder="Enter patient diagnoses" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <!-- ------------------------ -->
                    <div class="bd-highlight">
                        <div class="flex-fill bd-highlight flex-grow-1">
                            <div class="row cti my-1">
                                <p id="medicinetag">Medicine:</p>
                                <div class="col-sm">
                                    <input class="form-select input medicine_input" type="text" list="medicine" id="medi" name="medicine" onfocus="this.value=''" placeholder="Select Medicine">
                                </div>
                                <div class="col-sm">
                                    <input class="form-select input medicine_input" type="text" list="when" id="medi2" name="whenTake" onfocus="this.value=''" placeholder="Select when take Medicine">
                                </div>
                                <div class="col-sm">
                                    <input class="form-select medicine_input" type="text" id="medi3" name="aftBfrEat" list="food" onfocus="this.value=''" placeholder="Select After or Before Eat Food">
                                </div>
                                <div class="col-sm">
                                    <input class="form-select input medicine_input" type="text" id="medi4" name="inputbtn" onfocus="this.value=''" placeholder="Select how much day take Medicine">
                                </div>
                            </div>

                            <button class="btn btn-success my-2" disabled id="addMedicineBtn" type="button">Add Medicine</button>
                            <div class="table position-relative">
                                <table id="table" class="table table-bordered">
                                    <tbody id="tbody">
                                        <tr>
                                            <td>
                                                @if($prescriptions->medicine)
                                                @foreach(json_decode($prescriptions->medicine) as $members)
                                                <input class="added_medicine_style" name="medicine[]" type="text" value="{{$members}}">
                                                @endforeach
                                                @endif
                                            </td>
                                            <td>
                                            @if($prescriptions->howmanytimes)
                                                @foreach(json_decode($prescriptions->howmanytimes) as $members)
                                                <input class="added_medicine_style" name="howmanytimes[]" type="text" value="{{$members}}">
                                                @endforeach
                                                @endif
                                            </td>
                                            <td>
                                            @if($prescriptions->afterbefore)
                                                @foreach(json_decode($prescriptions->afterbefore) as $members)
                                                <input class="added_medicine_style" name="afterbefore[]" type="text" value="{{$members}}">
                                                <!-- <input class="added_medicine_style" name="afterbefore[]" type="text" value="{{$members==='after'?'খাবার পরে' :'খাবার আগে'}}"> -->
                                                @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                <!-- class="form-select" -->
                                                @if($prescriptions->nextdate)
                                                @foreach(json_decode($prescriptions->nextdate) as $members)
                                                <input class="added_medicine_style" name="nextdate[]" type="text" value="{{$members}}">
                                                @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- ---------- -->
                </div>
                <div class="d-grid gap-2 m-2 d-md-block">
                    <button onclick="window.print()" class="btn btn-primary" type="button" id="print">Print</button>
                </div>
            </form>
        </main>
        <p id="footer" class="text-center my-2">ধন্যবাদ! স্বাস্থ্যই সম্পদ। নিরাময় প্রতিরোধের চেয়ে ভাল।</p>

    </div>
    <script>
        var medi = document.getElementById('medi');
        var medi2 = document.getElementById('medi2');
        var medi3 = document.getElementById('medi3');
        var medi4 = document.getElementById('medi4');
        var addMedicineBtn = document.getElementById('addMedicineBtn');
        addMedicineBtn.addEventListener("click", function() {
            var tr = document.createElement("tr");
            var td = document.createElement('td');
            td.innerHTML = ` <input  class="form-select" name="medicine[]" type="text" value="${medi.value}">`
            // td.innerHTML = medi.value;
            tr.appendChild(td);

            var td2 = document.createElement('td');
            td2.innerHTML = ` <input  class="form-select" name="howmanytimes[]" type="text" value="${medi2.value}">`
            // td2.innerHTML = medi2.value;
            tr.appendChild(td2);

            var td3 = document.createElement('td');
            td3.innerHTML = ` <input  class="form-select" name="afterbefore[]" type="text" value="${medi3.value}">`
            // td3.innerHTML = medi3.value;
            tr.appendChild(td3);

            var td4 = document.createElement('td');
            td4.innerHTML = ` <input  class="form-select" name="nextdate" type="text" value="${medi4.value}">`
            // td4.innerHTML = medi4.value;
            tr.appendChild(td4);

            var td5 = document.createElement('td');
            td5.innerHTML = '<button name="bttn" title="Delete" onclick="removerowtable(this)" id="bttn"><i class="fa-solid fa-trash-can"></i></button>';
            tr.appendChild(td5);

            document.getElementById("tbody").appendChild(tr);
        })

        function removerowtable(r) {
            var p = r.parentNode.parentNode;
            document.getElementById("tbody").removeChild(p);
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.tag1').select2({
                placeholder: 'Select Complaints',
                allowClear: true,
            });
            $('.tag2').select2({
                // placeholder: 'Select Examinations',
                placeholder: 'Select Tests',
                allowClear: true,
            });
            $('.tag3').select2({
                placeholder: 'Select Investigations',
                allowClear: true,
            });

            $('#medicineSubmitForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{route('save.prescription')}}",
                    method: "post",
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            alert('ok');
                        } else {
                            alert('not ok')
                        }

                    }
                })

            })

            $('.input').prop('readonly', true);
            $('.form-select').prop('disabled', true);
            $('.added_medicine_style').prop('disabled', true);
        });
    </script>
</body>
</html>

