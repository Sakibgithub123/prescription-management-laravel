@extends('frontEnd.master');
@section('title')
MediCareOPS-Patient
@endsection
@section('content')
<div class="content">
	<h4 class="page-title text-center py-2" style="background-color:#007bff; color:#003366; font-weight: 900;"> All Prescription of Patients </h4>
	<div class="row mt-5">
		<div class="col-sm-4 col-3">
			<h4 class="page-title">Patients</h4>
		</div>
		<!-- <div class="col-sm-8 col-9 text-right m-b-20">
			<a href="add-patient.html" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Patient</a>
		</div> -->
	</div>
	<!-- <input type="text" id="myFilter"> -->
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table id="myPatientTable" class="table table-border table-striped custom-table datatable mb-0">
					<thead>
						<tr>
							<th>Name</th>
							<th>Age</th>
							<th>Diagnose</th>
							<th>Date</th>
							<th>RegNo</th>
							<th class="text-right">Action</th>
						</tr>
					</thead>
					<tbody>
						<!-- @foreach($patients as $patient)
						<tr>
							<td> {{$patient->patient_name}}</td>
							<td>{{$patient->patient_age}}</td>
							<td>
								@if (is_array($patient->investigations) || is_object($patient->investigations))
								@foreach(json_decode($patient->investigations) as $investigation)
								<span>{{$investigation}}</span>
								@endforeach
								@endif
							</td>
							<td>{{date('F ,jS Y g:i A',strtotime($patient->date))}}</td>
						    <td>{{$patient->reg_no}}</td>
							<td class="text-right">
								<div class="dropdown dropdown-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="{{route('showDetailsprescription',['id'=>$patient->id])}}"><i class="fa fa-pencil m-r-5"></i> Show</a>
										<button class="dropdown-item" id="editBtn" data-bs-toggle="modal" data-bs-target="#myModal" data-editId="{{$patient->id}}"><i class="fa fa-pencil m-r-5"></i> Edit</button>
										<button class="dropdown-item" id="dltId" delete-id="{{$patient->id}}" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
									</div>
								</div>
							</td>
						</tr>
						@endforeach -->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal" id="myModal">
	<div class="modal-dialog modal-md">
		<div class="modal-content">


			<div class="modal-header" style="background-color:#007bff; color:#fff; font-weight: 900;">
				<h4 class="modal-title">Patient Update Form</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>


			<div class="modal-body">
				<div class="row">
					<form id="PatientUpdate">
						@csrf
						<input type="hidden" name="patientId" id="patientId">
						<div class="col-sm-12">
							<div class="form-group w-full">
								<label>Patient Name</label>
								<input type="text" id="patientName" name="patient_name" aria-label="name" class="form-control i">
								<span class="text-danger" id="error_name"></span>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group w-full">
								<label>Patient Age</label>
								<input type="text" id="patientAge" name="patient_age" aria-label="name" class="form-control i">
								<span class="text-danger" id="error_age"></span>
							</div>
						</div>

				</div>
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
				<button type="submit" class="btn btn-primary">Update</button>
			</div>
			</form>
		</div>
	</div>


