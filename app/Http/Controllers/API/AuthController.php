<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PSpell\Config;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only(['email', 'password']);
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->responseWithToken($token);
    }

    public function register(Request $request) {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        return response()->json([
            'message' => 'User registered',
            'user' => $user
        ], 201);
    }

    public function user() {
        return response()->json(auth('api')->user());
    }

    public function logout() {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh() {
        $newToken = auth('api')->refresh();

        return $this->responseWithToken($newToken);
    }

    protected function responseWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'type' => 'Bearer',
            'expires_in' => config('jwt.ttl') * 60
        ]);
    }
}