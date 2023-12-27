<?php
namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerificationCodeRequest;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\DB;

class VerificationCodeController extends Controller
{
    public function verify(VerificationCodeRequest $request)
    {
        $code = $request->code;

        $emailVerification = EmailVerification::where('otp', $code)->latest()->first();

        if (!$emailVerification) {
            return response()->json(['message' => 'Invalid verification code'], 400);
        }

        // Verification code is valid, you can proceed with your desired logic
        // For example, redirect the user to a password reset form

        return response()->json(['message' => 'Verification code is valid']);
    }
}