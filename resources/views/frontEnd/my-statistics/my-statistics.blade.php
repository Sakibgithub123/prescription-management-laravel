@extends('frontEnd.master');
@section('title')
MediCareOPS-Statistics
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
                                        <!-- <h5 class="time-title p-0">Appointment With</h5> -->
                                        <h5 class="time-title p-0">Gender</h5>
                                        <p>{{$patient->patient_gender? $patient->patient_gender: 'No data'}}</p>
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
    });
</script>
@endpush
@endsection