<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string|unique:users,phone_number',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'phone_number' => $fields['phone_number'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'phone_number' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('phone_number', $fields['phone_number'])->first();

        if (!$user || !Hash::check($fields["password"], $user->password)) {
            return response([
                "message" => "Username or Password is wrong",
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out',
        ];
    }

    public function forgotPassword(Request $request)
    {
        $fields = $request->validate([
            'phone_number' => 'required|string',
            'new_password' => 'required|string|confirmed',
        ]);

        $user = User::where('phone_number', $fields['phone_number'])->first();

        if (!$user) {
            return response([
                "message" => "Phone number is wrong",
            ], 401);
        }

        $user->update([
            "password" => bcrypt($fields["new_password"]),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response(null, 200);
    }

    public function resetPassword(Request $request)
    {
        $fields = $request->validate([
            'phone_number' => 'required|string',
            'new_password' => 'required|string|confirmed',
        ]);

        $user = User::where('phone_number', $fields['phone_number'])->first();

        if (!$user) {
            return response([
                "message" => "Phone number is wrong",
            ], 401);
        }

        $user->update([
            "password" => bcrypt($fields["new_password"]),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response(null, 200);
    }
}
