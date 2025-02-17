<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\MedicineMaster;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MedicineMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medicines = [
            'Acetaminophen',
            'Ibuprofen',
            'Aspirin',
            'Amoxicillin',
            'Azithromycin',
            'Ciprofloxacin',
            'Doxycycline',
            'Metformin',
            'Amlodipine',
            'Atorvastatin',
            'Omeprazole',
            'Simvastatin',
            'Lisinopril',
            'Losartan',
            'Metoprolol',
            'Propranolol',
            'Warfarin',
            'Prednisone',
            'Levofloxacin',
            'Citalopram',
            'Sertraline',
            'Fluoxetine',
            'Clonazepam',
            'Diazepam',
            'Alprazolam'
        ];

        $clinics = Clinic::all();

        foreach ($clinics as $clinic) {
            foreach ($medicines as $medicine) {
                MedicineMaster::create([
                    'id' => Str::uuid(),
                    'name' => $medicine,
                    'clinic_id' => $clinic->id,
                    'status' => 1,
                ]);
            }
        }
    }
}
