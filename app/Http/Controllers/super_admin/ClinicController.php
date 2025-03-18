<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinic\StoreClinicRequest;
use App\Http\Requests\Clinic\UpdateClinicRequest;
use App\Models\ClinicWorkingHour;
use App\Services\DataRepositoryService;
use App\Services\ClinicService;
use DateTime;

class ClinicController extends Controller
{
    protected $clinicService, $userService, $dataRepositoryService;

    public function __construct(
        ClinicService $clinicService,
        DataRepositoryService $dataRepositoryService
    ) {
        $this->clinicService = $clinicService;
        $this->dataRepositoryService = $dataRepositoryService;
    }

    public function index()
    {
        $clinics = $this->clinicService->getAllClinics();
        $cities = $this->dataRepositoryService->getAllCities();
        return view('super_admin.clinic_list', compact('clinics', 'cities'));
    }

    public function create()
    {
        $cities = $this->dataRepositoryService->getAllCities();
        $states = $this->dataRepositoryService->getAllStates();
        $specialities = $this->dataRepositoryService->getAllSpecialities();
        return view('super_admin.create_clinic', compact('cities', 'states', 'specialities'));
    }

    public function store(StoreClinicRequest $request)
    {
        $validatedData = $request->validated();
        $clinic_working_hours =  json_decode($validatedData['clinic_working_hours']);
        $response = $this->clinicService->storeClinic($validatedData);
        $this->clinicService->storeClinicWorkingHours($response['clinicId'], $clinic_working_hours);

        $response = $response['success'] ? [
            'success' => true,
            'message' => $response['message'],
            'redirectRoute' => route('super_admin.clinic.show', $response['clinicId']),
        ] : [
            'success' => false,
            'message' => $response['message'],
            'error' => $response['message'],
        ];
        session()->flash('success', $response['message']);
        return response()->json($response);
    }

    public function show($clinicId)
    {
        $clinic = $this->clinicService->getClinicById($clinicId, ['admins', 'WorkingHours']);
        $ClinicWorkingHours = $clinic->WorkingHours->groupBy('day')->map(function ($dayGroup) {
            return $dayGroup->groupBy('shift');
        });
        $cities = $this->dataRepositoryService->getAllCities();
        $states = $this->dataRepositoryService->getAllStates();
        $specialities = $this->dataRepositoryService->getAllSpecialities();
        return view('super_admin.view_clinic', compact('clinic', 'cities', 'states', 'specialities', 'ClinicWorkingHours'));
    }

    public function update(UpdateClinicRequest $request, $clinicId)
    {
        $validatedData = $request->validated();
        $clinic_working_hours =  json_decode($validatedData['clinic_working_hours']);
        $response = $this->clinicService->updateClinic($clinicId, $validatedData);
        $this->clinicService->storeClinicWorkingHours($clinicId, $clinic_working_hours);
        $response = $response['success'] ? [
            'success' => true,
            'message' => $response['message'],
        ] : [
            'success' => false,
            'message' => $response['message'],
            'error' => $response['message'],
        ];
        return response()->json($response);
    }
}
