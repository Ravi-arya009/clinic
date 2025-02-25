<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\City;
use App\Models\ClinicUser;
use App\Models\Patient;
use App\Models\Qualification;
use App\Models\Speciality;
use App\Models\State;
use Illuminate\Http\Request;
use App\Models\User;
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

    public function index($clinicSlug, $roleId = null)
    {
        $clinicUsers = ClinicUser::with('user')->where('clinic_id', $this->clinicId)->get();
        return view('admin.user_list', compact('clinicUsers'));
    }

    public function create()
    {
        $cities = $this->dataRepositoryService->getAllCities();
        $states = $this->dataRepositoryService->getAllStates();
        $qualifications = $this->dataRepositoryService->getAllQualifications();
        $specialities = $this->dataRepositoryService->getAllSpecialities();
        $showDoctorFields = True;
        return view('admin.create_user', compact('cities', 'states', 'qualifications', 'specialities', 'showDoctorFields'));
    }

    public function store(StoreUserRequest $request, $clinicSlug)
    {
        $validatedData = $request->validated();

        $response = $this->userService->storeUser($validatedData, $this->clinicId);

        if (!$response['success']) {
            return back()->withInput()->with(['error' => $response['message']]);
        } else {
            return redirect()->route('admin.user.show', ['userId' => $response['data']->id, 'roleId' => $response['data']->role])->with('success', $response['message']);
        }
    }

    public function show(Request $request, $clinicSlug, $userId)
    {
        $showDoctorFields = false;
        // check if belongs to clinic. can make a helper function in user servie isClinicUser().
        //use userService
        $user = User::with('clinicRole')->where('id', $userId)->firstOrFail();

        //using first because currently there;s only one role per user. when the roles per user increase loops will be used.`
        $user->clinicRole = $user->clinicRole->first();
        if ($user->clinicRole->role_id === config('role.doctor')) {
            $user->load('doctorProfile', 'doctorProfile.speciality', 'doctorProfile.qualification');
            $qualifications = $this->dataRepositoryService->getAllQualifications();
            $specialities = $this->dataRepositoryService->getAllSpecialities();
            $showDoctorFields = true;
        }

        $cities = $this->dataRepositoryService->getAllCities();
        $states = $this->dataRepositoryService->getAllStates();

        return view('admin.view_user', compact('user', 'cities', 'states', 'showDoctorFields') + ($showDoctorFields ? compact('qualifications', 'specialities') : []));
    }

    public function update(Request $request, $clinicSlug, $userId)
    {
        $userRoleId = $request->userRoleId;
        $user = User::where('id', $userId)->firstOrFail();

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->whatsapp = $request->whatsapp;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->state_id = $request->state;
        $user->city_id = $request->city;
        $user->address = $request->address;
        $user->pincode = $request->pincode;

        $user->save();
        if ($userRoleId == config('role.doctor')) {
            dd('doctor');
        }

        return redirect()->back()->with('success', 'User updated successfully!');
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
