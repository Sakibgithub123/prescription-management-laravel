@extends('frontEnd.master');
@section('title')
Medilab-Statistics
@endsection
@section('content')
<style>
    .font {
        font-size: 12px;
    }
</style>

<div class="content">
    <h4 class="page-title text-center py-2" style="background-color:#007bff; color:#003366; font-weight: 900;">My Statistics </h4>
    <div class="row mt-5">
        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="chart-title">
                        <h4>Monthly Generate Visit Fee</h4>
                        <span class="float-right"><i class="fa fa-caret-up" aria-hidden="true"></i>Monthly Visit Fee Per Year</span>
                    </div>
                    <canvas id="linegraph"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="chart-title">
                        <h4>Monthly Appointed Patients</h4>
                        <div class="float-right">
                            <ul class="chat-user-total">
                                <li><i class="fa fa-circle current-users" aria-hidden="true"></i>Patients Per Year</li>
                                <!-- <li><i class="fa fa-circle old-users" aria-hidden="true"></i> OPD</li> -->
                            </ul>
                        </div>
                    </div>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">All Appointments</h4>
                    <!-- <a href="appointments.html" id="load-more" class="btn btn-primary float-right">View all</a> -->
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="d-none">
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Doctor Name</th>
                                    <th>Timing</th>
                                    <th class="text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patients as $patient)
                                <tr class="patientInfo">
                                    <td style="min-width: 200px;">
                                        <a class="avatar">{{ substr($patient->patient_name, 0, 1) }}</a>
                                        <h2><a>{{$patient->patient_name}} <span>Age : {{$patient->patient_age}}</span></a></h2>
                                    </td>
                                    <td>
                                        <h5 class="time-title p-0">Appointment With</h5>
                                        <p>{{$patient->name}}</p>
                                    </td>
                                    <td>
                                        <h5 class="time-title p-0">Timing</h5>
                                        <p>{{date('F ,jS Y g:i A',strtotime($patient->date))}}</p>
                                    </td>
                                    <td>
                                        <!-- <a href="appointments.html" class="btn btn-outline-primary">Take up</a> -->
                                        <h5 class="time-title p-0">Investigation</h5>
                                        <p>


                                            @php
                                            $investigations = json_decode($patient->investigations, true);
                                            @endphp

                                            @if(is_null($investigations) || empty($investigations))
                                            <span class="font">no investigation</span>
                                            @else
                                            @foreach($investigations as $investigation)
                                            <span class="font">{{ $investigation }},</span>
                                            @endforeach
                                            @endif





                                        </p>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-center my-5">
                <button id="load-more" class="btn btn-primary font-weight-bold">View all</button>
            </div>
        </div>
        <!-- <div class="col-12 col-md-6 col-lg-4 col-xl-4">
            <div class="card member-panel">
                <div class="card-header bg-white">
                    <h4 class="card-title mb-0">Doctors</h4>
                </div>
                <div class="card-body">
                    <ul class="contact-list">
                        <li>
                            <div class="contact-cont">
                                <div class="float-left user-img m-r-10">
                                    <a href="profile.html" title="John Doe"><img src="{{asset('superAdmin')}}/assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                </div>
                                <div class="contact-info">
                                    <span class="contact-name text-ellipsis">John Doe</span>
                                    <span class="contact-date">MBBS, MD</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="contact-cont">
                                <div class="float-left user-img m-r-10">
                                    <a href="profile.html" title="Richard Miles"><img src="{{asset('superAdmin')}}/assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                                </div>
                                <div class="contact-info">
                                    <span class="contact-name text-ellipsis">Richard Miles</span>
                                    <span class="contact-date">MD</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="contact-cont">
                                <div class="float-left user-img m-r-10">
                                    <a href="profile.html" title="John Doe"><img src="{{asset('superAdmin')}}/assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                                </div>
                                <div class="contact-info">
                                    <span class="contact-name text-ellipsis">John Doe</span>
                                    <span class="contact-date">BMBS</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="contact-cont">
                                <div class="float-left user-img m-r-10">
                                    <a href="profile.html" title="Richard Miles"><img src="{{asset('superAdmin')}}/assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                </div>
                                <div class="contact-info">
                                    <span class="contact-name text-ellipsis">Richard Miles</span>
                                    <span class="contact-date">MS, MD</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="contact-cont">
                                <div class="float-left user-img m-r-10">
                                    <a href="profile.html" title="John Doe"><img src="{{asset('superAdmin')}}/assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                                </div>
                                <div class="contact-info">
                                    <span class="contact-name text-ellipsis">John Doe</span>
                                    <span class="contact-date">MBBS</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="contact-cont">
                                <div class="float-left user-img m-r-10">
                                    <a href="profile.html" title="Richard Miles"><img src="{{asset('superAdmin')}}/assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                                </div>
                                <div class="contact-info">
                                    <span class="contact-name text-ellipsis">Richard Miles</span>
                                    <span class="contact-date">MBBS, MD</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-footer text-center bg-white">
                    <a href="doctors.html" class="text-muted">View all Doctors</a>
                </div>
            </div>
        </div> -->
    </div>
    <!-- <div class="row">
					<div class="col-12 col-md-6 col-lg-8 col-xl-8">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title d-inline-block">New Patients </h4> <a href="patients.html" class="btn btn-primary float-right">View all</a>
							</div>
							<div class="card-block">
								<div class="table-responsive">
									<table class="table mb-0 new-patient-table">
										<tbody>
											<tr>
												<td>
													<img width="28" height="28" class="rounded-circle" src="{{asset('superAdmin')}}/assets/img/user.jpg" alt=""> 
													<h2>John Doe</h2>
												</td>
												<td>Johndoe21@gmail.com</td>
												<td>+1-202-555-0125</td>
												<td><button class="btn btn-primary btn-primary-one float-right">Fever</button></td>
											</tr>
											<tr>
												<td>
													<img width="28" height="28" class="rounded-circle" src="{{asset('superAdmin')}}/assets/img/user.jpg" alt=""> 
													<h2>Richard</h2>
												</td>
												<td>Richard123@yahoo.com</td>
												<td>202-555-0127</td>
												<td><button class="btn btn-primary btn-primary-two float-right">Cancer</button></td>
											</tr>
											<tr>
												<td>
													<img width="28" height="28" class="rounded-circle" src="{{asset('superAdmin')}}/assets/img/user.jpg" alt=""> 
													<h2>Villiam</h2>
												</td>
												<td>Richard123@yahoo.com</td>
												<td>+1-202-555-0106</td>
												<td><button class="btn btn-primary btn-primary-three float-right">Eye</button></td>
											</tr>
											<tr>
												<td>
													<img width="28" height="28" class="rounded-circle" src="{{asset('superAdmin')}}/assets/img/user.jpg" alt=""> 
													<h2>Martin</h2>
												</td>
												<td>Richard123@yahoo.com</td>
												<td>776-2323 89562015</td>
												<td><button class="btn btn-primary btn-primary-four float-right">Fever</button></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-4 col-xl-4">
						<div class="hospital-barchart">
							<h4 class="card-title d-inline-block">Hospital Management</h4>
						</div>
						<div class="bar-chart">
							<div class="legend">
								<div class="item">
									<h4>Level1</h4>
								</div>
								
								<div class="item">
									<h4>Level2</h4>
								</div>
								<div class="item text-right">
									<h4>Level3</h4>
								</div>
								<div class="item text-right">
									<h4>Level4</h4>
								</div>
							</div>
							<div class="chart clearfix">
								<div class="item">
									<div class="bar">
										<span class="percent">16%</span>
										<div class="item-progress" data-percent="16">
											<span class="title">OPD Patient</span>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="bar">
										<span class="percent">71%</span>
										<div class="item-progress" data-percent="71">
											<span class="title">New Patient</span>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="bar">
										<span class="percent">82%</span>
										<div class="item-progress" data-percent="82">
											<span class="title">Laboratory Test</span>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="bar">
										<span class="percent">67%</span>
										<div class="item-progress" data-percent="67">
											<span class="title">Treatment</span>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="bar">
										<span class="percent">30%</span>									
										<div class="item-progress" data-percent="30">
											<span class="title">Discharge</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					 </div>
				</div> -->
