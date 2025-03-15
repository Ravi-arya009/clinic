<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreDependantRequest;
use App\Http\Requests\User\UpdateDependantRequest;
use App\Models\dependant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class dependantController extends Controller
{
    public function index()
    {
        $patientId = Auth::guard('patients')->user()->id;
        $dependants = dependant::where('patient_id', $patientId)->get();
        return view('patient.family_members', compact('dependants'));
    }

    public function addDependant(StoreDependantRequest $request)
    {
        $validatedData = $request->validated();
        $patientId = Auth::guard('patients')->user()->id;

        $dependant = dependant::create([
            'id' => Str::uuid(),
            'patient_id' => $patientId,
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

    public function deleteDependant(Request $request)
    {
        $dependentId = $request->input('dependent_id');
        $dependant = Dependant::find($dependentId);
        if ($dependant) {
            $dependant->delete();
            return response()->json([
                'status' => 1,
                'message' => 'Dependant removed successfully'
            ]);
        }
        return response()->json([
            'status' => 1,
            'message' => 'Dependant not found'
        ], 404);
    }

    public function updateDependant(UpdateDependantRequest $request){
        $validatedData = $request->validated();
        $dependant = Dependant::findOrFail($request->input('dependent_id'));
        $dependant->name = $validatedData['dependant_name'];
        $dependant->phone = $validatedData['dependant_phone'];
        $dependant->whatsapp = $validatedData['dependant_whatsapp'] ?? null;
        $dependant->email = $validatedData['dependant_email'] ?? null;
        $dependant->dob = $validatedData['dependant_dob'] ?? null;
        $dependant->gender = $validatedData['dependant_gender'] ?? null;
        $dependant->relation = $validatedData['dependant_relation'];
        $dependant->save();
        return [
            'status' => 1,
            'dependant' => $dependant,
        ];
    }
}
