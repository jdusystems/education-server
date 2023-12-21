<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\EmailVerification;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_role'=>$request->user_role,
        ]);

        $otp = mt_rand(100000, 999999);
        $emailVerification = new EmailVerification;
        $emailVerification->user_id = $user->id;
        $emailVerification->otp = $otp;
        $emailVerification->save();

        Mail::to($user->email)->send(new EmailVerificationMail($otp));

        return response()->json([
            'message' => 'Registration successful. Please check your email for verification.',
        ]);
    }
}
