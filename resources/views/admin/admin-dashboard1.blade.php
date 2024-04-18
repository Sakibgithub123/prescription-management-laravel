@extends('admin.master')
<!-- <style>
	.animation {
 height: 50px;	
 overflow: hidden;
 position: relative;
}
.animation .p {
 font-size: 3em;
 color: limegreen;
 position: absolute;
 width: 700%;
 height: 100%;
 margin: 0;
 line-height: 50px;
 text-align: center;
 /* Starting position */
 -moz-transform:translateX(100%);
 -webkit-transform:translateX(100%);	
 transform:translateX(100%);
 /* Apply animation to this element */	
 -moz-animation: animation 35s linear infinite;
 -webkit-animation: animation 35s linear infinite;
 animation: animation 35s linear infinite;
}
/* Move it (define the animation) */
@-moz-keyframes animation {
 0%   { -moz-transform: translateX(100%); }
 100% { -moz-transform: translateX(-100%); }
}
@-webkit-keyframes animation {
 0%   { -webkit-transform: translateX(100%); }
 100% { -webkit-transform: translateX(-100%); }
}
@keyframes animation {
 0%   { 
 -moz-transform: translateX(100%); /* Firefox bug fix */
 -webkit-transform: translateX(100%); /* Firefox bug fix */
 transform: translateX(100%); 		
 }
 100% { 
 -moz-transform: translateX(-100%); /* Firefox bug fix */
 -webkit-transform: translateX(-100%); /* Firefox bug fix */
 transform: translateX(-100%); 
 }
}
</style> -->
@section('content')

<div class="content">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
			<h5 class="text-center">Total Doctor</h5>
			<div class="dash-widget">
				<span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
				<div class="dash-widget-info text-right">
					<h3>{{$doctorCount}}</h3>
					<span class="widget-title1"><a class="widget-title2 text-white" href="{{route('doctor.list')}}">Doctors</a> <i class="fa fa-check" aria-hidden="true"></i></span>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
			<h5 class="text-center">Total Patient</h5>
			<div class="dash-widget">
				<span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
				<div class="dash-widget-info text-right">
					<h3>{{$patientCount}}</h3>
					<span class="widget-title2"><a class="widget-title2 text-white" href="{{route('patient.list')}}">Patients</a> <i class="fa fa-check" aria-hidden="true"></i></span>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
			<h5 class="text-center">Today,s Patient's</h5>
			<div class="dash-widget">
				<span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
				<div class="dash-widget-info text-right">
					<h3>{{$toDaysPatient}}</h3>
					<span class="widget-title3">Attend <i class="fa fa-check" aria-hidden="true"></i></span>
				</div>
			</div>
		</div>
		<!-- <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3>618</h3>
                                <span class="widget-title4">Pending <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div> -->
	</div>
	<div class="row">
		<div class="col-12 col-md-6 col-lg-6 col-xl-6">
			<div class="card">
				<div class="card-body">
					<div class="chart-title">
						<h4>Patient Total</h4>
						<span class="float-right"><i class="fa fa-caret-up" aria-hidden="true"></i> 15% Higher than Last Month
							<select name="incomeYear" id="yearSelectorincome">
								@php
								$currentYear = date('Y');
								$futureYear = $currentYear + 10; // Change 10 to the number of future years you want to display
								@endphp
								@for ($year = $currentYear; $year <= $futureYear; $year++) <option value="{{ $year }}">{{ $year }}</option>
									@endfor
							</select>
						</span>
					</div>
					<canvas id="linegraph"></canvas>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-6 col-xl-6">
			<div class="card">
				<div class="card-body">
					<div class="chart-title">
						<h4>Patients In</h4>
						<div class="float-right">
							<ul class="chat-user-total">
								<li><i class="fa fa-circle current-users" aria-hidden="true"></i>ICU
									<select name="patientYear" id="yearSelector">
								@php
								$currentYear = date('Y');
								$futureYear = $currentYear + 10; // Change 10 to the number of future years you want to display
								@endphp
								@for ($year = $currentYear; $year <= $futureYear; $year++) <option value="{{ $year }}">{{ $year }}</option>
									@endfor
							</select>


								</li>
								<!-- <li><i class="fa fa-circle old-users" aria-hidden="true"></i> OPD</li> -->
							</ul>
						</div>
					</div>
					<!-- <canvas id="bargraph"></canvas> -->
					<canvas id="barChart"></canvas>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-md-6 col-lg-8 col-xl-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title d-inline-block">Upcoming Appointments</h4> <a href="appointments.html" class="btn btn-primary float-right">View all</a>
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
								<tr>
									<td style="min-width: 200px;">
										<a class="avatar">B</a>
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
									<td class="text-right">
										<!-- <a href="appointments.html" class="btn btn-outline-primary">Take up</a> -->
										<button class="btn btn-primary btn-primary-one float-right">Fever</button>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-4 col-xl-4">
			<div class="card member-panel">
				<div class="card-header bg-white">
					<h4 class="card-title mb-0">Doctors ({{$doctorCount}})</h4>
				</div>
				<div class="card-body">
					<ul class="contact-list">
						<li>
							@foreach($doctors as $doctor)
							<div class="contact-cont">
								<div class="float-left user-img m-r-10">
									<a href="{{route('doctor.details',['id'=>$doctor->id])}}" title="{{$doctor->name}}">
										@if(!$doctor->profile_image)
										<img src="{{asset('superAdmin')}}/assets/img/user.jpg" alt="{{$doctor->name}}" class="w-40 rounded-circle">
										@else
										<img src="{{asset('storage/images/'.$doctor->profile_image)}}" alt="{{$doctor->name}}" class="w-40 rounded-circle">
										@endif
										<span class="{{$doctor->status===1 ? 'status online' : 'status offline'}}"></span></a>
								</div>
								<div class="contact-info">
									<span class="contact-name text-ellipsis">{{$doctor->name}}</span>
									<span class="contact-date">{{$doctor->qualification}}</span>
									<span class="contact-date text-ellipsis">Total Patient: {{$doctor->totalPrescription}}</span>
								</div>
							</div>
							@endforeach

					</ul>
				</div>
				<div class="card-footer text-center bg-white">
					<a href="doctors.html" class="text-muted">View all Doctors</a>
				</div>
			</div>
		</div>
	</div>
