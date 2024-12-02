<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/admin/login', [AdminController::class, 'adminLoginPage'])->name('admin.login');
Route::post('/admin-login-save', [AdminController::class, 'adminLogin'])->name('adminlogin');

//notification
// Route::post('notifications/markAsRead',[NotificationController::class,'markAsRead'])->name('notifications.markAsRead');


Route::group(['middleware' => 'admin'], function () {
    //----------dashboard------------------
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/dashboard/statistics/patient', [AdminController::class, 'adminDashboardStatisticsByYearPatient'])->name('admin.dashboard.statistics.patient');
    Route::get('/admin/dashboard/statistics/income', [AdminController::class, 'adminDashboardStatisticsByYearIncome'])->name('admin.dashboard.statistics.income');
   //----------medicine------------------
    Route::get('/medicine/page', [AdminController::class, 'addMedicineForm'])->name('Medicine.Form');
    Route::post('/save-Medicine', [AdminController::class, 'saveMedicineForm'])->name('save.medicine.form');
    Route::post('/delete-Medicine', [AdminController::class, 'deleteMedicine'])->name('delete.medicine');
    //---------test-------------
    Route::get('/test/page', [AdminController::class, 'addTestForm'])->name('test.Form');
    Route::post('/save-test', [AdminController::class, 'saveTestForm'])->name('save.test.form');
    Route::post('/delete-test', [AdminController::class, 'deleteTest'])->name('delete.test');
    //---------test-------------
    Route::get('/diagnose/page', [AdminController::class, 'addDiagnoseForm'])->name('diagnose.Form');
    Route::post('/save-diagnose', [AdminController::class, 'saveDiagnoseForm'])->name('save.diagnose.form');
    Route::post('/delete-diagnose', [AdminController::class, 'deleteDiagnose'])->name('delete.diagnose');

    //------------complaints-------
    Route::get('/complaints/page', [AdminController::class, 'addComplaintsForm'])->name('Complaints.Form');
    Route::post('/save-complaints', [AdminController::class, 'saveComplaintsForm'])->name('save.complaints.form');
    Route::post('/delete-complaints', [AdminController::class, 'deleteComplaints'])->name('delete.complaints');
    //------------investigations-------
    Route::get('/investigations/page', [AdminController::class, 'addInvestigationsForm'])->name('Investigations.Form');
    Route::post('/save-Investigations', [AdminController::class, 'saveInvestigationsForm'])->name('save.investigations.form');
    Route::post('/delete-investigations', [AdminController::class, 'deleteInvestigations'])->name('delete.investigations');
    //------------add clinic-------
    Route::get('/add/clinic', [AdminController::class, 'addClinicForm'])->name('clinic.form');
    Route::post('/save-clinic', [AdminController::class, 'saveClinicForm'])->name('save.clinic.form');
    Route::post('/delete-clinic', [AdminController::class, 'deleteClinic'])->name('delete.clinic');
   // -------------doctor list----------
    Route::get('/doctor-list', [AdminController::class, 'getDoctorList'])->name('doctor.list');
    Route::get('/doctor-list/data', [AdminController::class, 'getDoctorListData'])->name('doctor.list.data');
    Route::post('/doctor-list/data/update', [AdminController::class, 'DoctorListUpdate'])->name('doctor.list.update');
    Route::post('/doctor-list/data/delete', [AdminController::class, 'DoctorDelete'])->name('doctor.delete');
    Route::get('/doctor-list/data/details/{id}', [AdminController::class, 'DoctorDetails'])->name('doctor.details');
    Route::get('/doctor-list/status', [AdminController::class, 'DoctorStatus'])->name('doctor.status');
    //---------------patient list------------
    Route::get('/patient/list/', [AdminController::class, 'getPatientList'])->name('patient.list');
    Route::get('/patient/precription/{id}/', [AdminController::class, 'getPatientPrecription'])->name('patient.precription');
    Route::get('/get-patient-details', [AdminController::class, 'getPatientDetailsData'])->name('get.Patient.DetailsData');
    Route::post('/update-patient-details', [AdminController::class, 'updatePatientDetailsData'])->name('update.Patient.DetailsData');
    Route::post('/delete-patient-details', [AdminController::class, 'deletePatientDetailsData'])->name('delete.Patient.DetailsData');
    Route::post('/add-doctor', [AdminController::class, 'addDoctor'])->name('add.doctor');
    //-----------------notice--------------
    Route::get('/notice-page', [AdminController::class, 'getNotice'])->name('notice.page');
    Route::post('/add-notice', [AdminController::class, 'addNotice'])->name('add.notice.form');
    Route::post('/delete-notice', [AdminController::class, 'deleteNotice'])->name('delete.notice');
    Route::post('/notice/status', [AdminController::class, 'noticeStatus'])->name('notice.status');

    // Route::get('/admin-dashboard',[AdminController::class,'adminDashboard'])->name('admin.dashboard');


    //-------------change password admin---------
    Route::get('/change-password', [AdminController::class, 'getchangePassword'])->name('admin.change.password');
    Route::post('/change-password/save', [AdminController::class, 'savechangePassword'])->name('admin.save.change.password');
    //-------------logout admin-----------------
    Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');
    Route::post('notifications/markAsRead',[NotificationController::class,'markAsRead'])->name('notifications.markAsRead');

});


