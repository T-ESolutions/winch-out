<?php

namespace App\Http\Controllers\Eloquent\V1\User;

use App\Http\Controllers\Interfaces\V1\User\AuthRepositoryInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;
use JWTAuth;
use TymonJWTAuthExceptionsJWTException;
use Mail;

class AuthRepository implements AuthRepositoryInterface {

    public function login($request){
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


}
