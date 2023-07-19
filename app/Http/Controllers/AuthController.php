<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // login process
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['Email or password is incorrect'],
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => 'Success 200',
                'message' => 'Login success',
                'token' => $token,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Error 401',
                'message' => "Email or password is incorrect",
            ], 401);
        }
    }

    // register process
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|min:2',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
                'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            ]);

            if ($request->hasFile('avatar')) {
                $avatarName = $request->file('avatar')->store('avatars', 'public');
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'avatar' => $avatarName ?? null,
            ]);

            return response()->json([
                'status' => 'Success 201',
                'message' => 'User created successfully',
                'user' => new UserResource($user),
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Error 400',
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    // logout process
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => 'Success 200',
                'message' => 'Logout success',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Error 500',
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