</div>


@push('scripts')
<!-- <script>
	var ctx = document.getElementById('barChart').getContext('2d');
	var userChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: {
				!!json_encode($labels) !!
			},
			datasets: {
				!!json_encode($datasets) !!
			},
		},
	});
</script>
<script>
	var ctx = document.getElementById('linegraph').getContext('2d');
	var userChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: {
				!!json_encode($labels1) !!
			},
			datasets: {
				!!json_encode($datasets1) !!
			},
		},
	});
</script> -->

<script>
		var ctx =document.getElementById('barChart').getContext('2d');
		var userChart =new Chart(ctx,{
			type:'bar',
			data:{
				labels:{!! json_encode($labels) !!},
				datasets:{!! json_encode($datasets) !!},
			},
		});
	</script>
<script>
		var ctx =document.getElementById('linegraph').getContext('2d');
		var userChart =new Chart(ctx,{
			type:'line',
			data:{
				labels:{!! json_encode($labels1) !!},
				datasets:{!! json_encode($datasets1) !!},
			},
		});
	</script>

<!-- // get data by year patient -->
<!-- <script>
	//get data by year
	$(document).ready(function() {
		$('select[name="patientYear"]').change(function() {
			var year = $(this).val();
			$.ajax({
				url: "{{ route('admin.dashboard.statistics.patient') }}",
				type: "GET",
				success: function(response) {
					// // Handle the response here
					// console.log(response.datasets);

					// // Get canvas element
					// var ctx = document.getElementById('barChart').getContext('2d');

					// // Create bar chart
					// var myChart = new Chart(ctx, {
					// 	type: 'bar',
					// 	data: {
					// 		labels: response.labels,
					// 		datasets: response.datasets
					// 	}
					// });
					// Check if response contains data
                    if (response && response.labels && response.datasets) {
                        // Create a bar chart
                        new Chart(document.getElementById('barChart'), {
                            type: 'bar',
                            data: {
                                labels: response.labels,
                                datasets: response.datasets
                            }
                        });
                    } else {
                        // If no data available, show a message
                        $('#barChart').replaceWith('<p>No data available</p>');
                    }
				},
				error: function(xhr, status, error) {
					// Handle errors
					console.error(xhr.responseText);
				}
			});
		});
	});
