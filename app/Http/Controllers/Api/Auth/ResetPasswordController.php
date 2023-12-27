<?php

// ResetPasswordController.php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function reset(ResetPasswordRequest $request)
    {
        $email = $request->email;
        $password = $request->password;

        // Find the user by email
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user's password
        $user->password = Hash::make($password);
        $user->save();

        return response()->json(['message' => 'Password reset successful']);
    }
}