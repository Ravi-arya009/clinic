<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Services\ClinicService;
use App\Services\DataRepositoryService;
use App\Services\DoctorService;
use App\Services\PatientService;

class DashboardController extends Controller
{

    protected $clinicService, $DoctorService, $PatientService, $dataRepositoryService;

    public function __construct(
        ClinicService $clinicService,
        DoctorService $DoctorService,
        PatientService $PatientService,
        DataRepositoryService $dataRepositoryService
    ) {
        $this->clinicService = $clinicService;
        $this->DoctorService = $DoctorService;
        $this->PatientService = $PatientService;
        $this->dataRepositoryService = $dataRepositoryService;
    }
    public function dashboard()
    {
        $recentClinics = $this->clinicService->getRecentClinics();
        $totalClinics = $this->clinicService->getClinicCount();
        $totalDoctors = $this->DoctorService->getDoctorCount();
        $totalPatients = $this->PatientService->getPatientCount();
        return view('super_admin.dashboard', compact('recentClinics', 'totalClinics', 'totalDoctors', 'totalPatients'));
    }
}
