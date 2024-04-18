<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>





    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

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
            font-family: 'Lato', sans-serif;
            font-family: 'Nunito', sans-serif;
            font-family: 'Open Sans', sans-serif;
            font-family: 'Work Sans', sans-serif;
        }

        .dr-details h2 {
            font-size: 22px;
            font-weight: 600;

        }

        .dr-details h4 {
            font-size: 18px;
            font-weight: 600;
        }

        .dr-details p {
            font-size: 15px;
            font-weight: 400;
        }
        #tbody tr td{
    margin-left: 10px;
    padding-left: 30px;
}

@media print{
    @page{
        size: A4;
        margin: 0;
    }
    button[name="bttn"]{
        display: none;
    }
    .medicine_input{
        display: none;
    }
    .browsers{
        display: none;
    }
    .btn{
        display: none;
    }
    .container a{
        display: none;
    }
}
       
    </style>


</head>

<body>
    <div>
        <header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm dr-details">
                        <h2 class="name text-primary">Dr.KM Majedul Islam </h1>
                            <p class="qualification Degree">MBBS, FCPS(Chormo o Jouno), MCPS(Chormo o Jouno)</p>
                            <h4 class="Education Informations">BSMMU(PG Hospital),Dhaka
                            </h4>
                            <p class="specialist text-danger">Chormo,Alargy,Jouno o sex rog specialist</p>
                    </div>
                    <div class="col-sm dr-details">
                        <h2>Time to see the patient </h1>
                            <p class="when you seat">Bikal 5- rat 8</p>
                            <h4>time
                            </h4>
                    </div>
                    <div class="col-sm dr-details" id="chember-details">
                        <h2>Dhaka medical hall </h1>
                            <p>malibagh,Dhaka</p>
                            <h4>location_details
                        </h2>
                        <p class="phone no">01712345676</p>
                    </div>
                </div>


            </div>


        </header>
        <main>


            <!-- ------------------- -->
            <form  id="medicineSubmitForm">
                @csrf
                <input type="text" name="dr_id" value="{{Auth::user()->id}}">
                <div class="container-fluid my-4">
                    <div class="row">
                        <div class="col-sm">
                            <div class="input-group">
                                <span class="input-group-text">Patient name</span>
                                <input type="text" name="patient_name" aria-label="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="input-group">
                                <span class="input-group-text">Age</span>
                                <input type="text" name="patient_age" aria-label="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="input-group">
                                <span class="input-group-text">Date</span>
                                <input type="text" name="date" aria-label="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- ------------------------ -->
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-fill bd-highlight my-4" style="border-right: 1px solid red;">
                            <div class="mb-4">
                                <h5>Chief Complaints</h5>
                                <select class="form-select  tag1" name="complaints[]" multiple="multiple" aria-label="Default select example">
                                    <!-- <option selected>Chief Complaints</option> -->
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="4">Four</option>
                                    <option value="5">Five</option>
                                    <option value="6">six</option>
                                    <option value="7">seven</option>
                                </select>
                            </div>
                            <div class="my-4">
                                <h5>On Examinations</h5>
                                <select class="form-select  tag2" name="examinations[]" multiple="multiple" aria-label="Default select example">
                                    <!-- <option selected>On Examinations</option> -->
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="my-4">
                                <h5>Investigations</h5>
                                <select class="form-select  tag3" name="investigations[]" multiple="multiple" aria-label="Default select example">
                                    <!-- <option selected>Investigation</option> -->
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="d-grid gap-2 d-md-block">
                                <button onclick="window.print()" class="btn btn-primary" type="button" id="print">Print</button>
                                <!-- <input type="submit" class="btn btn-danger" value="Save"> -->
                                <!-- <button class="btn btn-danger" type="button">Save</button> -->
                                <input class="btn btn-success" type="reset" value="Reset">
                            </div>
                        </div>
                        <div class="p-2 flex-fill bd-highlight flex-grow-1">
                            <div class="row my-4">
                                <div class="col-sm">
                                    <!-- <select class="form-select" id="medi" aria-label="Default select example">
                                        <option selected>select medicine</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select> -->
                                    <input class="form-select" type="text" list="medicine" id="medi" name="medicine" onfocus="this.value=''">
                                </div>
                                <div class="col-sm">
                                    <!-- <select class="form-select" id="medi2" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select> -->
                                    <input class="form-select" type="text" list="when" id="medi2" name="whenTake" onfocus="this.value=''">
                                </div>
                                <div class="col-sm">
                                    <select class="form-select" id="medi3" name="aftBfrEat" aria-label="Default select example">
                                        <option selected>Select After or Before</option>
                                        <option value="before eat">খাবারের আগে </option>
                                        <option value="after eat">খাবারের পরে</option>
                                        <!-- <option value="3">Three</option> -->
                                    </select>
                                    <!-- <input class="form-select" type="text" list="food" id="medi3" name="aftBfrEat"> -->
                                </div>
                                <div class="col-sm">
                                    <!-- <select class="form-select" id="medi4" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select> -->
                                    <input class="form-select" type="text" id="medi4" name="inputbtn" onfocus="this.value=''">
                                </div>
                                <!-- <input type="button" id="addMedicineBtn" class="btn btn-success" name="inputbtn" value="add medicine"> -->
                                
                            </div>
                            <button class="btn btn-success" id="addMedicineBtn" type="button">Add Medicine</button>
                            <div class="table">
                                <table>
                                    <tbody id="tbody">

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                    <!-- ---------- -->
                    <datalist id="medicine">
                                        <option value="tab. methox 2.5mg">
                                        <option value="tab. methotrax 2.5mg">
                                        <option value="tab. folita 5mg">
                                        <option value="cap soritac 10mg">
                                        <option value="cap soritac 25mg">
                                        <option value="tab. xalcort 6mg">
                                        <option value="tab. deflacort 6mg">
                                    </datalist>
                                    <datalist id="when">
                                        <option value="1+0+0">
                                        <option value="0+1+0">
                                        <option value="10+0+1">
                                        <option value="1+0+1">
                                        <option value="1+1+0">
                                        <option value="0+1+1">
                                        <option value="1+1+1">
                                    </datalist>
                                    <datalist id="food">
                                        <option value="khabar age">খাবারের আগে </option>
                                        <option value="khabar"> খাবারের পরে </option>
                                    </datalist>
                    <!-- rules -->
                    <div class="rules" style="font-size: 12px;">
                        <dl>
                            <dt>উপদেশঃ</dt>
                            <dd>* কানে তুলা দিয়ে গোসল করবেন / করাবেন।</dd>
                            <dd>* কটন বার দিয়ে দৈনিক ৩বার কান / নাক পরিস্কার করবেন।</dd>
                            <dd>* অপরিস্কার কোন জিনিস দিয়ে কান চুল্কাবেন না।</dd>
                            <br>

                            <dt>নিষেধঃ</dt>
                            <dd>* খাদ্যঃ গরুর মাংস, ডিম, চিংড়ি মাছ, ইলিশ মাছ, বেগুন, কচু, হাসের মাংস, পুঁই শাক, আনারস।</dd>
                            <dd>* কাপড়ঃ টেট্রন,পলেস্টার, উলেন, লিলেন ও সিল্কের কাপড়। পারফিউম কাপড় কাঁচা সাবান। </dd>
                            <dd>* ঔষধঃ কোট্রইমক্সাজল, ডিসপিরিন, ইনডোমেথাসিন, ডক্সিসাইক্লিন, সিপ্রোফক্সাসিন, ডাইক্লোফেনাক, সোডিয়াম, <br> ইটোরিকক্সিব, ন্যাপ্রোক্সেম সোডিয়াম, টেট্রসাইক্লিন, আইবুপ্রফেন জাতীয় ঔষধ খাবেন না।</dd>
                        </dl>
                        <p>**রেজিস্ট্রার ডাক্তারের পরামর্শ অনুযায়ী ঔষধ খাবেন।</p>
                    </div>
                </div>
    </div>
    <input type="submit"  class="btn btn-danger" value="Save">
    </form>

    </main>
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
            td.setAttribute('width','45%')
            td.innerHTML=` <input  class="form-select" name="medicine[]" type="text" value="${medi.value}">`
            // td.innerHTML = medi.value;
            tr.appendChild(td);

            var td2 = document.createElement('td');
            td2.setAttribute('width','17%')
            td2.innerHTML=` <input  class="form-select" name="howmanytimes[]" type="text" value="${medi2.value}">`
            // td2.innerHTML = medi2.value;
            tr.appendChild(td2);

            var td3 = document.createElement('td');
            td3.setAttribute('width','17%')
            td3.innerHTML=` <input  class="form-select" name="afterbefore[]" type="text" value="${medi3.value}">`
            // td3.innerHTML = medi3.value;
            tr.appendChild(td3);

            var td4 = document.createElement('td');
            td4.setAttribute('width','17%')
            td4.innerHTML=` <input  class="form-select" name="nextdate" type="text" value="${medi4.value}">`
            // td4.innerHTML = medi4.value;
            tr.appendChild(td4);

            var td5 = document.createElement('td');
            td5.innerHTML = '<button name="bttn" onclick="removerowtable(this)" id="bttn"><i class="fa-solid fa-trash-can"></i></button>';
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
                placeholder: 'Select Examinations',
                allowClear: true,
            });
            $('.tag3').select2({
                placeholder: 'Select Investigations',
                allowClear: true,
            });

            $('#medicineSubmitForm').on('submit',function(e){
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url:"{{route('save.prescription')}}",
                    method:"post",
                    data:formData,
                    dataType:'json',
                    success:function(data){
                        if(data.status=='success'){
                            alert('ok');
                        }else{
                            alert('not ok')
                        }

                    }
                })
            })






         });

    

    </script>


</body>

</html>