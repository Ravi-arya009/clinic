<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Clinic;
use App\Models\Speciality;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClinicController extends Controller
{
    public function create()
    {
        $cities = City::where('status', 1)->orderBy('name', 'asc')->get();
        $states = State::where('status', 1)->orderBy('name', 'asc')->get();
        $specialities = Speciality::where('status', 1)->orderBy('name', 'asc')->get();
        return view('super_admin.create_clinic', compact('cities', 'states', 'specialities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:clinics,slug,',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', // extra slug specific rules
            ],
            'state' => 'nullable|exists:states,id',
            'city' => 'nullable|exists:cities,id',
            'speciality' => 'nullable|exists:specialities,id',
            'area' => 'nullable|string|max:255',
            'phone' => 'nullable|digits_between:10,13|unique:clinics,phone',
            'contact_person' => 'nullable|string|max:255',
            'contact_person_phone' => 'nullable|digits_between:10,13|unique:clinics,contact_person_phone',
            'admin_name' => 'required|string|max:255',
            'admin_phone' => 'required|digits_between:10,13|unique:users,phone',

        ]);

        // both clinic and admin transaction should succeed or both should fail, hence a try catch block with db transaction.
        DB::beginTransaction();

        try {
            $clinic = Clinic::create([
                'id' => Str::uuid(),
                'name' => $request->name,
                'slug' => $request->slug,
                'phone' => $request->phone,
                'contact_person' => $request->contact_person,
                'contact_person_phone' => $request->contact_person_phone,
                'state_id' => $request->state,
                'city_id' => $request->city,
                'address' => $request->address,
                'area' => $request->area,
                'speciality_id' => $request->speciality,

            ]);
            // storing the admin's details in users table
            User::create([
                'id' => Str::uuid(),
                'name' => $request->admin_name,
                'phone' => $request->admin_phone,
                'password' => Hash::make('ravi'),
                'role' => config('role.admin'),
                'clinic_id' => $clinic->id,
            ]);

            DB::commit();

            return redirect()->route('super_admin.clinic.show', ['clinicId' => $clinic->id])->with('success', 'Clinic registered successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something Went wrong');
        }
    }

    public function index()
    {
        $clinics = Clinic::orderBy('created_at', 'asc')->get();
        $clinicCount = $clinics->count();
        $cities = City::where('status', 1)->orderBy('name', 'asc')->get();
        return view('super_admin.clinic_list', compact('clinics', 'clinicCount', 'cities'));
    }

    public function show($clinicId)
    {
        $clinic = Clinic::with('admin')->findorFail($clinicId);
        $cities = City::where('status', 1)->orderBy('name', 'asc')->get();
        $states = State::where('status', 1)->orderBy('name', 'asc')->get();
        $specialities = Speciality::where('status', 1)->orderBy('name', 'asc')->get();
        return view('super_admin.view_clinic', compact('clinic', 'cities', 'states', 'specialities'));
    }

    public function update(Request $request, $clinicId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:clinics,slug,' . $clinicId, // Ensures uniqueness while updating
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', // extra slug specific rules
            ],
            'city' => 'exists:cities,id',
            'state' => 'exists:states,id',
            'speciality' => 'exists:specialities,id',
            'area' => 'nullable|string|max:255',
            'phone' => 'nullable|digits_between:10,13|unique:clinics,phone,' . $clinicId,
            'contact_person' => 'nullable|string|max:255',
            'contact_person_phone' => 'nullable|digits_between:10,13|unique:clinics,contact_person_phone,' . $clinicId,
            'admin_name' => 'required|string|max:255',
            'admin_phone' => 'required|digits_between:10,13|unique:users,phone,' . $request->admin_id,
        ]);

        $clinic = Clinic::findorFail($clinicId);

        $clinic->name = $request->name;
        $clinic->slug = $request->slug;
        $clinic->phone = $request->phone;
        $clinic->contact_person = $request->contact_person;
        $clinic->contact_person_phone = $request->contact_person_phone;
        $clinic->state_id = $request->state;
        $clinic->city_id = $request->city;
        $clinic->address = $request->address;
        $clinic->area = $request->area;
        $clinic->speciality_id = $request->speciality;
        $clinic->save();

        //updating admin
        $admin = User::findorFail($request->admin_id);
        $admin->name = $request->admin_name;
        $admin->phone = $request->admin_phone;
        $admin->save();

        return redirect()->back()->with('success', 'Clinic updated successfully!');
    }
}
