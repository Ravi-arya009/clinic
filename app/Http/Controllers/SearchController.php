<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $searchString = $request->search_string;
        $searchCity = $request->search_city;
        $clinics = Clinic::select('id', 'name')
            ->where('name', 'like', "%{$searchString}%")
            ->when($searchCity, function ($query, $searchCity) {
                return $query->where('city', $searchCity);
            })->limit(5)
            ->get();

        $doctors = User::select('id', 'name')
            ->where('name', 'like', "%{$searchString}%")
            ->where('role', config('role.doctor'))->limit(5)->get();

        return compact(['clinics', 'doctors']);
    }

    public function searchDoctor(){
        $doctors = User::where('role', config('role.doctor'))->limit(10)->get();
        return view('guest.search_doctor',compact('doctors'));
    }
    public function searchClinic(Request $request)
    {

        $specialities = Speciality::all();

        $query = Clinic::query();
        if ($request->has('select_specialist')) {
            $query->whereIn('speciality_id', $request->select_specialist);
        }
        $query->limit(10);
        $clinics = $query->get();


        return view('guest.search_clinic', compact('clinics','specialities'));
    }

}
