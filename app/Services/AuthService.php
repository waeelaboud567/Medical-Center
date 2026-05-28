<?php

namespace App\Services;

use App\Repo\AuthRepo;

class AuthService
{
protected AuthRepo $authRepo;

    public function __construct(AuthRepo $authRepo)
    {
           $this->authRepo=$authRepo;
    }

    public function register($data)
    {
        $registerData=$this->authRepo->register($data);

        $user=$registerData['user'];
        $user->assignRole('employee');
        $token=$user->createToken('auth_token')->plainTextToken;
        $registerData['token']=$token;

        return $registerData;
    }

    public function getUserByEmail($email)
    {
        $user=$this->authRepo->getUserByEmail($email);
        return $user;
    }

}
