<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\Auth;
class UserAuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $inputs = $request->validated();
        $user = new User();
        $user->fill($inputs);
        $user->save();
        $token = auth('users')->login($user);

        return $this->respondWithToken($token,$user);
    }


    public function login(UserLoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        
        if (! $token = auth('users')->attempt($credentials)) {
            return response()->json([
                'success'=>false,
                'message' => 'Wrong credentials provided'
            ], 401);
        }
        $user = auth('users')->user();

        return $this->respondWithToken($token, $user);
    }

    public function logout()
    {
        auth('users')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token,$user)
    {
        return response()->json([
            'success'=>true,
            'message'=>"Successfully logged in",
            "data"=>$user,
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('users')->factory()->getTTL() * 60
        ]);
    }
}
