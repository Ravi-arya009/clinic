<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MedicineMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class MedicineController extends Controller
{
    protected $clinicId;

    public function __construct()
    {
        $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function index()
    {
        $medicines = MedicineMaster::where('clinic_id', $this->clinicId)->get();
        return view('admin.medicines', compact('medicines'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'medicineName' => [
                'required',
                'string',
                'max:255',
                Rule::unique('medicine_masters', 'name')
                    ->where('clinic_id', $this->clinicId)
            ],
        ]);
        $medicineMAster = MedicineMaster::create([
            'name' => ucfirst($validatedData['medicineName']),
            'clinic_id' => $this->clinicId
        ]);
        return $medicineMAster;
    }

    public function update(Request $request, $clinicSlug, $medicineId)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('medicine_masters', 'name')
                    ->where('clinic_id', $this->clinicId)
                    ->ignore($medicineId)
            ],
        ]);
        $medicine = MedicineMaster::where('id', $medicineId)
            ->where('clinic_id', $this->clinicId)
            ->firstOrFail();

        $medicine->name = $validatedData['name'];
        $medicine->save();

        return 'saved';
    }
}
