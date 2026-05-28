<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
           $this->authService=$authService;
    }

    public function register(RegisterRequest $req)
    {
            $validation=$req->validated();

            $registerData=$this->authService->register($validation);

            return [
                'message'=>'register successfully',
                'user'=>new UserResource($registerData['user']),
                'token'=>$registerData['token']
            ];
    }

    public function login(UserRequest $request)
    {
           $validation=$request->validated();

           if(!Auth::attempt(['email' => $validation['email'], 'password' => $validation['password']]))
            {
                    return response()->json(["message"=>"email or password is unvalild"], 401);
            }
            $user=$this->authService->getUserByEmail($validation['email']);
            $token=$user->createToken('auth_token')->plainTextToken;

            return response()->json([
                "message"=>"login successfully",
                "user"=>new UserResource($user),
                "token"=>$token
            ],200);
    }

    public function logout()
    {
        $user=Auth::user();
        $user->currentAccessToken()->delete();
        return response()->json([
                "message"=>"logout successfully",
            ],200);
    }

}
