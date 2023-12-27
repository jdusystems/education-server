<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Models\User;
use App\Models\EmailVerification;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function sendVerificationCode(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $otp = mt_rand(100000, 999999);
        $emailVerification = new EmailVerification;
        $emailVerification->user_id = $user->id;
        $emailVerification->otp = $otp;
        $emailVerification->save();

        Mail::to($user->email)->send(new ResetPasswordMail($otp));

        return response()->json([
            'message' => 'Verification code has been sent to your email',
        ]);
    }
}
