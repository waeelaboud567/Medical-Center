<?php

namespace App\Repo;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserRepo
{

    public function getAllUsers()
    {
        $users = User::all();

        return $users;
    }

    public function changeRole(int $user_id, string $role)
    {

        $user = User::findOrFail($user_id);
        $user->syncRoles([$role]);
    }

    public function changeStatus(int $user_id, string $status)
    {

        $user = User::findOrFail($user_id);
        if (!$user->hasRole('admin')) {
            $user->update(['status' => $status]);
        } else {
            throw new Exception('Admin status cannot be changed.');
        }
    }

    public function updateUser(array $data, int $user_id): User
    {
        $user = User::with('person')->indOrFail($user_id);

        $userData = [];

        if (isset($data['user_name'])) {
            $userData['user_name'] = $data['user_name'];
        }

        if (isset($data['email'])) {
            $userData['email'] = $data['email'];
        }

        if (!empty($userData)) {
            $user->update($userData);
        }

        $personData = [];

        if (isset($data['first_name'])) {
            $personData['first_name'] = $data['first_name'];
        }

        if (isset($data['last_name'])) {
            $personData['last_name'] = $data['last_name'];
        }

        if (isset($data['address'])) {
            $personData['address'] = $data['address'];
        }

        if (isset($data['phone'])) {
            $personData['phone'] = $data['phone'];
        }

        if (isset($data['gender'])) {
            $personData['gender'] = $data['gender'];
        }

        if (isset($data['date_of_birth'])) {
            $personData['date_of_birth'] = $data['date_of_birth'];
        }

        if (!empty($personData)) {
            $user->person->update($personData);
        }

        return $user;
    }
    public function getUserByID(int $user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            return $user;
        } catch (Exception $e) {
            throw new Exception("not found");
        }
    }
    public function filterUser(Request $request)
    {
        $query = User::query();

        if ($request->first_name) {
            $query->whereHas('person', function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->first_name . '%');
            });
        }

        if ($request->last_name) {
            $query->whereHas('person', function ($q) use ($request) {
                $q->where('last_name', 'like', '%' . $request->last_name . '%');
            });
        }

        if ($request->phone) {
            $query->whereHas('person', function ($q) use ($request) {
                $q->where('phone', 'like', '%' . $request->phone . '%');
            });
        }

        if ($request->email) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->user_name) {
            $query->where('user_name', 'like', '%' . $request->user_name . '%');
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        return $query->get();
    }

    public function destroy($user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            $user->delete();
        } catch (Exception $e) {
            throw new Exception("deleted user failed");
        }
    }
}
