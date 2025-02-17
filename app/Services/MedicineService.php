<?php

namespace App\Services;

use App\Models\MedicineMaster;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class MedicineService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getClinicMedicines($clinicId)
    {
        $medicines = MedicineMaster::where('clinic_id', $clinicId)->orderBy('created_at', 'Desc')->get();
        return $medicines;
    }

    public function storeMedicine($data, $clinicId)
    {
        try {
            MedicineMaster::create([
                'name' => ucfirst($data['medicineName']),
                'clinic_id' => $clinicId
            ]);
            return [
                'success' => true,
                'message' => 'Medicine created successfully'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'An error occurred while creating the medicine',
                'error' => $e->getMessage()
            ];
        }
    }

    public function updateMedicine($medicineId, $medicineName, $clinicId)
    {
        try {
            $medicine = MedicineMaster::where('id', $medicineId)
                ->where('clinic_id', $clinicId)
                ->firstOrFail();

            $medicine->name = $medicineName;
            $medicine->save();

            return [
                'success' => true,
                'message' => 'Medicine updated successfully'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'An error occurred while updating the medicine',
                'error' => $e->getMessage()
            ];
        }
    }
}