</script> -->
<!-- // get data by year income -->
<!-- <script>
	//get data by year
	$(document).ready(function() {
		$('select[name="incomeYear"]').change(function() {
			var year = $(this).val();
			$.ajax({
				url: "{{ route('admin.dashboard.statistics.income') }}",
				type: "GET",
				success: function(response) {
					// // Handle the response here
					// console.log(response.datasets1);

					// // Get canvas element
					// var ctx = document.getElementById('linegraph').getContext('2d');

					// // Create bar chart
					// var myChart = new Chart(ctx, {
					// 	type: 'line',
					// 	data: {
					// 		labels1: response.labels1,
					// 		datasets1: response.datasets1
					// 	}
					// });
					if (response && response.labels && response.datasets) {
                        // Create a bar chart
                        new Chart(document.getElementById('linegraph'), {
                            type: 'line',
                            data: {
                                labels: response.labels,
                                datasets: response.datasets
                            }
                        });
                    } else {
                        // If no data available, show a message
                        $('#linegraph').replaceWith('<p>No data available</p>');
                    }
                },
				error: function(xhr, status, error) {
					// Handle errors
					console.error(xhr.responseText);
				}
			});
		});
	});
</script> -->

<script>
$(document).ready(function() {
    // Function to fetch data for a specific year
    function fetchData(year) {
        $.ajax({
            url: "{{ route('admin.dashboard.statistics.income') }}",
            type: "GET",
            data: { year: year }, // Pass the year as a parameter
            success: function(response) {
                // Check if response contains data
                if (response && response.labels1 && response.datasets1) {
                    // Create a bar chart
                    new Chart(document.getElementById('linegraph'), {
                        type: 'line',
                        data: {
                            labels: response.labels1,
                            datasets: response.datasets1
                        }
                    });
                } else {
                    // If no data available, show a message
                    $('#linegraph').replaceWith('<p>No data available</p>');
                }
            },
            error: function(xhr, status, error) {
                // If an error occurs, show an error message
                console.error(xhr.responseText);
                $('#linegraph').replaceWith('<p>Error fetching data</p>');
            }
        });
    }

    // Initial fetch for the current year
    var currentYear = new Date().getFullYear();
    fetchData(currentYear);

    // Event listener for changing the year
    $('#yearSelectorincome').change(function() {
        var selectedYear = $(this).val();
        fetchData(selectedYear);
    });
});
</script>
<script>
$(document).ready(function() {
    // Function to fetch data for a specific year
    function fetchData(year) {
        $.ajax({
            url: "{{ route('admin.dashboard.statistics.patient') }}",
            type: "GET",
            data: { year: year }, // Pass the year as a parameter
            success: function(response) {
                // Check if response contains data
                if (response && response.labels && response.datasets) {
                    // Create a bar chart
                    new Chart(document.getElementById('barChart'), {
                        type: 'bar',
                        data: {
                            labels: response.labels,
                            datasets: response.datasets
                        }
                    });
                } else {
                    // If no data available, show a message
                    $('#barChart').replaceWith('<p>No data available</p>');
                }
            },
            error: function(xhr, status, error) {
                // If an error occurs, show an error message
                console.error(xhr.responseText);
                $('#barChart').replaceWith('<p>Error fetching data</p>');
            }
        });
    }

    // Initial fetch for the current year
    var currentYear = new Date().getFullYear();
    fetchData(currentYear);

    // Event listener for changing the year
    $('#yearSelector').change(function() {
        var selectedYear = $(this).val();
        fetchData(selectedYear);
    });
});
</script>


@endpush

@endsection