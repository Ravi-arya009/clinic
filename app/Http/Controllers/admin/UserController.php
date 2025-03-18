<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\City;
use App\Models\Patient;
use App\Models\State;
use Illuminate\Http\Request;
use App\Services\DataRepositoryService;
use App\Services\UserService;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $clinicId, $userService, $dataRepositoryService;

    public function __construct(UserService $userService, DataRepositoryService $dataRepositoryService)
    {
        $this->clinicId = Session::get('current_clinic')['id'];
        $this->userService = $userService;
        $this->dataRepositoryService = $dataRepositoryService;
    }

    public function index($clinicSlug)
    {
        $clinicUsers = $this->userService->getUsersByClinicId($this->clinicId);
        return view('admin.user_list', compact('clinicUsers'));
    }

    public function create()
    {
        $states = $this->dataRepositoryService->getAllStates();
        $cities = $this->dataRepositoryService->getAllCities();
        $qualifications = $this->dataRepositoryService->getAllQualifications();
        $specialities = $this->dataRepositoryService->getAllSpecialities();
        return view('admin.create_user', compact('states', 'cities', 'qualifications', 'specialities'));
    }

    public function store(StoreUserRequest $request, $clinicSlug)
    {
        $validatedData = $request->validated();
        $response = $this->userService->storeUser($validatedData, $this->clinicId);

        $response = $response['success'] ? [
            'success' => true,
            'message' => $response['message'],
            'redirectRoute' => route('admin.user.show', $response['data']),
        ] : [
            'success' => false,
            'message' => $response['message'],
            'error' => $response['message'],
        ];

        return response()->json($response);
    }

    public function show(Request $request, $clinicSlug, $userId)
    {
        $user = $this->userService->getClinicUserById($userId);

        if ($user->clinicRole->role_id === config('role.doctor')) {
            $user->load('doctorProfile', 'doctorProfile.speciality', 'doctorProfile.qualification');
            $qualifications = $this->dataRepositoryService->getAllQualifications();
            $specialities = $this->dataRepositoryService->getAllSpecialities();
        }

        $cities = $this->dataRepositoryService->getAllCities();
        $states = $this->dataRepositoryService->getAllStates();

        return view(
            'admin.view_user',
            compact('user', 'cities', 'states') + ($user->clinicRole->role_id === config('role.doctor') ? compact('qualifications', 'specialities') : [])
        );
    }

    public function update(UpdateUserRequest $request, $clinicSlug, $userId)
    {
        $validatedData = $request->validated();
        // dd($validatedData);
        $response = $this->userService->updateUser($userId, $validatedData);

        if ($response['success'] == false) {
            return redirect()->back()->with('error', $response['message']);
        }
        return redirect()->back()->with('success', $response['message']);
    }

    public function createPatient()
    {
        $cities = $this->dataRepositoryService->getAllCities();
        $states = $this->dataRepositoryService->getAllStates();
        return view('admin.create_patient', compact('cities', 'states'));
    }

    public function storePatient(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,13|unique:' . 'patients' . ',phone',
            'whatsapp' => 'required|digits_between:10,13|unique:' . 'patients' . ',whatsapp',
            'email' => 'nullable|email',
            'gender' => 'nullable|digits_between:1,2',
            'state' => 'nullable|exists:states,id',
            'city' => 'nullable|exists:cities,id',
            'area' => 'nullable|string|max:255',
            'pincode' => 'nullable|digits_between:5,10',
            'address' => 'nullable|string|max:500',
        ]);

        $response = $this->userService->storePatient($validatedData);
        if (!$response['success']) {
            return back()->withInput()->with(['error' => $response['message']]);
        } else {
            return redirect()->route('admin.patient.show', ['patientId' => $response['data']->id])->with('success', $response['message']);
        }
    }

    public function showPatient(Request $request, $clinicSlug, $patientId)
    {
        $user = Patient::where('id', $patientId)->firstOrFail();
        $cities = City::where('status', 1)->orderBy('name', 'asc')->get();
        $states = State::where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.view_patient', compact('user', 'cities', 'states'));
    }
}
