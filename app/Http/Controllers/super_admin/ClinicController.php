<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinic\StoreClinicRequest;
use App\Http\Requests\Clinic\UpdateClinicRequest;
use App\Services\DataRepositoryService;
use App\Services\ClinicService;

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
        $response = $this->clinicService->storeClinic($validatedData);
        return $response['success'] ? redirect()->route('super_admin.clinic.show', $response['clinicId'])->with('success', $response['message']) : back()->withInput()->with('error', $response['message']);
    }

    public function show($clinicId)
    {
        $clinic = $this->clinicService->getClinicById($clinicId, ['admin']);
        $cities = $this->dataRepositoryService->getAllCities();
        $states = $this->dataRepositoryService->getAllStates();
        $specialities = $this->dataRepositoryService->getAllSpecialities();
        return view('super_admin.view_clinic', compact('clinic', 'cities', 'states', 'specialities'));
    }

    public function update(UpdateClinicRequest $request, $clinicId)
    {
        $validatedData = $request->validated();
        $this->clinicService->updateClinic($clinicId, $validatedData);
        return redirect()->back()->with('success', 'Clinic updated successfully!');
    }
}
