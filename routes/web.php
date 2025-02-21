<?php

use App\Http\Controllers\admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\admin\AuthController as AdminAuthController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\MedicineController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\patient\DashboardController as PatientDashboardController;
use App\Http\Controllers\patient\AuthController as PatientAuthController;
use App\Http\Controllers\admin\TimeSlotController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\doctor\AppointmentController as DoctorAppointmentController;
use App\Http\Controllers\doctor\AuthController as DoctorAuthController;
use App\Http\Controllers\doctor\PatientController;
use App\Http\Controllers\doctor\TimeSlotController as DoctorTimeSlotController;
use App\Http\Controllers\patient\AppointmentController as PatientAppointmentController;
use App\Http\Controllers\patient\InvoiceController;
use App\Http\Controllers\patient\PerscriptionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\super_admin\AuthController as Super_adminAuthController;
use App\Http\Controllers\super_admin\ClinicController;
use App\Http\Controllers\super_admin\DashboardController;
use App\Http\Controllers\TempController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;


#### Super Admin ####
Route::prefix('super_admin')->group(
    function () {
        Route::middleware('RedirectIfAuthenticated:super_admin')->group(function () {
            Route::get('/login', [Super_adminAuthController::class, 'login'])->name('super_admin.login');
            Route::post('/login', [Super_adminAuthController::class, 'authenticate'])->name('super_admin.authenticate');
        });
        Route::middleware('IsLoggedIn:super_admin')->group(function () {
            Route::get('/', [DashboardController::class, 'dashboard'])->name('super_admin.index');
            Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('super_admin.dashboard');
            Route::get('clinic/create', [ClinicController::class, 'create'])->name('super_admin.clinic.create');
            Route::post('clinic/store', [ClinicController::class, 'store'])->name('super_admin.clinic.store');
            Route::get('clinic/view/{clinicId}', [ClinicController::class, 'show'])->name('super_admin.clinic.show');
            Route::post('clinic/update/{clinicId}', [ClinicController::class, 'update'])->name('super_admin.clinic.update');
            Route::get('clinic/index', [ClinicController::class, 'index'])->name('super_admin.clinic.index');
            Route::get('logout', [Super_adminAuthController::class, 'logout'])->name('super_admin.logout');
        });
    }
);

#### Admin ####
Route::domain('{clinicSlug}.localhost')->middleware('ClinicSessionManager')->group(function () {
    Route::get('/', [TenantController::class, 'landing'])->name('clinic.landing');
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
            Route::get('user/{userId}', [UserController::class, 'show'])->name('admin.user.show');
            Route::put('user/{userId}', [UserController::class, 'update'])->name('admin.user.update');
            Route::get('users/{role_id?}', [UserController::class, 'index'])->name('admin.user.index');
            Route::get('time_slots/{doctor_id?}', [TimeSlotController::class, 'index'])->name('admin.time_slots.index');
            Route::post('time_slots', [TimeSlotController::class, 'store'])->name('admin.time_slots.store');
            Route::post('delete_slot/{slot_id?}', [TimeSlotController::class, 'delete'])->name('admin.slot.delete');
            Route::get('appointments', [AdminAppointmentController::class, 'index'])->name('admin.appointments.index');
            Route::get('/appointment/{appointmentId}', [AdminAppointmentController::class, 'show'])->name('admin.appointment.show');
            Route::post('/appointment_details/store', [AdminAppointmentController::class, 'store'])->name('admin.appointment_details.store');
            Route::get('/medicines', [MedicineController::class, 'index'])->name('admin.medicines.index');
            Route::post('/medicine', [MedicineController::class, 'store'])->name('admin.medicine.store');
            Route::put('/medicine/{medicineId}', [MedicineController::class, 'update'])->name('admin.medicine.update');
            Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

            Route::get('patient/create', [UserController::class, 'createPatient'])->name('admin.patient.create');
            Route::post('patient/store', [UserController::class, 'storePatient'])->name('admin.patient.store');
            Route::get('patient/{patientId}', [UserController::class, 'showPatient'])->name('admin.patient.show');
        });
    });
});

