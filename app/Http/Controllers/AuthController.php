<?php

namespace App\Http\Controllers;

use App\Models\FakeUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'phone_number' => 'required|string|unique:users,phone_number',
            'code' => 'required|string|digits:6',
        ]);

        $fakeuser = FakeUser::where('phone_number', $request->phone_number)->first();

        if (!$fakeuser) {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
        if ($fakeuser->code != $fields['code']) {
            return response()->json([
                'message' => 'Incorrect code'
            ], 404);
        }

        $user = User::create([
            'name' => $fakeuser->name,
            'phone_number' => $fakeuser->phone_number,
            'password' => bcrypt($fakeuser->password),
        ]);

        $fakeuser->delete();

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
            'code' => 'required|string|digits:6',
        ]);

        $user = User::where('phone_number', $fields['phone_number'])->first();
        $fakeuser = FakeUser::where('phone_number', $fields['phone_number'])->first();

        if (!$user) {
            return response([
                "message" => "Phone number is wrong",
            ], 401);
        }
        if ($fakeuser->code != $fields['code']) {
            return response([
                'message' => 'Not Autorized',
            ]);
        }

        $user->update([
            "password" => bcrypt($fakeuser["password"]),
        ]);

        $fakeuser->delete();

        return response([
            "message" => "Password Updated successfully.",
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        $fields = $request->validate([
            'phone_number' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::where('phone_number', $fields['phone_number'])->first();

        if (!$user) {
            return response([
                "message" => "Phone number is wrong",
            ], 401);
        }

        $user->update([
            "password" => bcrypt($fields["password"]),
        ]);

        return response([
            "message" => "Password Updated successfully.",
        ], 200);
    }
}
