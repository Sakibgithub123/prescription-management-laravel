@extends('admin.master')

<style>
	.font {
		font-size: 12px;
	}
</style>
@section('content')

<div class="content">
	<div class="row py-2 mb-5" style="background-color:#007bff; color:#003366; font-weight: 900;">
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
			<h5 class="text-center font-weight-bold">Total Doctor's</h5>
			<div class="dash-widget">
				<span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
				<div class="dash-widget-info text-right">
					<h3>{{$doctorCount}}</h3>
					<span class="widget-title1"><a class="widget-title2 text-white" href="{{route('doctor.list')}}">Doctors</a> <i class="fa fa-check" aria-hidden="true"></i></span>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
			<h5 class="text-center font-weight-bold">Total Patient's</h5>
			<div class="dash-widget">
				<span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
				<div class="dash-widget-info text-right">
					<h3>{{$patientCount}}</h3>
					<span class="widget-title2"><a class="widget-title2 text-white" href="{{route('patient.list')}}">Patients</a> <i class="fa fa-check" aria-hidden="true"></i></span>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
			<h5 class="text-center font-weight-bold">Today,s Patient's</h5>
			<div class="dash-widget">
				<span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
				<div class="dash-widget-info text-right">
					<h3>{{$toDaysPatient}}</h3>
					<span class="widget-title3">Attend <i class="fa fa-check" aria-hidden="true"></i></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-md-6 col-lg-6 col-xl-6">
			<div class="card">
				<div class="card-body">
					<div class="chart-title">
						<h4>Monthly Generate Visit Fee</h4>
						<span class="float-right"><i class="fa fa-caret-up" aria-hidden="true"></i> Monthly Visit Fee Per Year
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
								<li><i class="fa fa-circle current-users" aria-hidden="true"></i>Patients Per Year
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
		<div class="col-12 col-md-12 col-lg-12 col-xl-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title d-inline-block">All Appointments</h4>
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
										<h5 class="time-title p-0">Diagnose</h5>
										<p>
										@php
                                            $diagnose = json_decode($patient->diagnoses, true);
                                            @endphp

                                            @if(is_null($diagnose) || empty($diagnose))
                                            <span class="font">No diagnose found</span>
                                            @else
                                            @foreach($diagnose as $diagnosis)
                                            <span class="font">{{ $diagnosis }},</span>
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
	</div>
</div>
@push('scripts')
<script>
	var ctx = document.getElementById('linegraph').getContext('2d');
	var userChart = new Chart(ctx, {
		type: 'line',
		// data: {
		// 	labels: {
		// 		!!json_encode($labels1) !!
		// 	},
		// 	datasets: {
		// 		!!json_encode($datasets1) !!
		// 	},
		// },
		data: {
                labels: <?php echo json_encode($labels1); ?>,
                datasets: <?php echo json_encode($datasets1); ?>
            },
	});
</script>

<script>
	var ctx = document.getElementById('barChart').getContext('2d');
	var userChart = new Chart(ctx, {
		type: 'bar',
		// data: {
		// 	labels: {
		// 		!!json_encode($labels) !!
		// 	},
		// 	datasets: {
		// 		!!json_encode($datasets) !!
		// 	},
		// },
		data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: <?php echo json_encode($datasets); ?>
            },
	});
</script>

<script>
	$(document).ready(function() {
		// Function to fetch data for a specific year
		function fetchData(year) {
			$.ajax({
				url: "{{ route('admin.dashboard.statistics.income') }}",
				type: "GET",
				data: {
					year: year
				}, // Pass the year as a parameter
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
				data: {
					year: year
				}, // Pass the year as a parameter
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