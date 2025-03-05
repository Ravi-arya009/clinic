<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //helper function to transform the doctors collection
    protected function doctorTransformer($doctors)
    {
        $doctors->transform(function ($doctor) {
            $doctor->speciality = $doctor->doctorProfile->speciality;
            unset($doctor->doctorProfile->speciality);
            return $doctor;
        });
    }
    // function for ajax search
    public function ajaxSearch(Request $request)
    {
        $searchString = $request->search_string;
        $searchCity = $request->search_city;
        $clinics = Clinic::select('id', 'name')
            ->where('name', 'like', "%{$searchString}%")
            ->when($searchCity, function ($query, $searchCity) {
                return $query->where('city_id', $searchCity);
            })->limit(5)
            ->get();

        $doctors = User::select('users.id', 'users.name')
            ->join('clinic_users', 'users.id', '=', 'clinic_users.user_id')
            ->where('users.name', 'like', "%{$searchString}%")
            ->where('clinic_users.role_id', config('role.doctor'))
            ->when($searchCity, function ($query, $searchCity) {
                return $query->where('users.city_id', $searchCity);
            })
            ->limit(5)
            ->get();

        return compact(['clinics', 'doctors']);
    }

    public function all(Request $request)
    {
        $searchString = $request->search_string;
        $searchCity = $request->city;

        $clinics = Clinic::select('id', 'name', 'area', 'city_id', 'speciality_id')->with(['city', 'speciality'])
            ->where('name', 'like', "%{$searchString}%")
            ->when($searchCity, function ($query, $searchCity) {
                return $query->where('city_id', $searchCity);
            })->limit(5)->get();

        $doctors = User::with('doctorProfile.speciality',)->select('id', 'name', 'area', 'city_id', 'profile_image')
            ->where('name', 'like', "%{$searchString}%")
            ->where('role_id', config('role.doctor'))
            ->when($searchCity, function ($query, $searchCity) {
                return $query->where('city_id', $searchCity);
            })->limit(5)->get();

        //transforming the collection for easy integration with frontend
        $this->doctorTransformer($doctors);

        return view('guest.search', compact(['clinics', 'doctors']));
    }
    public function searchDoctor()
    {
        $doctors = User::where('role_id', config('role.doctor'))
            ->with(['city', 'doctorProfile.speciality'])
            ->limit(10)
            ->get();

        //transforming the collection for easy integration with frontend
        $this->doctorTransformer($doctors);

        return view('guest.search_doctor', compact('doctors'));
    }
    public function searchClinic(Request $request)
    {
        $specialities = Speciality::all();
        $query = Clinic::query()->with('speciality');
        if ($request->has('select_specialist')) {
            $query->whereIn('speciality_id', $request->select_specialist);
        }
        $query->limit(10);
        $clinics = $query->get();

        return view('guest.search_clinic', compact('clinics', 'specialities'));
    }
}
