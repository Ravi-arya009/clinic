<?php

use App\Http\Controllers\admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\admin\AuthController as AdminAuthController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\MedicineController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\patient\DashboardController as PatientDashboardController;
use App\Http\Controllers\patient\AuthController as PatientAuthController;
use App\Http\Controllers\admin\TimeSlotController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\super_admin\AuthController as Super_adminAuthController;
use App\Http\Controllers\super_admin\ClinicController;
use App\Http\Controllers\super_admin\DashboardController;
use App\Http\Controllers\TempController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

########################################################################################
####Routes for testing purposes####

//global logout route. (Temporary, only for testing purposes)
Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');
// Route::get('temp', [TempController::class, 'temp'])->name('temp');

Route::domain('{clinicSlug}.localhost')->group(
    function () {
        Route::get('admin/temp', [TempController::class, 'temp'])->name('temp');
        // Route::get('appointments', [AdminAppointmentController::class, 'index'])->name('admin.appointments.index');
    });

####Routes for testing purposes end####
########################################################################################
########################################################################################

//Super Admin Routes
Route::prefix('super_admin')->group(
    function () {
        Route::middleware('RedirectIfAuthenticated:super_admin')->group(function () {
            Route::get('/login', [Super_adminAuthController::class, 'login'])->name('super_admin.login');
            Route::post('/login', [Super_adminAuthController::class, 'authenticate'])->name('super_admin.authenticate');
        });
        Route::middleware('IsLoggedIn:super_admin')->group(function () {
            Route::get('/', [DashboardController::class, 'dashboard'])->name('super_admin.index');
            Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('super_admin.dashboard');
            Route::get('clinic/index', [ClinicController::class, 'index'])->name('super_admin.clinic.index');
            Route::get('clinic/create', [ClinicController::class, 'create'])->name('super_admin.clinic.create');
            Route::post('clinic/store', [ClinicController::class, 'store'])->name('super_admin.clinic.store');
            Route::get('clinic/view/{clinicId}', [ClinicController::class, 'show'])->name('super_admin.clinic.show');
            Route::post('clinic/update/{clinicId}', [ClinicController::class, 'update'])->name('super_admin.clinic.update');
            Route::get('logout', [Super_adminAuthController::class, 'logout'])->name('super_admin.logout');
        });
    }
);

//Clinic Admin Routes
Route::domain('{clinicSlug}.localhost')->middleware('ClinicSessionManager')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::middleware('RedirectIfAuthenticated:admin')->group(function () {
            Route::get('/login', [AdminAuthController::class, 'login'])->name('admin.login');
            Route::post('/login', [AdminAuthController::class, 'authenticate'])->name('admin.authenticate');
        });

        Route::middleware('IsLoggedIn:admin')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'dashboard'])->name('admin.index');
            Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
            Route::get('user/create', [UserController::class, 'create'])->name('admin.user.create');
            Route::post('user/store', [UserController::class, 'store'])->name('admin.user.store');

            Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        });
    });
});


################


// Guest Routes
Route::get('/', [WebsiteController::class, 'index'])->name('index');
Route::get('/doctor/{id?}', [WebsiteController::class, 'ShowDoctorProfile'])->name('doctor.profile');
Route::get('/clinic/{id?}', [WebsiteController::class, 'ShowClinicProfile'])->name('clinic.profile');
Route::get('/search', [SearchController::class, 'ajaxSearch'])->name('search.ajax');
Route::get('/search/doctor', [SearchController::class, 'searchDoctor'])->name('search.doctor');
Route::get('/search/clinic', [SearchController::class, 'searchClinic'])->name('search.clinic');
Route::get('/search/all', [SearchController::class, 'all'])->name('search.all');
Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointment.store');
// Guest Routes

// clinic dynamic landing route
Route::domain('{clinicSlug}.localhost')->middleware('ClinicSessionManager')->group(function () {
    // Landing page for the clinic
    Route::get('/', [TenantController::class, 'landing'])->name('clinic.landing');

    //Admin routes
    Route::prefix('admin')->group(function () {

        Route::get('users/{role_id?}', [UserController::class, 'index'])->name('admin.user.index');


        Route::get('user/{userId}', [UserController::class, 'show'])->name('admin.user.show');
        Route::put('user/{userId}', [UserController::class, 'update'])->name('admin.user.update');
        Route::get('available_timings/{doctor_id?}', [TimeSlotController::class, 'availableTimings'])->name('admin.available_timings');


        Route::get('appointments', [AdminAppointmentController::class, 'index'])->name('admin.appointments.index');
        Route::get('/appointment/{appointmentId}', [AdminAppointmentController::class, 'show'])->name('admin.appointment.show');
        Route::post('/appointment_details/store', [AdminAppointmentController::class, 'store'])->name('admin.appointment_details.store');
        Route::get('/medicines', [MedicineController::class, 'index'])->name('admin.medicines.index');
        Route::post('/medicine', [MedicineController::class, 'store'])->name('admin.medicine.store');
        Route::put('/medicine/{medicineId}', [MedicineController::class, 'update'])->name('admin.medicine.update');

        //not working for now because not sending the ajax reques to sub domain. see notes.
        Route::post('delete_slot/{slot_id?}', [TimeSlotController::class, 'deleteSlot'])->name('admin.slot.delete');
    });
});

// Patient routes
Route::prefix('patient')->group(function () {
    // routes allowed only to logged in patients
    Route::get('/', [PatientDashboardController::class, 'home'])->name('patient.home');

    Route::middleware('IsLoggedIn:patients')->group(function () {
        Route::get('dashboard', [PatientDashboardController::class, 'dashboard'])->name('patient.dashboard');
        Route::get('logout', [PatientAuthController::class, 'logout'])->name('patient.logout');

        Route::get('clinics', [PatientDashboardController::class, 'clinics'])->name('patient.clinics');
        Route::get('clinic/{clinicId}', [PatientDashboardController::class, 'show'])->name('patient.clinic.show');
    });

    // routes allowed only to guests
    Route::middleware('RedirectIfAuthenticated:patients')->group(function () {
        Route::get('login', [PatientAuthController::class, 'login'])->name('patient.login');
        Route::post('login', [PatientAuthController::class, 'authenticate'])->name('patient.authenticate');
        Route::get('register', [PatientAuthController::class, 'register'])->name('patient.register');
        Route::post('register', [PatientAuthController::class, 'store'])->name('patient.store');
    });
});




Route::get('/user/login', [AuthController::class, 'showLoginForm'])->name('user.login_form');
Route::post('/user/login', [AuthController::class, 'login'])->name('user.login');

Route::get('/doctor/dashboard', [DoctorDashboardController::class, 'dashboard'])->name('doctor.dashboard');
Route::get('/staff/dashboard', [StaffDashboardController::class, 'dashboard'])->name('staff.dashboard')->middleware(['role:' . config('role.staff')]);

Route::get('/doctor/time_slots', [TimeSlotController::class, 'viewTimeSlot'])->name('doctor.view_time_slot');
Route::post('/doctor/time_slots', [TimeSlotController::class, 'store'])->name('doctor.add_time_slot');
