<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ForgetPassword;
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
            'token' => $user->createToken("API TOKEN")->plainTextToken,
            'message' => 'User Logged In Successfully',
            'user' => $user,
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
        $verificationCode = mt_rand(1000, 9999);
        $codeInsert=User::where('email',$request->email)->first();
        if (!$codeInsert){
            return response()->json(['message' => 'Invalid email address Please try again'],422);
        }
//        $codeInsert->code=Hash::make($verificationCode);
        $codeInsert->code=$verificationCode;
        $codeInsert->save();

        #forget_password Email
        $codeInsert->notify(new ForgetPassword);
        return response()->json(['message' => 'User successfully sent code check it',
            'code' =>$verificationCode, ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:4',
        ]);
        $currentDate = Carbon::now('Africa/Cairo');
        $User = User::where([['email',$request->email],['code', $request->code]])->first();
        if (!$User) {
            return response()->json([
                'en' => 'Invalid verification code. Please try again.',
                'ar' => 'هذا الرمز غير صالح يرجي التحقق مره أحري',
            ]);
        }

        $token = $User->createToken("API TOKEN")->plainTextToken;

        $User->update([
            'expire_at' =>  $currentDate->addMinutes(15),
        ]);
        return response()->json([
            'en' => 'Token',
            'ar' => 'التوكـــن',
            'token' => $token,
            'expire_at' => $currentDate->addMinutes(15)
        ]);

    }
    public function confirm(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        $User =Auth::user();
//        return $User;
        if (!$User) {
            return response()->json(['message' => 'Invalid verification code. Please try again.',
                'ar' => 'هذا الرمز غير صالح يرجي التحقق مره أحري',
            ]);
        }
        // Check if the token has expired
        $expirationTime = Carbon::parse($User->expire_at);
        if ($expirationTime->isPast()) {
            return response()->json([
                'en' => 'The verification token has expired. Please request a new one.',
                'ar' => 'انتهت صلاحية الرمز. يرجى طلب رمز جديد.',
            ]);
        }

        $User->update([
            'password' => Hash::make($request->password),
            'code' =>  null,
            'expire_at' =>  null,
        ]);
        return response([
            'en' => 'Password reset successfully',
            'ar' => 'تم تغيير كلمة المرور بنجاح',
        ]);

    }
}
