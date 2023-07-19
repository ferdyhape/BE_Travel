<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|min:2',
                'email' => 'required|email|unique:users,email,' . $request->user()->id,
                'phone_number' => 'required|string|min:10|max:13|unique:users,phone_number,' . $request->user()->id,
                'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            ]);

            $user = $request->user();
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ]);

            if ($request->hasFile('avatar')) {
                if ($user->avatar && File::exists('storage/' . $user->avatar)) {
                    File::delete('storage/'  . $user->avatar);
                }
                $avatarName = $request->file('avatar')->store('avatars', 'public');
                $user->update([
                    'avatar' => $avatarName,
                ]);
            }

            return response()->json([
                'status' => 'Success 200',
                'message' => 'Profile updated successfully',
                'user' => new UserResource($user),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Error 400',
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    // get user data
    public function me(Request $request)
    {
        try {
            $user = $request->user();

            return response()->json([
                'status' => 'Success 200',
                'message' => 'User data retrieved successfully',
                'user' => new UserResource($user),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Error 500',
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
