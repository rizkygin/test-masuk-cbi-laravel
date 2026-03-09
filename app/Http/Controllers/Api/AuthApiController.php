<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facedes\Auth;

class AuthApiController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
        return response()->json([
            'message' => 'User created successfully',
            'user' => UserResource::make($user),
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'message' => 'User logged in successfully',
            'user' => UserResource::make($user),
            'token' => $token,
        ], 200);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'User Has Been Logout Successfully'
        ], 200);
    }
}