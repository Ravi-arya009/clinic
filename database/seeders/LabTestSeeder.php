<?php

namespace Database\Seeders;

use App\Models\LabTestMaster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class LabTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labTests = [
            'Complete Blood Count (CBC)',
            'Blood Chemistry Tests (BCT)',
            'Liver Function Tests (LFT)',
            'Kidney Function Tests (KFT)',
            'Electrolyte Panel (EP)',
            'Glucose Test',
            'Cholesterol Test',
            'Triglycerides Test',
            'Hemoglobin A1c (HbA1c) Test',
            'Thyroid Function Tests (TFT)',
            'Urinalysis (UA)',
            'Stool Test',
            'Pregnancy Test',
            'HIV Test',
            'Chest X-ray',
            'Electrocardiogram (ECG)',
            'Ultrasound',
            'Mammography',
            'Pap Smear',
            'Prostate-Specific Antigen (PSA) Test',
            'Bone Density Test',
            'Lipid Profile',
            'C-Reactive Protein (CRP) Test',
            'Erythrocyte Sedimentation Rate (ESR) Test',
            'Blood Culture',
            'Urine Culture',
            'Stool Culture'
        ];

        foreach ($labTests as $test) {
            LabTestMaster::create([
                'id' => Str::uuid(),
                'name' => $test,
            ]);
        }
    }
}