</div>
@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
	// 	$(document).ready(function(){
	// 		alert('ok');
	// 		var table=new DataTable('#example', {
	//     ajax: "{{url('/patient-details1')}}",
	//     columns: [
	//         { "data": 'patient_name' },
	//         { "data": 'patient_age' },
	//         { data: 'investigations' },
	//         { data: 'date' },
	//         { data: 'reg_no' },
	//         // { data: 'salary' }
	//     ]
	// });

	// })
	// $(document).ready(function() {

	// 	$('#example').DataTable({
	// 		processing: true,
	// 		serverSide: true,
	// 		ajax: {
	// 			url: "{{ route('patientdetails') }}",
	// 		},
	// 		columns: [{
	// 				data: 'patient_name',
	// 				//    name: 'patient_name',

	// 				//    name: 'patient_age',
	// 			},
	// 			{
	// 				data: 'patient_age',
	// 				//    name: 'patient_age',

	// 				//    name: 'patient_age',
	// 			},
	// 			{

	// 				data: 'investigations',
	// 				//    name: 'investigations',

	// 				//    name: 'patient_age',
	// 			},
	// 			{

	// 				data: 'date',
	// 				//    name: 'date',

	// 				//    name: 'patient_age',
	// 			},
	// 			{

	// 				data: 'reg_no',
	// 				//    name: 'reg_no',
	// 				//    name: 'patient_age',
	// 			}
	// 		]
	// 	});
	// })



	// $('#myFilter').on('keyup', function() {
	// 	table
	// 		.search(this.value)
	// 		.draw();
	// });


	let table = new DataTable('#myPatientTable', {
		ajax: "{{url('/patient-details')}}",
		processing: true,
		columns: [{
				data: 'patient_name'
			},
			{
				data: 'patient_age'
			},
			// {
			// 	data: 'investigations',
			// 	render: function(data) {
			// 		return JSON.parse(data)
			// 	}
			// },
			{
				data: 'diagnoses',
				render: function(data) {
					let parsedData = JSON.parse(data);
					if (Array.isArray(parsedData) && parsedData.length > 0) {
						return parsedData.join(', '); // Join array elements into a string
					} else {
						return 'No diagnose'; // Static value if parsedData is empty
					}
				}
			},
			{
				data: 'date',
				render: function(data) {
					return new Date(data).toDateString()

				}
			},
			{
				data: 'reg_no'
			},
			{
				data: 'id',
				render: function(data, type, row) {
					var showUrl = `/show/prescription/${data}`;
					return `<div class="text-center ml-5">
            <div class="dropdown dropdown-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right p-2 ">
                    <a class="btn-sm btn-block btn btn-success" href="${showUrl}"><i class="fa fa-eye"></i> Show</a>
                    <button class="btn-sm btn-block btn btn-primary" id="editBtn" data-bs-toggle="modal" data-bs-target="#myModal" data-editId="${data}"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                    <button class="btn-sm btn-block btn btn-danger" id="dltId" delete-id="${data}" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                </div>
            </div>
        </div>`;
				}
			}
		]
	});



	$(document).on('click', '#dltId', function() {
		let patientId = $(this).attr('delete-id');
		// alert(patientId);
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "{{route('delete.patient')}}",
					method: 'post',
					data: {
						'patientId': patientId,
						'_token': '{{ csrf_token() }}'
					},

					success: function(res) {
						if (res.status == 'success') {
							Swal.fire(
								'Deleted!',
								'Your file has been deleted.',
								'success'
							)

						}
						table.ajax.reload();
					}
				})

			}
		})

	})



	$(document).on('click', '#editBtn', function(e) {
		e.preventDefault();
		var patientId = $(this).attr('data-editId');
		// alert(patientId);

		$.ajax({
			url: "/update/Patient",
			// /update/Patient
			data: {
				patientId: patientId
			},
			success: function(result) {
				// var data=JSON.parse(result.complaints);
				$('#patientName').val(result.patient_name);
				$('#patientAge').val(result.patient_age);
				$('#patientAge').val(result.patient_age);
				$('#date').val(result.date);
				// $('.tag1 option[value="' + result.complaints + '"]').prop('selected', true).trigger("change");
				$("#com").empty();
				// $("#com").append('<option value="'+result.complaints+'">'+result.complaints+'</option>');

				$.each(JSON.parse(result.complaints), function(i, val) {

					$("#com").append('<option selected  value="' + val + '">' + val + '</option>');
				});



			}
		})
	})
	$('#PatientUpdate').on('submit', function(e) {
		e.preventDefault();
		let formData = $(this).serialize()
		$.ajax({
			method: 'post',
			url: "{{route('userUpdate.Patient')}}",
			data: formData,
			success: function(result) {
				if (result.status === true) {
					toastr.success('Update Doctor Success', 'Update Doctor');
					$('#myModal').modal('hide');
				} else {
					toastr.success('Update Doctor Success', 'Update Doctor');
					table.ajax.reload();

				}

			},
			error: function(response) {
				$('#error_name').text(response.responseJSON.errors.patient_name);
				$('#error_age').text(response.responseJSON.errors.patient_age);
				// $('#error_fee').text(response.responseJSON.errors.visit_fee);



			}
		})
	})
</script>
<!-- select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script type="text/javascript">
	$(document).ready(function() {
		$('.tag1').select2({
			allowClear: true,
		});

	})
</script>


@endpush




@endsection