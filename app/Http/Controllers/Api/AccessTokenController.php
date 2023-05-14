<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccessTokenController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $device_name = $request->post('device_name', $request->userAgent());
            $token = $user->createToken($device_name);
            return \Illuminate\Support\Facades\Response::json([
                'token' => $token->plainTextToken,
                'user' => $user,
            ], 201);
        }
        return \Illuminate\Support\Facades\Response::json([
            'code' => 0,
            'message' => 'invaled credentioal'
        ], 401);


    }



    public function destroy($token = null)
    {
        $user = Auth::guard('sanctum')->user();
        if (null == $token) {
            $user->currentAccessToken()->delete();
            return \Illuminate\Support\Facades\Response::json([
                'masege'=>' Access Token Delete'
            ],200);
        }
//        $personalaccesstoken=PersonalAccessToken::findToken($token);
//        if ($user->id == $personalaccesstoken->tokenable_id && get_class($user) == $personalaccesstoken->tokenable_type) {
//            $personalaccesstoken->delete();
//
//        }
        $user->tokens()->where('token', $token)->delete();


    }

}
