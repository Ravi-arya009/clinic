<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use App\Http\Requests\User\StoreDependantRequest;
use App\Models\Appointment;
use App\Models\City;
use App\Models\dependant;
use App\Models\Patient;
use App\Models\State;
use App\Services\AppointmentService;
use App\Services\DataRepositoryService;
use App\Services\PatientService;
use App\Services\TimeSlotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PatientController extends Controller
{

    protected $dataRepositoryService, $patientService, $timeSlotService, $appointmentService, $clinicId;

    public function __construct(
        DataRepositoryService $dataRepositoryService,
        PatientService $patientService,
        TimeSlotService $timeSlotService,
        AppointmentService $appointmentService

    ) {
        $this->clinicId = Session::get('current_clinic')['id'];
        $this->dataRepositoryService = $dataRepositoryService;
        $this->patientService = $patientService;
        $this->timeSlotService = $timeSlotService;
        $this->appointmentService = $appointmentService;
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

    public function create(Request $request)
    {
        $phone = null;
        if ($request->phone) {
            $phone = validator(['phone' => $request->phone], ['phone' => 'required|digits_between:10,13|unique:patients,phone']);
        }

        $cities = $this->dataRepositoryService->getAllCities();
        $states = $this->dataRepositoryService->getAllStates();
        return view('doctor.create_patient', compact('cities', 'states', 'phone'));
    }

    public function store(StorePatientRequest $request)
    {
        $validatedData = $request->validated();
        $response = $this->patientService->store($validatedData);

        if (!$response['success']) {
            return back()->withInput()->with(['error' => $response['message']]);
        } else {
            $patient = $response['data'];
            $response = $this->timeSlotService->storeWalkInTimeSlot($this->clinicId, auth()->guard('doctor')->user()->id);
            $timeSlot = $response['data'];
            $response = $this->appointmentService->createWalkInAppointment($patient->id, null, auth()->guard('doctor')->user()->id, $this->clinicId, $timeSlot->id);
            if ($response) {
                $appointmentId = $response->id;
                return redirect()->route('doctor.appointment.show', ['appointmentId' => $appointmentId])->with('success', 'Appointment Created Successfully');
            }
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

    public function patientPhoneNumberCheck(Request $request)
    {
        $phone = $request->phone;
        $patient = Patient::where('phone', $phone)->first();
        if ($patient == null) {
            return 0;
        } else {
            $response = $this->patientService->fetchDependants($patient->id);
            return $response;
        }
    }

    public function createWalkInAppointment($patientId, $dependantId = null)
    {
        $response = $this->timeSlotService->storeWalkInTimeSlot($this->clinicId, auth()->guard('doctor')->user()->id);
        $timeSlot = $response['data'];
        $response = $this->appointmentService->createWalkInAppointment($patientId, $dependantId, auth()->guard('doctor')->user()->id, $this->clinicId, $timeSlot->id);
        if ($response) {
            $appointmentId = $response->id;
            return redirect(route('doctor.appointment.show', ['appointmentId' => $appointmentId]));
        }
    }


    public function addDependant(StoreDependantRequest $request)
    {
        $validatedData = $request->validated();
        $dependant = dependant::create([
            'id' => Str::uuid(),
            'patient_id' => $request->input('patientId'),
            'relation' => $validatedData['dependant_relation'],
            'name' => $validatedData['dependant_name'],
            'phone' => $validatedData['dependant_phone'],
            'whatsapp' => $validatedData['dependant_whatsapp'] ?? null,
            'email' => $validatedData['dependant_email'] ?? null,
            'dob' => $validatedData['dependant_dob'] ?? null,
            'gender' => $validatedData['dependant_gender'] ?? null,
        ]);

        if ($dependant == null) {
            return 0;
        } else {
            return [
                'status' => 1,
                'dependant' => $dependant
            ];
        }
    }
}
