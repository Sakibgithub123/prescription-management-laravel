<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Complaints;
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
    // public function getLoginPage()
    // {
    //     return view('frontEnd.login');
    // }

                //----------------- Doctor login Credentials----------

    public function getLoginPage()
    {
        return view('frontEnd.login.login');
    }
    public function doctorLogin(Request $request){
        $request->validate(([
            'email' => 'required',
            'password' => 'required',
        ]));
        // Auth::login($user);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
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

    // public function getIndex()
    // {

    //     return view('frontEnd.index');
    // }

                     //----------------- Home page------------

    public function getHome()
    {
        $notices=Notice::where('status','Active')->get();
        return view('frontEnd.home.home',compact('notices'));
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
        $fileName = time() . '.' . $request->profile_image->extension();
        $request->profile_image->storeAs('public/images', $fileName);

        $update = User::find($request->user_id)->update([
            'profile_image' => $fileName,
            'name' => $request->name,
            'education_informations' => $request->education_informations,
            'qualification' => $request->qualification,
            'specialist' => $request->specialist,
            'whenyouseat' => $request->whenyouseat,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'gender' => $request->gender,

        ]);
        if ($update) {
            return response()->json([
                'status' => 'success',
            ]);
        }
    }

                  //------------- Patient Credentials---------------

    public function getPatient()
    {
        $patient = Prescription::where('dr_id', Auth::user()->id)->get();
        
        if(request()->ajax()){
            
        if($patient){
            return response()->json([
                'message'=>'data found',
                'code'=>200,
                'data'=>$patient,
            ]);
        }else{
            return response()->json([
                'message'=>'internel server error',
                'code'=>500,
               
            ]);

        }
    }
        return view('frontEnd.patient.patient', ['patients' => $patient]);
    }

    public function getUpdatePatient(Request $request)
    {
        // $result=$request->patientId;
        $result = Prescription::select('patient_name', 'patient_age', 'investigations', 'date')
            ->where('id', $request->patientId)
            ->first();
        return $result;
        // dd($result);
    }

    public function saveUpdatePatient(Request $request)
    {
        $request->validate([
            'patient_name' => 'required',
            'patient_age' => 'required',
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

    // public function showPrescription($id)
    // {
    //     $findPatient = Prescription::find($id);
    //     return view('frontEnd.prescription.prescription', ['findPatient' => $findPatient]);
    // }

    public function showPrescriptionDetails($id)
    {
        $drId = Auth::user()->id;
        $doctorDetails = Prescription::select('*', 'users.name as name')
            ->join('users', 'prescriptions.dr_id', 'users.id')
            ->where('users.id', $drId)
            ->first();
        $prescriptions = Prescription::find($id);
        $clinicDetails = Clinic::find(1);
        $complaints=Complaints::all();
        $tests=Test::all();
        $investigations=Investigation::all();
        $medicines=Medicine::all();
        // ['prescriptions' => $prescription, 'doctorDetails' => $doctorDetails]
        return view('frontEnd.patient.show-prescription',compact('prescriptions','doctorDetails','clinicDetails','complaints','tests','investigations','medicines'));
    }
    public function editPrescription(Request $request)
    {
        $request->validate(([
            'patient_name' => 'required',
            'patient_age' => 'required',
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
            'patient_age' => $request->patient_age,
            'visit_fee' => $request->visit_fee,
            'reg_no' => $request->reg_no,
            'date' => $request->date,
            'complaints' => json_encode($request->complaints),
            'tests' => json_encode($request->tests),
            'investigations' => json_encode($request->investigations),
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
        }else{
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
        $reg_no = rand(10, 9999) . rand(9, 1000);
        $clinicDetails = Clinic::find(1);
        $complaints=Complaints::all();
        $tests=Test::all();
        $investigations=Investigation::all();
        $medicines=Medicine::all();
        return view('frontEnd.prescription.prescription', compact('drId', 'reg_no','clinicDetails','complaints','tests','investigations','medicines'));
    }

    public function savePrescription(Request $request)
    {
        $request->validate(([
            'patient_name' => 'required',
            'patient_age' => 'required',
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

        $prescription = new Prescription;
        $prescription->dr_id = $request->dr_id;
        $prescription->patient_name = $request->patient_name;
        $prescription->patient_age = $request->patient_age;
        $prescription->visit_fee = $request->visit_fee;
        $prescription->reg_no = $request->reg_no;
        $prescription->date = $request->date;
        $prescription->complaints = json_encode($request->complaints);
        $prescription->tests = json_encode($request->tests);
        $prescription->investigations = json_encode($request->investigations);
        $prescription->medicine = implode(",", $m);
        $prescription->howmanytimes = implode(",", $h);
        $prescription->afterbefore = implode(",", $a);
        $prescription->nextdate = implode(",", $n);
        $prescriptionDetails = $prescription->save();
        if ($prescriptionDetails) {
            return response()->json([
                'status' => 'success',
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);

        }
    }

    
    // public function adminDashboard()
    // {
    //     if (Auth::id()) {
    //         $role = Auth::user()->role;
    //         if ($role === 'user') {
    //             // $patientCount = Prescription::count();
    //             // $userCharts = Prescription::selectRaw('MONTH(created_at) as month , COUNT(*) as count')
    //             //     ->whereYear('created_at', date('Y'))
    //             //     ->groupBy('month')
    //             //     ->orderBy('month')
    //             //     ->get();
    //             // $labels = [];
    //             // $data = [];
    //             // $colurs = ['#ff0000', '#ff8000', '#ffff00', '#80ff00 ', '#00ff00', '#00ff80', '#00ffff ', '#0080ff', '#0000ff', '#8000ff', '#ff00ff', '#ff0080'];

    //             // for ($i = 1; $i < 12; $i++) {
    //             //     $month = date('F', mktime(0, 0, 0, $i, 1));
    //             //     $count = 0;
    //             //     foreach ($userCharts as $userChart) {
    //             //         if ($userChart->month == $i) {
    //             //             $count = $userChart->count;
    //             //             break;
    //             //         }
    //             //     }
    //             //     array_push($labels, $month);
    //             //     array_push($data, $count);
    //             // }
    //             // $datasets = [
    //             //     [
    //             //         'label' => 'Patients',
    //             //         'data' => $data,
    //             //         'backgroundColor' => $colurs
    //             //     ]
    //             // ];
    //             // $patients = Prescription::select('patient_name', 'patient_age', 'complaints', 'prescriptions.created_at as date', 'users.name as name')
    //             //     ->join('users', 'users.id', 'prescriptions.dr_id')->where('dr_id', Auth::user()->id)->latest('prescriptions.created_at')->get();
    //             // return view('frontEnd.dashboard.dashboard', compact('patientCount', 'patients', 'datasets', 'labels'));
    //             return view('frontEnd.home.home');
    //         } else if ($role === 'admin') {
    //             $doctorCount = User::where('role', 'user')->count();
    //             $patientCount = Prescription::count();
    //             $userCharts = Prescription::selectRaw('MONTH(created_at) as month , COUNT(*) as count')
    //                 ->whereYear('created_at', date('Y'))
    //                 ->groupBy('month')
    //                 ->orderBy('month')
    //                 ->get();
    //             $labels = [];
    //             $data = [];
    //             $colurs = ['#ff0000', '#ff8000', '#ffff00', '#80ff00 ', '#00ff00', '#00ff80', '#00ffff ', '#0080ff', '#0000ff', '#8000ff', '#ff00ff', '#ff0080'];

    //             for ($i = 1; $i < 12; $i++) {
    //                 $month = date('F', mktime(0, 0, 0, $i, 1));
    //                 $count = 0;
    //                 foreach ($userCharts as $userChart) {
    //                     if ($userChart->month == $i) {
    //                         $count = $userChart->count;
    //                         break;
    //                     }
    //                 }
    //                 array_push($labels, $month);
    //                 array_push($data, $count);
    //             }
    //             $datasets = [
    //                 [
    //                     'label' => 'Patients',
    //                     'data' => $data,
    //                     'backgroundColor' => $colurs
    //                 ]
    //             ];
    //             $patients = Prescription::select('patient_name', 'patient_age', 'complaints', 'prescriptions.created_at as date', 'users.name as name')
    //                 ->join('users', 'users.id', 'prescriptions.dr_id')->latest('prescriptions.created_at')->get();
    //             return view('admin.admin-dashboard1', compact('doctorCount', 'patientCount', 'patients', 'datasets', 'labels'));
    //         }
    //     }
    // }

                //---------------- Doctor Statistics--------------

    public function doctorStatistics()
    {
        $patientCount = Prescription::count();
        $authenticatedDoctorId = Auth::id();
        $userCharts = Prescription::selectRaw('MONTH(created_at) as month , COUNT(*) as count')
            ->whereYear('created_at', date('Y-m'))
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
        $authenticatedDoctorId = Auth::id();
        $appointments = Prescription::where('dr_id', $authenticatedDoctorId)->get();
        $patients = Prescription::select('patient_name', 'patient_age', 'complaints','investigations', 'prescriptions.created_at as date', 'users.name as name')
            ->join('users', 'users.id', 'prescriptions.dr_id')->where('dr_id', Auth::user()->id)->latest('prescriptions.created_at')->get();


            $authenticatedDoctorId = Auth::id();
            $appointments = Prescription::where('dr_id', $authenticatedDoctorId)->get();
    
            $monthlyFees = $appointments->groupBy(function ($appointment) {
                return $appointment->created_at->format('Y');
            })->map(function ($monthlyAppointments) {
                return $monthlyAppointments->sum('visit_fee');
            });
        //     $monthlyFees = Prescription::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(visit_fee) as total')
        // ->groupBy('month')
        // ->orderBy('month')
        // ->get();

        $userCharts1 = Prescription::selectRaw('MONTH(created_at) as month , SUM(visit_fee) as sum')
            ->whereYear('created_at', date('Y-m'))
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
                'label' => 'Patients',
                'data' => $data1,
                'backgroundColor' => $colurs
            ]
        ];
           

        return view('frontEnd.my-statistics.my-statistics', compact('patientCount', 'patients', 'datasets', 'labels','datasets1', 'labels1','monthlyFees'));

        

        // Process data as needed for the chart

        // return view('frontEnd.my-statistics.my-statistics', compact('appointments'));
    }

    
               //---------- Password Change credentials------------------

    public function getchangePassword()
    {
        return view('frontEnd.settings.change-password');
    }

    public function savechangePassword(Request $request)
    {

        $request->validate([
            'old_password'          => 'required',
            // 'email'         => 'required|email',
            // 'mobile'        => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'new_password'       => 'required',
            'confirm_password'       => 'required',
        ]);
        $currentPassword = Auth::user()->password;
        $user = User::where('id', $request->UserId);
        if (Hash::check($request->old_password, $currentPassword)) {

            // $passwordChange = new User;
            // $passwordChange->password=$user
            $user->password = Hash::make($request->password);
            $passwordChange = $user->save();
            if ($passwordChange) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'error']);
            }
        }
    }

                   //---------- Logout-----------------

    public function Logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    // $patient=Prescription::where('dr_id',Auth::user()->id)->get();
    // return view('frontEnd.patient.patient',['patients'=>$patient]);


    //change password

    // public function changePassword(ProfilePasswordRequest $request)
    // {
    //     try{
    //         $currentPass = Auth::user()->password;
    //         if (Hash::check($request->oldPassword, $currentPass)) {
    //             $user = User::find(Auth::id());
    //             $user -> password = Hash::make($request->password);
    //             $user -> save();

    //             return response()->json([
    //                 'status' => true,
    //                 'msg' => 'Your password changed successfully',
    //             ]);
    //         }else{
    //             return response()->json([
    //                 'status' => false,
    //                 'msg' => 'Old password is wrong',
    //             ]);
    //         }

    //     }catch (\Exception $ex){
    //         return $ex;
    //         return redirect()->back()->with(['error' => 'Something error please try again later']);
    //     }
    // }


    // public function subscriptionDT($request){
    //     $draw = $request->input('draw');
    //     $start = $request->input('start');
    //     $length = $request->input('length');
    //     $order = $_GET['order'][0]["column"];
    //     $orderDir = $_GET["order"][0]["dir"];

    //     $columns = ['patient_name', 'patient_age', 'complaints', 'date'];
    //     $orderby = $columns[$order];


    //     $result = Prescription::select('patient_name', 'patient_age', 'date', 'complaints')
    //         ->where('dr_id', auth()->user()->id);

    //         $name = $request->input('name');
    //     $approved_status = $request->input('approved_status');
    //     $from = $request->input('from');
    //     $to = $request->input('to');
    //     $min = $request->input('min');
    //     $max = $request->input('max');


    // $package_type = $request->input('package_type');
    // $bonus = $request->input('bonus');

    // /*<-------filter search script start here------------->*/

    // if ($name != "") {
    //     $result = $result->where('patient_name', '=', $name);
    // }
    // if ($bonus != "") {
    //     $result = $result->where('bonus', '=', $bonus);
    // }
    // if ($request->subscription_fee != '') {
    //     $result = $result->where('refundable_reg_fee', $request->subscription_fee);
    // }
    // if ($request->maximum_time != '') {
    //     $result = $result->where('maximum_time', '=', $request->maximum_time);
    // }
    // if ($request->minimum_trading_days != '') {
    //     $result = $result->where('minimum_trading_days', $request->minimum_trading_days);
    // }
    // if ($request->profit_split != '') {
    //     $result = $result->where('profit_split', $request->profit_split);
    // }
    // if ($request->maximum_funding != "") {
    //     $result = $result->where('maximum_funding', $request->maximum_funding);
    // }
    // if ($request->active_status != '') {
    //     $result = $result->where('active_status', $request->active_status);
    // }
    // /*<-------filter search script end here------------->*/f      

    // $count = $result->count();
    // $result = $result->orderby($orderby, $orderDir)->skip($start)->take($length)->get();
    // $data = array();
    // $i = 0;

    // foreach ($result as $row) {
    // $status = "";
    // if ($row->active_status == 1) {
    //     $status = 'Enable';
    // } else {
    //     $status = 'Disable';
    // }
    // $status="{{route('prescription')}}";
    //         $data[$i]['patient_name'] = ucwords($row->patient_name);
    //         $data[$i]['patient_age'] = $row->patient_age;
    //         $data[$i]['complaints'] = $row->complaints;
    //         $data[$i]['date'] = $row->date;
    //         // $data[$i]['minimum_trading_days'] = $row->minimum_trading_days;
    //         // $data[$i]['profit_split'] = $row->profit_split;
    //         // $data[$i]['maximum_funding'] = $row->maximum_funding;
    //         $data[$i]['action'] ='
    //        <div class="text-right">
    //        <div class="dropdown dropdown-action">
    //        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
    //        <div class="dropdown-menu dropdown-menu-right">

    //            <a class="dropdown-item" edit-id="'.$row->id.'" href="edit-patient.html"><i class="fa fa-pencil m-r-5"></i> Edit</a>
    //            <a class="dropdown-item" id="dltBtn" delete-id="'.$row->id.'" href="#" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
    //        </div>
    //    </div>


    //        </div>


    //         ';
    //         $i++;
    //     }

    //     return Response::json([
    //         'draw' => $_REQUEST['draw'],
    //         'recordsTotal' => $count,
    //         'recordsFiltered' => $count,
    //         'data' => $data
    //     ]);

    // }
}
