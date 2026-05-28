<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\StatusUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;
    protected AuthService $authService;

    public function __construct(UserService $userService, AuthService $authService)
    {
        $this->userService = $userService;
        $this->authService = $authService;
    }

    public function store(RegisterRequest $request)
    {
        $validation = $request->validated();

        $user_info = $this->authService->register($validation);

        return response()->json([
            "message" => "Add User Successfully",
            "user_info" => $user_info
        ], 201);
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();

        return response()->json([
            'users_info' => UserResource::collection($users),
        ], 200);
    }

    public function changeRole(int $user_id, RoleRequest $request)
    {
        $validation = $request->validated();

        $this->userService->changeRole($user_id, $validation['role']);

        return response()->json([
            'message' => 'Role Changed Successfully'
        ], 200);
    }
    public function changeStatus(int $user_id, StatusUserRequest $request)
    {
        $validation = $request->validated();

        $this->userService->changeStatus($user_id, $validation['status']);

        return response()->json([
            'message' => 'status Changed Successfully'
        ], 200);
    }
    public function update(UpdateUserRequest $request,$user_id)
    {
       $validation=$request->validated();
       $user=$this->userService->updateUser($validation,$user_id);

       return response()->json([
        'message'=>"Update User Successfully",
        'user_info'=>new UserResource($user)
       ], 201,);
    }

    public function show(int $user_id)
    {
        $user=$this->userService->getUserByID($user_id);
        return $user;
    }

    public function filterUser(Request $request)
    {
        $users=$this->userService->filterUser($request);
        return response()->json([
            'users'=>UserResource::collection($users)
        ],200);
    }

    public function destroy(int $user_id)
    {
        $this->userService->destroy($user_id);
        return response()->json([
            'users'=>'deleted user successfully'
        ],204);
    }
}
