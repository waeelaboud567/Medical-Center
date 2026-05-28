<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $person_id = Person::factory()->create()->id;
        $admin = User::create([
            'user_name' => 'w116',
            'email' => 'waaelAdmin@gmail.com',
            'status' => 'active',
            'password' => Hash::make('12345678Ws'),
            'person_id' => $person_id
        ]);

        $admin->assignRole('admin');
        $person_id = Person::factory()->create()->id;

        $doctor = User::create([
            'user_name' => 'w911',
            'email' => 'waaeldoctor@gmail.com',
            'status' => 'active',
            'password' => Hash::make('12345678Ws'),
            'person_id' => $person_id
        ]);

        $doctor->assignRole('doctor');
        $person_id = Person::factory()->create()->id;

        $receptionist = User::create([
            'user_name' => 'w999',
            'email' => 'waaelreceptionist@gmail.com',
            'status' => 'active',
            'password' => Hash::make('12345678Ws'),
            'person_id' => $person_id
        ]);

        $receptionist->assignRole('employee');
    }
}
