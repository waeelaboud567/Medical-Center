<?php

namespace App\Repo;

use App\Models\Person;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepo
{

public function register($data)
{
   $person=Person::create([
      'first_name'=>$data['first_name'],
      'last_name'=>$data['last_name'],
      'address'=>$data['address'],
      'gender'=>$data['gender'],
      'date_of_birth'=>$data['date_of_birth'],
      'phone'=>$data['phone'],
   ]);

   $user=User::create([
    'user_name'=>$data['user_name'],
    'email'=>$data['email'],
    'password'=>Hash::make($data['password']),
    'person_id'=>$person->id
   ]);
   $user->assignRole('patient');

   return [
    'person'=>$person ,
    'user'=>$user,
   ];
}

public function getUserByEmail($email)
{
    $user=User::where('email',$email)->first();
    return $user;
}
}