#### Doctor ####
Route::domain('{clinicSlug}.localhost')->middleware('ClinicSessionManager')->group(function () {
    Route::prefix('doctor')->group(function () {
        Route::middleware('RedirectIfAuthenticated:doctor')->group(function () {
            Route::get('/login', [DoctorAuthController::class, 'login'])->name('doctor.login');
            Route::post('/login', [DoctorAuthController::class, 'authenticate'])->name('doctor.authenticate');
        });

        Route::middleware('IsLoggedIn:doctor')->group(function () {
            Route::get('/', [DoctorDashboardController::class, 'dashboard'])->name('doctor.index');
            Route::get('dashboard', [DoctorDashboardController::class, 'dashboard'])->name('doctor.dashboard');
            Route::get('patients', [PatientController::class, 'index'])->name('doctor.patient.index');
            Route::get('patient/{patientId}', [PatientController::class, 'show'])->name('doctor.patient.show');
            Route::put('patient/{patientId}', [PatientController::class, 'update'])->name('doctor.patient.update');
            Route::get('appointments', [DoctorAppointmentController::class, 'upcomingAppointments'])->name('doctor.appointments.index');
            Route::get('/appointment/{appointmentId}', [DoctorAppointmentController::class, 'show'])->name('doctor.appointment.show');
            Route::post('/appointment_details/store', [DoctorAppointmentController::class, 'store'])->name('doctor.appointment_details.store');
            Route::get('appointments/history', [DoctorAppointmentController::class, 'appointmentHistory'])->name('doctor.appointments.history');
            Route::get('time_slots', [DoctorTimeSlotController::class, 'index'])->name('doctor.time_slots.index');
            Route::post('time_slots', [DoctorTimeSlotController::class, 'store'])->name('doctor.time_slots.store');
            Route::post('delete_slot/{slot_id?}', [DoctorTimeSlotController::class, 'delete'])->name('doctor.slot.delete');
            Route::get('/logout', [DoctorAuthController::class, 'logout'])->name('doctor.logout');
        });
    });
});

#### Patient ####
Route::prefix('patient')->group(function () {
    Route::middleware('IsLoggedIn:patients')->group(function () {
        Route::get('/', [PatientDashboardController::class, 'home'])->name('patient.home');
        Route::get('dashboard', [PatientDashboardController::class, 'dashboard'])->name('patient.dashboard');
        Route::get('appointments', [PatientAppointmentController::class, 'index'])->name('patient.appointments.index');
        Route::get('appointment/{appointmentId}', [PatientAppointmentController::class, 'show'])->name('patient.appointment.show');
        Route::get('appointments/history', [PatientAppointmentController::class, 'appointmentHistory'])->name('patient.appointments.history');
        Route::get('family_members', [PatientDashboardController::class, 'dashboard'])->name('patient.family.index');
        Route::get('invoices', [InvoiceController::class, 'index'])->name('patient.invoices.index');
        Route::get('perscription', [PerscriptionController::class, 'index'])->name('patient.perscription.index');
        Route::get('doctors', [PatientDashboardController::class, 'dashboard'])->name('patient.doctors.index');
        Route::get('clinics', [PatientDashboardController::class, 'clinics'])->name('patient.clinics');
        Route::get('clinic/{clinicId}', [PatientDashboardController::class, 'show'])->name('patient.clinic.show');
        Route::get('logout', [PatientAuthController::class, 'logout'])->name('patient.logout');
        Route::get('temp', [PatientDashboardController::class, 'temp'])->name('patient.temp');
    });

    Route::middleware('RedirectIfAuthenticated:patients')->group(function () {
        Route::get('login', [PatientAuthController::class, 'login'])->name('patient.login');
        Route::post('login', [PatientAuthController::class, 'authenticate'])->name('patient.authenticate');
        Route::get('register', [PatientAuthController::class, 'register'])->name('patient.register');
        Route::post('register', [PatientAuthController::class, 'store'])->name('patient.store');
    });
});

#### Guest ####
Route::get('/', [WebsiteController::class, 'index'])->name('index');
Route::get('/doctor/{id?}', [WebsiteController::class, 'ShowDoctorProfile'])->name('doctor.profile');
Route::get('/clinic/{id?}', [WebsiteController::class, 'ShowClinicProfile'])->name('clinic.profile');
Route::get('/search', [SearchController::class, 'ajaxSearch'])->name('search.ajax');
Route::get('/search/doctor', [SearchController::class, 'searchDoctor'])->name('search.doctor');
Route::get('/search/clinic', [SearchController::class, 'searchClinic'])->name('search.clinic');
Route::get('/search/all', [SearchController::class, 'all'])->name('search.all');
Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointment.store');




########################################################################################
####Routes for testing purposes####

//global logout route. (Temporary, only for testing purposes)
Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');


Route::get('deletedb', [TempController::class, 'deleteDb'])->name('deletedb');



####Routes for testing purposes end####
########################################################################################
