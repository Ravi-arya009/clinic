<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MedicineMaster;
use App\Services\MedicineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class MedicineController extends Controller
{
    protected $clinicId, $medicineService;

    public function __construct(MedicineService $medicineService)
    {
        $this->medicineService = $medicineService;
        $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function index()
    {
        $medicines = $this->medicineService->getClinicMedicines($this->clinicId);
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

        $response = $this->medicineService->storeMedicine($validatedData, $this->clinicId);
        return $response;
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

        $response = $this->medicineService->updateMedicine($medicineId, $validatedData['name'], $this->clinicId);
        return $response;
    }
}