</div>
<div class="notification-box">
    <div class="msg-sidebar notifications msg-noti">
        <div class="topnav-dropdown-header">
            <span>Messages</span>
        </div>
        <div class="drop-scroll msg-list-scroll" id="msg_list">
            <ul class="list-box">
                <li>
                    <a href="chat.html">
                        <div class="list-item">
                            <div class="list-left">
                                <span class="avatar">R</span>
                            </div>
                            <div class="list-body">
                                <span class="message-author">Richard Miles </span>
                                <span class="message-time">12:28 AM</span>
                                <div class="clearfix"></div>
                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="chat.html">
                        <div class="list-item new-message">
                            <div class="list-left">
                                <span class="avatar">J</span>
                            </div>
                            <div class="list-body">
                                <span class="message-author">John Doe</span>
                                <span class="message-time">1 Aug</span>
                                <div class="clearfix"></div>
                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="chat.html">
                        <div class="list-item">
                            <div class="list-left">
                                <span class="avatar">T</span>
                            </div>
                            <div class="list-body">
                                <span class="message-author"> Tarah Shropshire </span>
                                <span class="message-time">12:28 AM</span>
                                <div class="clearfix"></div>
                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="chat.html">
                        <div class="list-item">
                            <div class="list-left">
                                <span class="avatar">M</span>
                            </div>
                            <div class="list-body">
                                <span class="message-author">Mike Litorus</span>
                                <span class="message-time">12:28 AM</span>
                                <div class="clearfix"></div>
                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="chat.html">
                        <div class="list-item">
                            <div class="list-left">
                                <span class="avatar">C</span>
                            </div>
                            <div class="list-body">
                                <span class="message-author"> Catherine Manseau </span>
                                <span class="message-time">12:28 AM</span>
                                <div class="clearfix"></div>
                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="chat.html">
                        <div class="list-item">
                            <div class="list-left">
                                <span class="avatar">D</span>
                            </div>
                            <div class="list-body">
                                <span class="message-author"> Domenic Houston </span>
                                <span class="message-time">12:28 AM</span>
                                <div class="clearfix"></div>
                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="chat.html">
                        <div class="list-item">
                            <div class="list-left">
                                <span class="avatar">B</span>
                            </div>
                            <div class="list-body">
                                <span class="message-author"> Buster Wigton </span>
                                <span class="message-time">12:28 AM</span>
                                <div class="clearfix"></div>
                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="chat.html">
                        <div class="list-item">
                            <div class="list-left">
                                <span class="avatar">R</span>
                            </div>
                            <div class="list-body">
                                <span class="message-author"> Rolland Webber </span>
                                <span class="message-time">12:28 AM</span>
                                <div class="clearfix"></div>
                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="chat.html">
                        <div class="list-item">
                            <div class="list-left">
                                <span class="avatar">C</span>
                            </div>
                            <div class="list-body">
                                <span class="message-author"> Claire Mapes </span>
                                <span class="message-time">12:28 AM</span>
                                <div class="clearfix"></div>
                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="chat.html">
                        <div class="list-item">
                            <div class="list-left">
                                <span class="avatar">M</span>
                            </div>
                            <div class="list-body">
                                <span class="message-author">Melita Faucher</span>
                                <span class="message-time">12:28 AM</span>
                                <div class="clearfix"></div>
                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="chat.html">
                        <div class="list-item">
                            <div class="list-left">
                                <span class="avatar">J</span>
                            </div>
                            <div class="list-body">
                                <span class="message-author">Jeffery Lalor</span>
                                <span class="message-time">12:28 AM</span>
                                <div class="clearfix"></div>
                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="chat.html">
                        <div class="list-item">
                            <div class="list-left">
                                <span class="avatar">L</span>
                            </div>
                            <div class="list-body">
                                <span class="message-author">Loren Gatlin</span>
                                <span class="message-time">12:28 AM</span>
                                <div class="clearfix"></div>
                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="chat.html">
                        <div class="list-item">
                            <div class="list-left">
                                <span class="avatar">T</span>
                            </div>
                            <div class="list-body">
                                <span class="message-author">Tarah Shropshire</span>
                                <span class="message-time">12:28 AM</span>
                                <div class="clearfix"></div>
                                <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="topnav-dropdown-footer">
            <a href="chat.html">See all messages</a>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<canvas id="barChart"></canvas>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('barChart').getContext('2d');
        var userChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: <?php echo json_encode($datasets); ?>
            },
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx1 = document.getElementById('linegraph').getContext('2d');
        var userChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels1); ?>,
                datasets: <?php echo json_encode($datasets1); ?>
            },
        });
    });
