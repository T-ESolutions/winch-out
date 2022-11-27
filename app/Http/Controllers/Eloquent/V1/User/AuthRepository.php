<?php

namespace App\Http\Controllers\Eloquent\V1\User;

use App\Http\Controllers\Interfaces\V1\User\AuthRepositoryInterface;
use App\Models\User;
use App\Models\Verfication;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;
use JWTAuth;
use TymonJWTAuthExceptionsJWTException;
use Mail;

class AuthRepository implements AuthRepositoryInterface {

    public function logIn($request){
        $user_phone = $request->country_code . '' . $request->phone;
        $credentials = [
            'user_phone' => $user_phone,
            'password' => $request->password
        ];
        if (!$jwt_token = JWTAuth::attempt($credentials, ['exp' => Carbon::now()->addDays(7)->timestamp])) {
            return "phoneOrPasswordIncorrect";
        } else {
            $user = JWTAuth::user();
            if ($user->active == 0) {
                return "not_active";
            }
            if ($user->suspend == 1) {
                return "suspended";
            }
            $user->fcm_token = $request->fcm_token;
            $user->save();
            $user->jwt = $jwt_token;
            return $user;
        }
    }

    public function signUp($request)
    {
        $data = array_merge($request->all() , ['user_phone' => $request->country_code . '' . $request->phone]);
        $user = User::create($data);
        return $this->sendCode($user->email, "activate");
    }

    public function sendCode($email, $type)
    {
//        $code = rand(0000, 9999);
        $code = 1111;
        $verified = Verfication::updateOrcreate
        (
            [
                'phone' => $email,
                'code' => $code,
                'type' => $type,
                'expired_at' => Carbon::now()->addHour()->toDateTimeString()
            ]
        );
//        Mail::to($email)->send(new SendCode($code));
        return true;
    }

    public function resendCode($request){
        $user = User::where('email', $request->phone)->first();
        $type = $user->active == 0 ? "activate" : "reset";
        return $this->sendCode($request->phone, $type);
    }

    public function verify($request){
        $user = User::where('email', $request->phone)->first();

//        $type = $user->active == 0 ? "activate" : "reset";
        $verfication = Verfication::where('phone', $request->phone)
            ->where('code', $request->code)
//            ->where('type', $type)
            ->first();
        if ($verfication) {
            if (!$verfication->expired_at > Carbon::now()->toDateTimeString()) {
                return response()->json(msg(failed(), trans('lang.codeExpired')));
            }
            $user->active = 1;
            $user->save();
            $user->jwt = JWTAuth::fromUser($user);
            return $user;
        } else {
            return false;
        }
    }

    public function socialLogin($request)
    {

        // 1- check phone exists
//        $user = User::where('email', $request->email)->first();
//        if ($user) {
//            if ($request->social_type == 'facebook') {
//                $user->social_id = $request->social_id;
//            } else {
//                $user->social_id = $request->social_id;
//            }
//            if (empty($user->email_verified_at)) {
//                $user->email_verified_at = Carbon::now();
//            }
//            $user->email = $request->email;
//            $user->fcm_token = $request->device_token;
//            $user->save();
//            $jwt_token = JWTAuth::fromUser($user);
//            $data = (new UsersResources($user))->token($jwt_token);
//            return response()->json(msgdata($request, success(), trans('lang.success'), $data));
//        }

        // 2- check social id exists

        $userFound = User::where('social_id', $request->social_id)
            ->where('provider', $request->social_type)
            ->first();
        if ($userFound) {
//            $userFound->email = $request->email;
            $userFound->fcm_token = $request->device_token;
            $userFound->save();
            $jwt_token = JWTAuth::fromUser($userFound);
            $data = (new UsersResources($userFound))->token($jwt_token);
            return response()->json(msgdata( success(), trans('lang.success'), $data));
        }

        // 3- if not login with social before
        try {


            if ($request->social_type == 'facebook') { // facebook
                $user = User::create([
                    'social_id' => $request->social_id,
                    'fcm_token' => $request->device_token,
                    'email' => $request->email,
                    'email_verified_at' => Carbon::now(),
                    'active' => 1,
                    'provider' => 'facebook'
                ]);
            } elseif ($request->social_type == 'apple') {
                // apple
                $user = User::create([
                    'social_id' => $request->social_id,
                    'fcm_token' => $request->device_token,
                    'email' => $request->email,
                    'email_verified_at' => Carbon::now(),
                    'active' => 1,
                    'provider' => 'apple'
                ]);
            } else {
                // google
                $user = User::create([
                    'social_id' => $request->social_id,
                    'fcm_token' => $request->device_token,
                    'email' => $request->email,
                    'email_verified_at' => Carbon::now(),
                    'active' => 1,
                    'provider' => 'google'
                ]);
            }
        } catch (\Exception $e) {
            return false;
        }

        $user->jwt = JWTAuth::fromUser($user);
        return $user;

    }

    public function updateProfile($request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $request->image;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->weight = $request->weight;
        $user->height = $request->height;
        $user->phone = $request->phone;
        $user->save();
        $user->jwt = JWTAuth::fromUser($user);
        return $user;
    }

    public function changePassword($request)
    {
        $user = auth()->user();
        if ($request->old_password) {
            $old_password = Hash::check($request->old_password, $user->password);
            if ($old_password != true) {
                return response()->json(msg(failed(), trans('lang.old_passwordError')));

            }
        }
        $user->password = $request->password;
        $user->save();
        $user->jwt = JWTAuth::fromUser($user);
        return $user;
    }

}
