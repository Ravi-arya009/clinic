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
        $response = $this->clinicService->getAllClinics();
        return view('super_admin.clinic_list', [
            'clinics' => $response['data']['clinics'],
            'totalClinics' => $response['data']['totalClinics']
        ]);
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
        if ($response['success']) {
            session()->flash('success', $response['message']);
        }
        return response()->json($response);
    }

    public function show($clinicId)
    {
        $response = $this->clinicService->getClinicById($clinicId);
        if (!$response['success']) {
            abort(404);
        }
        $clinic = $response['data']['clinic'];
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
        // dd($request);
        $validatedData = $request->validated();
        $response = $this->clinicService->updateClinic($clinicId, $validatedData);
        return response()->json($response);
    }
}
