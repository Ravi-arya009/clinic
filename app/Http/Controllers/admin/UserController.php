<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Doctor;
use App\Models\Qualification;
use App\Models\Speciality;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $clinicId;

    public function __construct()
    {
        $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function index($clinicSlug, $roleId = null)
    {
        if ($roleId && in_array($roleId, config('role'))) {
            $users = User::where('role', $roleId)
                ->where('clinic_id', $this->clinicId)
                ->orderBy('created_at', 'asc')
                ->get();
            $roleName = array_search($roleId, config('role'));
        } else {
            $users = User::orderBy('created_at', 'asc')->where('clinic_id', $this->clinicId)->get();
            $roleName = 'All Roles';
        }

        return view('admin.user_list', compact('users', 'roleName'));
    }

    public function create()
    {
        $cities = City::where('status', 1)->orderBy('name', 'asc')->get();
        $states = State::where('status', 1)->orderBy('name', 'asc')->get();
        $qualifications = Qualification::orderBy('name', 'asc')->get();
        $specialities = Speciality::where('status', 1)->orderBy('name', 'asc')->get();
        $showDoctorFields = True;
        return view('admin.create_user', compact('cities', 'states', 'qualifications', 'specialities', 'showDoctorFields'));
    }

    public function store(Request $request, $clinicSlug)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,13|unique:users,phone',
            'role' => 'required|in:1,2,3,4',
            'whatsapp' => 'nullable|digits_between:10,13|unique:users,whatsapp',
            'email' => 'nullable|email',
            'gender' => 'nullable|digits_between:1,2',
            'state' => 'nullable|exists:states,id',
            'city' => 'nullable|exists:cities,id',
            'area' => 'nullable|string|max:255',
            'speciality' => $request->role == config('role.doctor') ? 'required|exists:specialities,id' : 'sometimes',
            'qualification' => $request->role == config('role.doctor') ? 'required|exists:qualifications,id' : 'sometimes',
            'consultation_fee' => $request->role == config('role.doctor') ? 'required|numeric' : 'sometimes',
        ]);
        $user = User::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make('ravi'),
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'gender' => $request->gender,
            'role' => $request->role,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'area' => $request->area,
            'pincode' => $request->pincode,
            'address' => $request->address,
            'clinic_id' => Session::get('current_clinic')['id']
        ]);

        if ($request->role == config('role.doctor')) {
            Doctor::create([
                'user_id' => $user->id,
                'speciality_id' => $request->speciality,
                'qualification_id' => $request->qualification,
                'consultation_fee' => $request->consultation_fee
            ]);
        }

        return redirect()->route('admin.user.show', ['userId' => $user->id, 'roleId' => $request->role])->with('success', 'User registered successfully!');
    }

    public function show(Request $request, $clinicSlug, $userId)
    {
        $showDoctorFields = false;

        $roleId = $request->roleId;
        if ($roleId == config('role.doctor')) {
            $showDoctorFields = true;
            $user = User::with(
                'doctorProfile',
                'doctorProfile.speciality',
                'doctorProfile.qualification',
            )->where('id', $userId)->where('clinic_id', $this->clinicId)->firstOrFail();
            $qualifications = Qualification::orderBy('name', 'asc')->get();
            $specialities = Speciality::where('status', 1)->orderBy('name', 'asc')->get();
        } else {
            $user = User::where('id', $userId)
                ->where('clinic_id', $this->clinicId)
                ->firstOrFail();
        }
        $cities = City::where('status', 1)->orderBy('name', 'asc')->get();
        $states = State::where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.view_user', compact('user', 'cities', 'states', 'showDoctorFields') + ($showDoctorFields ? compact('qualifications', 'specialities') : []));
    }

    public function update(Request $request, $clinicSlug, $userId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,13|unique:users,phone,' . $userId,
            'whatsapp' => 'nullable|digits_between:10,13|unique:users,whatsapp,' . $userId,
            'gender' => 'nullable|digits_between:1,2',
            'email' => 'nullable|email',
            'role' => 'required|in:1,2,3,4',
        ]);

        $user = User::where('id', $userId)
            ->where('clinic_id', $this->clinicId)
            ->firstOrFail();

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->whatsapp = $request->whatsapp;
        $user->gender = $request->gender;

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully!');
    }
}
