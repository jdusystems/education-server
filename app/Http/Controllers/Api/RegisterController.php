<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFakeUserRequest;
use App\Models\FakeUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class RegisterController extends Controller
{
    public function sendSms(StoreFakeUserRequest $request)
    {
        $code = rand(100000, 999999);

        $fakeUser = FakeUser::firstOrNew([
            'phone_number' => $request->phone_number,
        ]);
        $fakeUser->name = $request->name;
        $fakeUser->role = $request->role;
        $fakeUser->password = $request->password;
        $fakeUser->code = $request->code;

        $jsonPayload = '{
            "messages": [
                {
                    "recipient": "' . $request->phone_number . '",
                    "message-id": "ress12345",
                    "sms": {
                        "originator": "3700",
                        "content": {
                            "text": "' . $code . '"
                        }
                    }
                }
            ]
        }';
        $username = env('SMS_CLIENT_USERNAME');
        $password = env('SMS_CLIENT_PASSWORD');
        $url = env('SMS_SERVICE_URL');

        try {
            Http::withBody($jsonPayload)->withBasicAuth($username, $password)->withHeaders([
                'headers' => [
                    'Accept' => 'application/json'
                ],
            ])->post($url);
            // Process the response data as needed
            return response()->json(['message' => "SMS muvaffaqiyatli jo'natildi", 'status_code' => 200]);
        } catch (\Exception $e) {
            // Handle exceptions or errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