Route::get('/', [FrontEndController::class, 'getLoginPage'])->name('login-page');
Route::post('/doctor-login-save', [FrontEndController::class, 'doctorLogin'])->name('doctorlogin');


//forget passsword
Route::get('/forget-password',[ForgetPasswordController::class,'showForgetPasswordForm'])->name('show.ForgetPassword.Form');
Route::post('/forget-password', [ForgetPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::middleware('auth')->group(function () {
    Route::get('/registration-page', [FrontEndController::class, 'getRegistrationPage'])->name('registration-page');
    Route::get('/get-home', [FrontEndController::class, 'getHome'])->name('get.home');
    // Route::get('/index', [FrontEndController::class, 'getIndex'])->name('index-page')->name('dashboard');
   
    //---------------profile----------------
    Route::get('/profile', [FrontEndController::class, 'getProfile'])->name('profile');
    Route::get('/edit-profile', [FrontEndController::class, 'getEditProfile'])->name('profile-edit');
    Route::post('/save-editprofile', [FrontEndController::class, 'saveEditProfile'])->name('save.profile.edit');
    
    //--------prescription
    Route::get('/prescription', [FrontEndController::class, 'getPrescription'])->name('prescription');
    Route::post('/save-prescription', [FrontEndController::class, 'savePrescription'])->name('save.prescription');
    
    //----------patient-------------
    Route::get('/patient-details', [FrontEndController::class, 'getMyAllPatient'])->name('patientdetails');
    Route::get('/show-prescription/{id}', [FrontEndController::class, 'showPrescription'])->name('show.prescription');
    Route::post('/delete-Patient', [FrontEndController::class, 'deletePatient'])->name('delete.patient');
    Route::get('/update/Patient', [FrontEndController::class, 'getUpdatePatient'])->name('update.patient');
    Route::post('/save-patient-update', [FrontEndController::class, 'saveUpdatePatient'])->name('userUpdate.Patient');
    Route::get('/show/prescription/{id}', [FrontEndController::class, 'showPrescriptionDetails'])->name('showDetailsprescription');
    Route::post('/edit-prescription', [FrontEndController::class, 'editPrescription'])->name('edit.prescription');

    //print page
    Route::get('/review/print/{id}', [FrontEndController::class, 'printPageReview'])->name('printPageReview');
    Route::post('/delete/print', [FrontEndController::class, 'deletePrintPrescription'])->name('delete.prescription');
    Route::get('/show/print/{id}', [FrontEndController::class, 'printPageUpdate'])->name('printPage');

    //------statistics-------------
    Route::get('/doctor/statistics', [FrontEndController::class, 'doctorStatistics'])->name('doctor.statistics');
    
    //------------change password----------------
    Route::get('/user-change-password-page', [FrontEndController::class, 'getchangePassword'])->name('userchangePassword.page');
    Route::post('/user-change-password', [FrontEndController::class, 'savechangePassword'])->name('save.change.password');

    
    // Route::get('/patientt-details',[FrontEndController::class,'gettPatient'])->name('patientdetails1');
    // Route::get('/dashboard', [FrontEndController::class, 'adminDashboard']);
    Route::post('notifications/markAsRead',[NotificationController::class,'markAsRead'])->name('notifications.markAsRead');

    //------------logout----------------
    Route::get('/logout', [FrontEndController::class, 'Logout'])->name('logout');

});

require __DIR__ . '/auth.php';
