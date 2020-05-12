<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Frankyso\Tokopedia\Selenium\TokopediaLogin;
use Frankyso\Tokopedia\TokopediaManager;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request, TokopediaManager $tokopedia)
    {
        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        $uuid = Str::uuid()->toString();
        $tokopedia = new TokopediaLogin($request->only(["email", "password"]), $uuid);
        $tokopedia->execute();
        return response()->json([
            "responseCode" => "00",
            "responseMessage" => "",
            "responsePayload" => [
                "browserId" => $uuid,
                "next" => url('login-otp')
            ]
        ]);
    }

    public function otp(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        return $request->json([
            "next" => route('')
        ]);
    }
}
