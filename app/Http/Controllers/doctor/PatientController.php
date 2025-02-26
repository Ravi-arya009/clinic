<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use App\Models\Appointment;
use App\Models\City;
use App\Models\Patient;
use App\Models\State;
use App\Models\User;
use App\Services\DataRepositoryService;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    protected $dataRepositoryService, $patientService;

    public function __construct(
        DataRepositoryService $dataRepositoryService,
        PatientService $patientService
    ) {
        $this->dataRepositoryService = $dataRepositoryService;
        $this->patientService = $patientService;
    }
    public function index()
    {
        $patients = Appointment::where('doctor_id', auth()->guard('doctor')->user()->id)
            ->with('patient')
            ->select('id', 'patient_id', 'appointment_date')
            ->get()
            ->unique('patient_id')
            ->map(function ($appointment) {
                $data = array_merge($appointment->toArray(), $appointment->patient->toArray());
                unset($data['patient']);
                return (object) $data;
            });
        return view('doctor.patient_list', compact('patients'));
    }

    public function show(Request $request, $clinicSlug, $patientId)
    {
        $patient = Patient::where('id', $patientId)->first();
        $cities = City::where('is_active', 1)->orderBy('name', 'asc')->get();
        $states = State::where('is_active', 1)->orderBy('name', 'asc')->get();
        return view('doctor.view_patient', compact('patient', 'cities', 'states'));
    }

    public function create()
    {
        $cities = $this->dataRepositoryService->getAllCities();
        $states = $this->dataRepositoryService->getAllStates();
        return view('doctor.create_patient', compact('cities', 'states'));
    }

    public function store(StorePatientRequest $request)
    {
        $validatedData = $request->validated();
        $response = $this->patientService->store($validatedData);

        if (!$response['success']) {
            return back()->withInput()->with(['error' => $response['message']]);
        } else {
            return redirect()->route('doctor.patient.show', ['patientId' => $response['data']->id])->with('success', $response['message']);
        }
    }

    public function update(UpdatePatientRequest $request, $clinicSlug, $patientId)
    {
        $validatedData = $request->validated();
        $response = $this->patientService->update($patientId, $validatedData);

        if ($response['success'] == false) {
            return redirect()->back()->with('error', $response['message']);
        }

        return redirect()->back()->with('success', $response['message']);
    }
}
