<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Complaints;
use App\Models\Diagnose;
use App\Models\Investigation;
use App\Models\Medicine;
use App\Models\Notice;
use App\Models\Prescription;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\BinaryOp\Concat;
use Datatables;

class FrontEndController extends Controller
{
    //----------------- Doctor login Credentials----------

    public function getLoginPage()
    {
        return view('frontEnd.login.login');
    }
    public function doctorLogin(Request $request)
    {
        $request->validate(([
            'email' => 'required',
            'password' => 'required',
        ]));
        // Auth::login($user);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'user'])) {
            return response()->json([
                'status' => true,
                'redirect' => url("/get-home")
            ]);
            // return redirect("/admin/dashboard");
            // return ("admin.manage-prescription.add-medicine");
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function getRegistrationPage()
    {
        return view('frontEnd.registration');
    }


    //----------------- Home page------------

    public function getHome()
    {
        $notices = Notice::where('status', 'Active')->get();
        return view('frontEnd.home.home', compact('notices'));
    }

    //----------------Doctor Profile--------------

    public function getProfile()
    {
        $profile = Auth::user();
        return view('frontEnd.profile.profile', ['profile' => $profile]);
    }

    public function getEditProfile()
    {
        $editProfile = Auth::user();
        return view('frontEnd.profile.edit-profile', ['editProfile' => $editProfile]);
    }

    public function saveEditProfile(Request $request)
    {
        if ($request->hasFile('profile_image')) {
            $fileName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->storeAs('public/images', $fileName);
            $updateData['profile_image'] = $fileName;
        }

        $updateData = [
            // 'profile_image' => $fileName,
            'name' => $request->name,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'education_informations' => $request->education_informations,
            'qualification' => $request->qualification,
            'specialist' => $request->specialist,
            'whenyouseat' => $request->whenyouseat,

        ];
        $update = User::where('id', $request->user_id)->update($updateData);
        if ($update) {
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

    //------------- Patient Credentials---------------

    public function getMyAllPatient()
    {
        $patient = Prescription::where('dr_id', Auth::user()->id)->get();

        if (request()->ajax()) {

            if ($patient) {
                return response()->json([
                    'message' => 'data found',
                    'code' => 200,
                    'data' => $patient,
                ]);
            } else {
                return response()->json([
                    'message' => 'internel server error',
                    'code' => 500,

                ]);
            }
        }
        // return $patient;
        return view('frontEnd.patient.patient', ['patients' => $patient]);
    }

    public function getUpdatePatient(Request $request)
    {
        // $result=$request->patientId;
        $result = Prescription::select('id', 'patient_name', 'patient_age', 'investigations', 'date')
            ->where('id', $request->patientId)
            ->first();
        return $result;
        // dd($result);
    }

    public function saveUpdatePatient(Request $request)
    {
        $request->validate([
            'patient_name' => 'required',
            'patient_age' => 'required|min:0|max:200',
            // 'visit_fee' => 'required',

        ]);
        $drid = Prescription::find($request->patientId)->update([
            'patient_name' => $request->patient_name,
            'patient_age' => $request->patient_age,
            // 'visit_fee' => $request->visit_fee,


        ]);
        if ($drid) {
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }


    public function showPrescriptionDetails($id)
    {
        $drId = Auth::user()->id;
        $doctorDetails = Prescription::select('*', 'users.name as name')
            ->join('users', 'prescriptions.dr_id', 'users.id')
            ->where('users.id', $drId)
            ->first();
        $prescriptions = Prescription::find($id);
        $clinicDetails = Clinic::find(1);
        $complaints = Complaints::all();
        $diagnoses = Diagnose::all();
        $tests = Test::all();
        $investigations = Investigation::all();
        $medicines = Medicine::all();
        // ['prescriptions' => $prescription, 'doctorDetails' => $doctorDetails]
        return view('frontEnd.patient.show-prescription', compact('prescriptions', 'doctorDetails', 'clinicDetails', 'complaints', 'diagnoses', 'tests', 'investigations', 'medicines'));
    }
    public function printPageReview($id)
    {
        $drId = Auth::user()->id;
        $doctorDetails = Prescription::select('*', 'users.name as name')
            ->join('users', 'prescriptions.dr_id', 'users.id')
            ->where('users.id', $drId)
            ->first();
        $prescriptions = Prescription::find($id);
        $clinicDetails = Clinic::find(1);
        $complaints = Complaints::all();
        $diagnoses = Diagnose::all();
        $tests = Test::all();
        $investigations = Investigation::all();
        $medicines = Medicine::all();
        // ['prescriptions' => $prescription, 'doctorDetails' => $doctorDetails]
        return view('frontEnd.print-page.print-page-review', compact('prescriptions', 'doctorDetails', 'clinicDetails', 'complaints', 'diagnoses', 'tests', 'investigations', 'medicines'));
    }
    public function deletePrintPrescription(Request $request)
    {
        $patientId = Prescription::where('id', $request->pId)->delete();
        if ($patientId) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }
    public function printPageUpdate($id)
    {
        $drId = Auth::user()->id;
        $doctorDetails = Prescription::select('*', 'users.name as name')
            ->join('users', 'prescriptions.dr_id', 'users.id')
            ->where('users.id', $drId)
            ->first();
        $prescriptions = Prescription::find($id);
        $clinicDetails = Clinic::find(1);
        $complaints = Complaints::all();
        $diagnoses = Diagnose::all();
        $tests = Test::all();
        $investigations = Investigation::all();
        $medicines = Medicine::all();
        // ['prescriptions' => $prescription, 'doctorDetails' => $doctorDetails]
        return view('frontEnd.print-page.print-page', compact('prescriptions', 'doctorDetails', 'clinicDetails', 'complaints', 'diagnoses', 'tests', 'investigations', 'medicines'));
    }
    public function editPrescription(Request $request)
    {
        $request->validate(([
            'patient_name' => 'required',
            'patient_gender' => 'required',
            'patient_age' => 'required|min:0|max:200',
        ]));

        $medicine = json_encode($request->medicine);
        $m = [];
        $m['medicine'] = $medicine;

        $howmanytimes = json_encode($request->howmanytimes);
        $h = [];
        $h['howmanytimes'] = $howmanytimes;

        $afterbefore = json_encode($request->afterbefore);
        $a = [];
        $a['afterbefore'] = $afterbefore;

        $nextdate = json_encode($request->nextdate);
        $n = [];
        $n['nextdate'] = $nextdate;

        $prescriptionEdit = Prescription::find($request->prescription_id)->update([
            'dr_id' => $request->dr_id,
            'patient_name' => $request->patient_name,
            'patient_gender' => $request->patient_gender,
            'patient_age' => $request->patient_age,
            'visit_fee' => $request->visit_fee,
            'reg_no' => $request->reg_no,
            'date' => $request->date,
            // 'complaints' => json_encode($request->complaints),
            'complaints' => $request->complaints,
            'tests' => json_encode($request->tests),
            'investigations' => json_encode($request->investigations),
            // 'diagnoses' => json_encode($request->diagnoses),
            'diagnoses' => $request->diagnoses,
            'medicine' => implode(",", $m),
            'howmanytimes' => implode(",", $h),
            'afterbefore' => implode(",", $a),
            'nextdate' => implode(",", $n),
        ]);

        // $prescription = new Prescription;

        if ($prescriptionEdit) {
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'server error',
            ]);
        }
    }

    public function deletePatient(Request $request)
    {
        $patientId = Prescription::where('id', $request->patientId)->delete();
        if ($patientId) {
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    //------------- Prescription credentials-------------

    public function getPrescription()
    {
        $drId = Auth::user();
        // $reg_no = rand(10, 9999) . rand(9, 1000);
        $faker = \Faker\Factory::create();
        $reg_no = $faker->unique()->numerify('REG#####');
        $clinicDetails = Clinic::find(1);
        $complaints = Complaints::all();
        $diagnoses = Diagnose::all();
        $tests = Test::all();
        $investigations = Investigation::all();
        $medicines = Medicine::all();
        return view('frontEnd.prescription.prescription', compact('drId', 'reg_no', 'clinicDetails', 'complaints', 'diagnoses', 'tests', 'investigations', 'medicines'));
    }

    // public function savePrescription(Request $request)
    // {
    //     $request->validate(([
    //         'patient_name' => 'required',
    //         'patient_gender' => 'required',
    //         'patient_age' => 'required|min:0|max:200',
    //     ]));
    //     // $complaint = json_encode($request->complaints ?? []);
    //     $test = json_encode($request->tests ?? []);
    //     $investigation = json_encode($request->investigations ?? []);
    //     // $diagnose = json_encode($request->diagnoses ?? []);
    //     $medicine = json_encode($request->medicine);

    //     $m = [];
    //     $m['medicine'] = $medicine;

    //     $howmanytimes = json_encode($request->howmanytimes);
    //     $h = [];
    //     $h['howmanytimes'] = $howmanytimes;

    //     $afterbefore = json_encode($request->afterbefore);
    //     $a = [];
    //     $a['afterbefore'] = $afterbefore;

    //     $nextdate = json_encode($request->nextdate);
    //     $n = [];
    //     $n['nextdate'] = $nextdate;

    //     $prescription = new Prescription;
    //     $prescription->dr_id = $request->dr_id;
    //     $prescription->patient_name = $request->patient_name;
    //     $prescription->patient_gender = $request->patient_gender;
    //     $prescription->patient_age = $request->patient_age;
    //     $prescription->visit_fee = $request->visit_fee;
    //     $prescription->reg_no = $request->reg_no;
    //     $prescription->date = $request->date;
    //     $prescription->complaints = $request->complaints;
    //     $prescription->tests = $test;
    //     $prescription->investigations = $investigation;
    //     $prescription->diagnoses = $request->diagnoses;
    //     $prescription->medicine = implode(",", $m);
    //     $prescription->howmanytimes = implode(",", $h);
    //     $prescription->afterbefore = implode(",", $a);
    //     $prescription->nextdate = implode(",", $n);
    //     $prescriptionDetails = $prescription->save();
    //     if ($prescriptionDetails) {
    //         return response()->json([
    //             'status' => 'success',
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => false,
    //         ]);
    //     }
    // }
    public function savePrescription(Request $request)
    {
        $request->validate([
            'patient_name' => 'required',
            'patient_gender' => 'required',
            'patient_age' => 'required|min:0|max:200',
        ]);

        // Prepare data for JSON encoding
        $test = json_encode($request->tests ?? []);
        $investigation = json_encode($request->investigations ?? []);
        $medicine = json_encode($request->medicine??[]);
        $howmanytimes = json_encode($request->howmanytimes??[]);
        $afterbefore = json_encode($request->afterbefore??[]);
        $nextdate = json_encode($request->nextdate??[]);

        // Prepare the data to update or create
        $data = [
            'dr_id' => $request->dr_id,
            'patient_name' => $request->patient_name,
            'patient_gender' => $request->patient_gender,
            'patient_age' => $request->patient_age,
            'visit_fee' => $request->visit_fee,
            'reg_no' => $request->reg_no,
            'date' => $request->date,
            'complaints' => $request->complaints,
            'tests' => $test,
            'investigations' => $investigation,
            'diagnoses' => $request->diagnoses,
            'medicine' => $medicine,
            'howmanytimes' => $howmanytimes,
            'afterbefore' => $afterbefore,
            'nextdate' => $nextdate,
        ];

        // Use updateOrCreate to update or insert the prescription by reg_no
        $prescription = Prescription::create(
            $data
            // ['reg_no' => $request->reg_no],  // Condition to find the record by reg_no
            // $data  // Fields to update or create
        );

        // Check if the prescription was saved or updated
        if ($prescription) {
            return response()->json([
                'status' => 'success',
                'id'=>$prescription->id,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }




    //---------------- Doctor Statistics--------------

    public function doctorStatistics()
    {
        $patientCount = Prescription::count();

        $authenticatedDoctorId = Auth::id();
        // return $authenticatedDoctorId;
        $userCharts = Prescription::selectRaw('MONTH(created_at) as month , COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->where('dr_id', $authenticatedDoctorId)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $labels = [];

        $data = [];
        $colurs = ['#ff0000', '#ff8000', '#ffff00', '#80ff00 ', '#00ff00', '#00ff80', '#00ffff ', '#0080ff', '#0000ff', '#8000ff', '#ff00ff', '#ff0080'];

        for ($i = 1; $i < 12; $i++) {
            $month = date('F', mktime(0, 0, 0, $i, 1));
            $count = 0;
            foreach ($userCharts as $userChart) {
                if ($userChart->month == $i) {
                    $count = $userChart->count;
                    break;
                }
            }
            array_push($labels, $month);
            array_push($data, $count);
        }

        $datasets = [
            [
                'label' => 'Patients',
                'data' => $data,
                'backgroundColor' => $colurs
            ]
        ];

        // $authenticatedDoctorId = Auth::id();
        $appointments = Prescription::where('dr_id', $authenticatedDoctorId)->get();
        $patients = Prescription::select('patient_name', 'patient_age', 'patient_gender', 'diagnoses', 'prescriptions.created_at as date', 'users.name as name')
            ->join('users', 'users.id', 'prescriptions.dr_id')->where('dr_id', Auth::user()->id)->latest('prescriptions.created_at')->get();


        $authenticatedDoctorId = Auth::id();
        $appointments = Prescription::where('dr_id', $authenticatedDoctorId)->get();


        $userCharts1 = Prescription::selectRaw('MONTH(created_at) as month , SUM(visit_fee) as sum')
            ->whereYear('created_at', date('Y'))
            ->where('dr_id', $authenticatedDoctorId)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $labels1 = [];
        $data1 = [];
        $colurs = ['#666666', '#ff8000', '#ffff00', '#80ff00 ', '#00ff00', '#00ff80', '#00ffff ', '#0080ff', '#0000ff', '#8000ff', '#ff00ff', '#ff0080'];

        for ($i = 1; $i < 12; $i++) {
            $month = date('F', mktime(0, 0, 0, $i, 1));
            $sum = 0;
            foreach ($userCharts1 as $userChart) {
                if ($userChart->month == $i) {
                    $sum = $userChart->sum;
                    break;
                }
            }
            array_push($labels1, $month);
            array_push($data1, $sum);
        }
        $datasets1 = [
            [
                'label' => 'Total visit fees',
                'data' => $data1,
                'backgroundColor' => $colurs
            ]
        ];
        // return $datasets;
        return view('frontEnd.my-statistics.my-statistics', compact('patientCount', 'patients', 'datasets', 'labels', 'datasets1', 'labels1'));
    }


    //---------- Password Change credentials------------------

    public function getchangePassword()
    {
        return view('frontEnd.settings.change-password');
    }


    public function savechangePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->old_password, Auth::user()->password);
        if ($currentPasswordStatus) {

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['status' => 'success']);
        } else {

            return response()->json(['status' => 'error']);
        }
    }

    //---------- Logout-----------------

    public function Logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