</script>


<!-- <script>
	var ctx1 = document.getElementById('linegraph').getContext('2d');
	var userChart = new Chart(ctx1, {
		type: 'line',
		data: {
			labels: {
				!! json_encode($labels1) !!
			},
			datasets: {
				!! json_encode($datasets1) !!
			},
		},
	});
</script> -->



<!-- <script>
    $(document).ready(function() {
        var postsPerPage = 10;
        var totalPosts = $('.patientInfo').length;
        var loadedPosts = postsPerPage;

        $('.patientInfo').hide();
        $('.patientInfo:lt(' + loadedPosts + ')').show();

        $('#load-more').click(function() {
            loadedPosts += postsPerPage;
            $('.patientInfo:lt(' + loadedPosts + ')').show();

            // if (loadedPosts >= totalPosts) {
            //     $(this).hide();
            // }

        });
        if (loadedPosts >= totalPosts) {
            $('#load-more').hide();
        } else  {
            $('#load-more').show();
        }

    });
</script> -->
<script>
    $(document).ready(function() {
        var postsPerPage = 10;
        var totalPosts = $('.patientInfo').length;
        var loadedPosts = postsPerPage;

        $('.patientInfo').hide();
        $('.patientInfo:lt(' + loadedPosts + ')').show();

        $('#load-more').click(function() {
            loadedPosts += postsPerPage;
            $('.patientInfo:lt(' + loadedPosts + ')').show();

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