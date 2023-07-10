<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as RulesPassword;

class AuthController extends Controller
{
    //

    // function rgister new user
    public function register(Request $request)
    {
        $failds = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:4'],
            'phone' => ['string', 'max:25'],
            'birth_day' => 'date',
        ]);

        $failds['password'] = Hash::make($failds['password']);
        $user = User::create($failds);
        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'user' => $user,
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    }

    // function login
    public function login(Request $request)
    {
        $failds = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],

        ]);
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully',
            'user' => $user,
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    }

    // function logout
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'user logged out'
        ];
    }
    public function forgetPassword(Request $request)
    {
        $verificationCode = mt_rand(100000, 999999);
        $codeInsert=User::where('email',$request->email)->first();
        if (!$codeInsert){
            return response()->json(['message' => 'Invalid email address Please try again'],422);
        }
//        $codeInsert->code=Hash::make($verificationCode);
        $codeInsert->code=$verificationCode;
        $codeInsert->save();
        return response()->json(['message' => 'User successfully sent code check it',
            'code' =>$verificationCode, ]);
    }



    public function reset(Request $request)
    {
        $verificationCode = mt_rand(100000, 999999);
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6',
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);
        $currentDate = Carbon::today();

        $user = User::where('email', $request->email)
            ->where('code', $request->code)
            ->whereDate('created_at', $currentDate)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid verification code. Please try again.']);
        }
        $user->forceFill([
            'password' => Hash::make($request->password),
            'code' =>  Hash::make($verificationCode),
        ])->save();
        return response([
            'message' => 'Password reset successfully'
        ]);
    }


}
