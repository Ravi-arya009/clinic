<?php

namespace Database\Seeders;

use App\Models\Qualification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $qualifications = [
            'MBBS',
            'BDS',
            'BAMS',
            'BHMS',
            'BUMS',
            'BNYS',
            'BPT',
            'MD',
            'MS',
            'MDS',
            'DNB',
            'DM',
            'MCh',
            'Fellowship',
            'PhD'
        ];

        foreach ($qualifications as $qualification) {
            Qualification::create([
                'id' => Str::uuid(),
                'name' => $qualification,
            ]);
        }
    }
}
