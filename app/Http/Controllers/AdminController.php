<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Clinic;
use App\Models\Complaints;
use App\Models\Diagnose;
use App\Models\Investigation;
use App\Models\Medicine;
use App\Models\Notice;
use App\Models\Prescription;
use App\Models\Test;
use App\Models\User;
use App\Notifications\MedicineAdded;
use App\Notifications\NoticeEnabled;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{


                //---------admin Login credentials-----------

    public function adminLoginPage()
    {
        return view('admin.login.admin-login');
    }
    public function adminLogin(Request $request)
    {
        $request->validate(([
            'email' => 'required',
            'password' => 'required',
        ]));
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'status' => true,
                'redirect' => url("/admin/dashboard")
            ]);
            // return redirect("/admin/dashboard");
            // return ("admin.manage-prescription.add-medicine");
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

                 //---------admin dashboard credentials-----------

    public function adminDashboard()
    {
        //    if(Auth::check()){
        $today = Carbon::today();
        $toDaysPatient = Prescription::whereDate('created_at', $today)->count();
        $doctorCount = User::where('role', 'user')->count();
        $patientCount = Prescription::count();
        $userCharts = Prescription::selectRaw('MONTH(created_at) as month , COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
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
        // $patients = Prescription::select('patient_name', 'patient_age', 'complaints', 'prescriptions.created_at as date', 'users.name as name','investigations')
        //     ->join('users', 'users.id', 'prescriptions.dr_id')->latest('prescriptions.created_at')->get();

        // total income

        $appointments = Prescription::all();
        $patients = Prescription::select('patient_name', 'patient_age', 'diagnoses', 'prescriptions.created_at as date', 'users.name as name','investigations')
            ->join('users', 'users.id', 'prescriptions.dr_id')->latest('prescriptions.created_at')->get();

        $appointments = Prescription::all();

        $userCharts1 = Prescription::selectRaw('MONTH(created_at) as month , SUM(visit_fee) as sum')
            ->whereYear('created_at', date('Y-m'))
            // ->where('dr_id', $authenticatedDoctorId)
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
                'label' => 'TotalVisitFee',
                'data' => $data1,
                'backgroundColor' => $colurs
            ]
        ];
        $doctors = User::select('users.id as id', 'users.name as name', 'users.profile_image as profile_image', 'users.qualification as qualification', DB::raw('COUNT(users.id) as totalDoctor'), DB::raw('COUNT(prescriptions.dr_id) as totalPrescription'))
            ->join('prescriptions', 'prescriptions.dr_id', 'users.id')
            ->where('role', 'user')
            ->groupBy('users.id', 'users.name', 'users.qualification', 'users.profile_image')
            // ->latest()
            ->get();
        // dd($datasets1);
        return view('admin.admin-dashboard1', compact('doctorCount', 'patientCount', 'toDaysPatient', 'patients', 'doctors', 'datasets', 'labels', 'datasets1', 'labels1'));
    }
    
    public function adminDashboardStatisticsByYearPatient(Request $request)
    {
        $userCharts = Prescription::selectRaw('MONTH(created_at) as month , COUNT(*) as count')
            // ->whereYear('created_at', date('Y'))
            ->whereYear('created_at', $request->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];
        $colours = ['#ff0000', '#ff8000', '#ffff00', '#80ff00 ', '#00ff00', '#00ff80', '#00ffff ', '#0080ff', '#0000ff', '#8000ff', '#ff00ff', '#ff0080'];

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
                'backgroundColor' => $colours
            ]
        ];

         // Check if datasets is empty
         if (empty($datasets)) {
            // Return appropriate response indicating no data available
            return response()->json(['message' => 'No data available'], 404);
        }

        // Return data as JSON response
        return response()->json([
            'labels' => $labels,
            'datasets' => $datasets
        ]);
    }
    public function adminDashboardStatisticsByYearIncome(Request $request)
    {
        $userCharts1 = Prescription::selectRaw('MONTH(created_at) as month , SUM(visit_fee) as sum')
            // ->whereYear('created_at', date('Y-m'))
            ->whereYear('created_at', $request->year)
            // ->where('dr_id', $authenticatedDoctorId)
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
                'label' => 'TotalVisitFee',
                'data' => $data1,
                'backgroundColor' => $colurs
            ]
        ];

        // Check if datasets is empty
        if (empty($datasets1)) {
            // Return appropriate response indicating no data available
            return response()->json(['message' => 'No data available'], 404);
        }


        // Return data as JSON response
        return response()->json([
            'labels1' => $labels1,
            'datasets1' => $datasets1,
            // 'monthlyFees' => $monthlyFees
        ]);
    }

                //---------admin clinic details credentials-----------

      public function addClinicForm(Request $request)
      {
          $clinics = Clinic::find(1);
          if ($request->ajax()) {
              if ($clinics) {
                  return response()->json([
                      'message' => 'clinics found',
                      'status' => 200,
                      'data' => $clinics,
                  ]);
              } else {
                  return response()->json([
                      'message' => 'internel server error',
                      'code' => 500,
                  ]);
              }
          }
          return view('admin.clinic-details.add-clinic-details', ['clinics' => $clinics]);
      }
      public function saveClinicForm(Request $request)
      {
          $request->validate([
              'clinic_name' => 'required',
              'location' => 'required',
          ]);
          $create = Clinic::find($request->clinicId)->update($request->only('clinic_name', 'location'));
          if ($create) {
              return response()->json([
                  'status' => true,
              ]);
          } else {
              return response()->json([
                  'status' => false,
              ]);
          }
      }
      public function deleteClinic(Request $request)
      {
          $clinicDlt = Clinic::find($request->id)->delete();
          if ($clinicDlt) {
              return response()->json([
                  'status' => true,
              ]);
          } else {
              return response()->json([
                  'status' => false,
              ]);
          }
      }

            //---------admin addComplaintsForm credentials-----------

    public function addComplaintsForm(Request $request)
    {
        $complaints = Complaints::all();
        if ($request->ajax()) {
            if ($complaints) {
                return response()->json([
                    'message' => 'complaints found',
                    'status' => 200,
                    'data' => $complaints,

                ]);
            } else {
                return response()->json([
                    'message' => 'internel server error',
                    'code' => 500,
                ]);
            }
        }
        return view('admin.manage-prescription.add-complaints', ['complaints' => $complaints]);
    }
    public function saveComplaintsForm(Request $request)
    {
        $request->validate([
            'complaints' => 'required',
        ]);

        if (Complaints::where('complaints', $request->complaints)->exists()) {
            return response()->json([
                'status' => 'exit',
                'massage' => $request->complaints,
            ]);
        } else {
            // $create
            $create = Complaints::create($request->only('complaints'));
            if ($create) {
                return response()->json([
                    'status' => true,
                    'massage' => $request->complaints,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                ]);
            }
        }
    }
    public function deleteComplaints(Request $request)
    {
        $complaintDlt = Complaints::find($request->id)->delete();
        if ($complaintDlt) {
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

             //---------admin addMedicineForm credentials-----------

    public function addMedicineForm()
    {
        $medicines = Medicine::all();
        if (request()->ajax()) {
            if ($medicines) {
                return response()->json([
                    'message' => 'medicine found',
                    'status' => 200,
                    'data' => $medicines,
                ]);
            } else {
                return response()->json([
                    'message' => 'internel server error',
                    'code' => 500,
                ]);
            }
        }
        
        return view('admin.manage-prescription.add-medicine', ['medicines' => $medicines]);
    }
    public function saveMedicineForm(Request $request)
    {
        $request->validate([
            'medicine' => 'required',
        ]);
        if (Medicine::where('medicine', $request->medicine)->exists()) {
            return response()->json([
                'status' => 'exit',
                'massage' => $request->medicine,
            ]);
        } else {

            $create = Medicine::create($request->only('medicine'));
            if ($create) {
                Notification::send(User::all(), new MedicineAdded($request->medicine));
                return response()->json([
                    'status' => true,
                    'massage' => $request->medicine,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                ]);
            }
        }
        
    }
    public function deleteMedicine(Request $request)
    {
        $medicineDlt = Medicine::find($request->id)->delete();
        if ($medicineDlt) {
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

              //---------admin addInvestigationsForm credentials-----------

    public function addInvestigationsForm(Request $request)
    {
        $investigations = Investigation::all();
        if ($request->ajax()) {
            if ($investigations) {
                return response()->json([
                    'message' => 'investigations found',
                    'status' => 200,
                    'data' => $investigations,
                ]);
            } else {
                return response()->json([
                    'message' => 'internel server error',
                    'code' => 500,
                ]);
            }
        }
        return view('admin.manage-prescription.add-investigation', ['investigations' => $investigations]);
    }
    public function saveInvestigationsForm(Request $request)
    {
        $request->validate([
            'investigation' => 'required',
        ]);
        // $create=Investigation::create($request->only('investigation'));
        if (Investigation::where('investigation', $request->investigation)->exists()) {
            return response()->json([
                'status' => 'exit',
                'massage' => $request->investigation,
            ]);
        } else {
            $create = new Investigation;
            $create->investigation = $request->investigation;
            $save = $create->save();

            if ($save) {
                return response()->json([
                    'status' => true,
                    'massage' => $request->investigation,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                ]);
            }
        }
    }
    public function deleteInvestigations(Request $request)
    {
        $investigationDlt = Investigation::find($request->id)->delete();
        if ($investigationDlt) {
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

                    //---------admin test credentials-----------

     public function addTestForm()
     {
         $tests = Test::all();
         if (request()->ajax()) {
             if ($tests) {
                 return response()->json([
                     'message' => 'test found',
                     'status' => 200,
                     'data' => $tests,
                 ]);
             } else {
                 return response()->json([
                     'message' => 'internel server error',
                     'code' => 500,
                 ]);
             }
         }
         return view('admin.manage-prescription.add-test', ['tests' => $tests]);
     }
     public function saveTestForm(Request $request)
     {
         $request->validate([
             'test' => 'required',
         ]);
         if (Test::where('test', $request->test)->exists()) {
             return response()->json([
                 'status' => 'exit',
                 'massage' => $request->test,
             ]);
         } else {
 
             $create = Test::create($request->only('test'));
             if ($create) {
                 return response()->json([
                     'status' => true,
                     'massage' => $request->test,
                 ]);
             } else {
                 return response()->json([
                     'status' => false,
                 ]);
             }
         }
     }
     public function deleteTest(Request $request)
     {
         $testDlt = Test::find($request->id)->delete();
         if ($testDlt) {
             return response()->json([
                 'status' => true,
             ]);
         } else {
             return response()->json([
                 'status' => false,
             ]);
         }
     }

                    //---------admin diagnose credentials-----------

     public function addDiagnoseForm()
     {
         $diagnoses = Diagnose::all();
         if (request()->ajax()) {
             if ($diagnoses) {
                 return response()->json([
                     'message' => 'diagnose found',
                     'status' => 200,
                     'data' => $diagnoses,
                 ]);
             } else {
                 return response()->json([
                     'message' => 'internel server error',
                     'code' => 500,
                 ]);
             }
         }
         return view('admin.manage-prescription.add-diagnose', ['diagnoses' => $diagnoses]);
     }
     public function saveDiagnoseForm(Request $request)
     {
         $request->validate([
             'diagnose' => 'required',
         ]);
         if (Diagnose::where('diagnose', $request->diagnose)->exists()) {
             return response()->json([
                 'status' => 'exit',
                 'massage' => $request->diagnose,
             ]);
         } else {
 
             $create = Diagnose::create($request->only('diagnose'));
             if ($create) {
                 return response()->json([
                     'status' => true,
                     'massage' => $request->diagnose,
                 ]);
             } else {
                 return response()->json([
                     'status' => false,
                 ]);
             }
         }
     }
     public function deleteDiagnose(Request $request)
     {
         $diagnoseDlt = Diagnose::find($request->id)->delete();
         if ($diagnoseDlt) {
             return response()->json([
                 'status' => true,
             ]);
         } else {
             return response()->json([
                 'status' => false,
             ]);
         }
     }

                   //---------admin doctors list credentials-----------

    public function getDoctorList()
    {
        if(request('search')){
            $doctor = User::where('name', 'like', '%' . request('search') . '%')->get();
        }else{
            $doctor = User::where('role', '=', 'user')->get();

        }
        

        return view('admin.doctor.doctor-list', ['doctors' => $doctor]);
    }
    public function addDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'education_informations' => 'required',
            'qualification' => 'required',
            'specialist' => 'required',
            'whenyouseat' => 'required',
            'seating_day' => 'required',
            'friday_seating_time' => 'required',
            'visit_fee' => 'required|numeric',
            // 'phone' => 'required|regex:/^(\+01)[0-9]{11}$ /',
            'phone' => 'required|numeric|digits:11',
            'birthday' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required',Rules\Password::defaults()],
        ]);
        $drid = User::create([
            'name' => $request->name,
            'education_informations' => $request->education_informations,
            'qualification' => $request->qualification,
            'specialist' => $request->specialist,
            'whenyouseat' => $request->whenyouseat,
            'seating_day' => $request->seating_day,
            'friday_seating_time' => $request->friday_seating_time,
            'visit_fee' => $request->visit_fee,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),

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
    public function getDoctorListData(Request $request)
    {
        $result = User::select('id', 'name', 'education_informations', 'qualification', 'specialist', 'whenyouseat', 'seating_day', 'friday_seating_time', 'visit_fee', 'phone', 'birthday', 'address', 'gender')
            ->where('id', $request->id)
            ->first();
        return $result;
    }
    public function DoctorDetails($id)
    {
        $doctordetails = User::find($id);
        return view('admin.doctor.doctor-details', compact('doctordetails'));
    }
    public function DoctorListUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'education_informations' => 'required',
            'qualification' => 'required',
            'specialist' => 'required',
            'whenyouseat' => 'required',
            'seating_day' => 'required',
            'friday_seating_time' => 'required',
            'visit_fee' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ]);
        $drid = User::find($request->drId)->update([
            'name' => $request->name,
            'education_informations' => $request->education_informations,
            'qualification' => $request->qualification,
            'specialist' => $request->specialist,
            'whenyouseat' => $request->whenyouseat,
            'seating_day' => $request->seating_day,
            'friday_seating_time' => $request->friday_seating_time,
            'visit_fee' => $request->visit_fee,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'gender' => $request->gender,

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
    public function DoctorDelete(Request $request)
    {
        $drDlt = User::find($request->id)->delete();
        if ($drDlt) {
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }
    public function DoctorStatus(Request $request)
    {
        $status = User::find($request->id);
        $status->status = $request->status;

        $status->save();
        return response()->json([
            'status' => true,
        ]);
    }

                //---------admin patient list credentials-----------

    public function getPatientList()
    {
        $patient = Prescription::select('patient_name', 'patient_age', 'name', 'reg_no', 'date', 'prescriptions.id as p_id', 'users.id as drid')
            ->join('users', 'prescriptions.dr_id', 'users.id')
            ->get();
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
        return view('admin.patient.patient-list', ['patients' => $patient]);
    }
    public function getPatientPrecription($id)
    {
        // $drId=User::find($id);

        $prescriptions = Prescription::select('*', 'users.name as name')
            ->join('users', 'prescriptions.dr_id', 'users.id')
            ->where('prescriptions.id', $id)
            ->first();
        // return $prescriptions;
        $clinicDetails = Clinic::find(1);
        return view('admin.patient.prescription-admin', compact(['prescriptions', 'clinicDetails']));
    }
    public function getPatientDetailsData(Request $request)
    {
        $result = Prescription::select('id','patient_name', 'patient_age','visit_fee')
            ->where('id', $request->id)
            ->first();
        return $result;
    }
    public function updatePatientDetailsData(Request $request)
    {
        $request->validate([
            'patient_name' => 'required',
            'patient_age' => 'required',
            'visit_fee' => 'required|numeric',

        ]);
        $drid = Prescription::find($request->patientId)->update([
            'patient_name' => $request->patient_name,
            'patient_age' => $request->patient_age,
            'visit_fee' => $request->visit_fee,


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
    public function deletePatientDetailsData(Request $request)
    {
        $patientDlt = Prescription::find($request->id)->delete();
        if ($patientDlt) {
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

               //---------admin notice credentials-----------

    public function addNotice(Request $request)
    {
        $request->validate([
            'notice' => 'required',
        ]);

        $create = Notice::create($request->only('notice'));
        if ($create) {
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }
    public function getNotice(Request $request)
    {
        $notices = Notice::all();
        if ($request->ajax()) {
            if ($notices) {
                return response()->json([
                    'message' => 'notice found',
                    'status' => 200,
                    'data' => $notices,
                ]);
            } else {
                return response()->json([
                    'message' => 'internel server error',
                    'code' => 500,
                ]);
            }
        }
        $showNotices = Notice::where('status', 'Active')->get();
        return view('admin.notice.notice', ['showNotices' => $showNotices, 'notices' => $notices]);
    }
    public function deleteNotice(Request $request)
    {
        $noticeDlt = Notice::find($request->id)->delete();
        if ($noticeDlt) {
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }
    public function noticeStatus(Request $request)
    {
        $status = Notice::find($request->id)->update([
            'status' => $request->status
        ]);
        if($request->status==='Active'){
            Notification::send(User::all(), new NoticeEnabled($status));

        }
        if ($status) {
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }


              //---------admin settings credentials-----------

    public function getchangePassword()
    {
        return view('admin.settings.password-change');
    }
   

    public function savechangePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->old_password, Auth::guard('admin')->user()->password);
        if($currentPasswordStatus){

            Admin::findOrFail(Auth::guard('admin')->user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['status' => 'success']);

        }else{

            return response()->json(['status' => 'error']);
        }
    }




    

                //---------admin logout credentials-----------

    public function Logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
