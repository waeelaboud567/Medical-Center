<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specializations = [
            'Cardiology',
            'Dermatology',
            'Neurology',
            'Orthopedics',
            'Pediatrics',
            'Psychiatry',
            'Radiology',
            'Oncology',
            'Ophthalmology',
            'ENT',
            'Urology',
            'Gynecology',
            'General Surgery',
            'Internal Medicine',
            'Dentistry',
        ];

        for ($i = 0; $i < 15; $i++) {
            Specialization::create([
                'specialization_name'=>$specializations[$i],
                'description'=>'no description'
            ]);
        }
    }
}
