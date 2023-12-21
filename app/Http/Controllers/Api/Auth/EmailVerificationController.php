<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmailVerificationController extends Controller
{
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        // Retrieve the email verification record for the user
        $verification = EmailVerification::where('otp', $request->otp)->first();

        if (!$verification) {
            return response()->json([
                'message' => 'Invalid OTP',
            ], 400);
        }

        // Check if the OTP has expired (2 minutes)
        $otpExpiration = Carbon::parse($verification->created_at)->addMinutes(2);
        if (Carbon::now()->greaterThan($otpExpiration)) {
            // Delete the email verification record and user data
            DB::transaction(function () use ($verification) {
                $verification->delete();
                $verification->user()->delete();
            });

            return response()->json([
                'message' => 'OTP has expired',
            ], 400);
        }

        // Mark the user as verified
        $user = $verification->user;
        $user->is_verified = true;
        $user->save();

        // Delete the email verification record
        $verification->delete();

        // Generate an authentication token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }
}