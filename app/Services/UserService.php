<?php

namespace App\Services;

use App\Repo\UserRepo;
use Illuminate\Http\Request;

class UserService
{

    protected UserRepo $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function getAllUsers()
    {
        $users = $this->userRepo->getAllUsers();
        return $users;
    }

    public function changeRole(int $user_id,string $role)
    {
        $this->userRepo->changeRole($user_id, $role);
    }
    public function changeStatus(int $user_id,string $status)
    {
        $this->userRepo->changeStatus($user_id, $status);
    }
    public function updateUser($data,int $user_id)
    {
        $user=$this->userRepo->updateUser($data,$user_id);
        return $user;
    }
    public function getUserByID($user_id)
    {
        $user=$this->userRepo->getUserByID($user_id);
        return $user;
    }
    public function filterUser(Request $request)
    {
        $users=$this->userRepo->filterUser($request);
        return $users;
    }
    public function destroy(int $user_id)
    {
        $this->userRepo->destroy($user_id);
    }
}
