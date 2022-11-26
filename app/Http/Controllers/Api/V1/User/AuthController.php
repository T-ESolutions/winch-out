<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\V1\User\AuthRepositoryInterface;
use App\Http\Resources\V1\User\UsersResources;
use App\Mail\SendCode;
use App\Models\User;
use App\Models\Verfication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use JWTAuth;
use TymonJWTAuthExceptionsJWTException;
use Mail;

class AuthController extends Controller
{
    protected $userAuthRepository;

    public function __construct( AuthRepositoryInterface $userAuthRepository)
    {
        $this->userAuthRepository = $userAuthRepository;
    }
    public function unauthrized(Request $request)
    {
        return response()->json(msg(not_authoize(), trans('lang.not_authorize')));
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $data['user_phone'] = $request->country_code . '' . $request->phone;
        $validator = Validator::make($data, [
            'country_code' => 'required', //+20
            'user_phone' => 'required|exists:users,user_phone',
            'password' => 'required|min:6',
            'fcm_token' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
        $data = $this->userAuthRepository->login($request);
        if(is_string($data)){
            if($data == "phoneOrPasswordIncorrect"){
                return response()->json(msg(failed(), trans('lang.phoneOrPasswordIncorrect')));
            }elseif($data = "not_active"){
                return response()->json(msg(failed(), trans('lang.not_active')));
            }elseif($data = "suspended"){
                return response()->json(msg(failed(), trans('lang.suspended')));
            }
        }else{
            $data = (new UsersResources($data))->token($data->jwt);
            return response()->json(msgdata(success(), trans('lang.success'), $data));
        }
    }


    public function SignUp(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
//            'phone' => 'required|min:12|regex:/(966)[0-9]{8}/',
            'image' => 'nullable',
            'name' => 'required|string|max:255',
            'country_code' => 'required',
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'device_token' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
        $data['user_phone'] = $request->country_code . '' . $request->phone;
        $user = User::create($data);
        $this->sendCode($user->email, "activate");

        return response()->json(msg(success(), trans('lang.CodeSent')));

    }

    public function ForgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'phone' => 'required|min:12|regex:/(966)[0-9]{8}/',
            'phone' => 'required|email|exists:users,email',

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }

        $this->sendCode($request->phone, "reset");

        return response()->json(msg(success(), trans('lang.CodeSent')));

    }

    public function changePassword(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
            'old_password' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }

        $user = auth()->user();
        if ($request->old_password) {
            $old_password = Hash::check($request->old_password, $user->password);
            if ($old_password != true) {
                return response()->json(msg(failed(), trans('lang.old_passwordError')));

            }
        }
        $user->password = $request->password;
        $user->save();
        $token = $request->bearerToken();

        $data = (new UsersResources($user))->token($token);
        return response()->json(msgdata(success(), trans('lang.passwordChangedSuccess'), $data));


    }

    public function UpdateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'gender' => 'required|in:male,female',
            'age' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'phone' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }

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
        $token = $request->bearerToken();

        $data = (new UsersResources($user))->token($token);
        return response()->json(msgdata(success(), trans('lang.success'), $data));


    }


    public function Verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'phone' => 'required|min:12|regex:/(966)[0-9]{8}/',
            'phone' => 'required|exists:users,email',
            'code' => 'required|min:4',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }

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
//            if ($type == "activate") {
            $user->active = 1;
            $user->save();
            $jwt_token = JWTAuth::fromUser($user);
            $data = (new UsersResources($user))->token($jwt_token);
            return response()->json(msgdata(success(), trans('lang.Verified_success'), $data));
//            } else {
//                $jwt_token = JWTAuth::fromUser($user);
//                $data = (new UsersResources($user))->token($jwt_token);
//                return response()->json(msgdata( success(), trans('lang.Verified_success'), $data));
//            }
        } else {
            return response()->json(msg(failed(), trans('lang.codeError')));
        }


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

    public function resendCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'phone' => 'required|min:12|regex:/(966)[0-9]{8}/',
            'phone' => 'required|exists:users,email',

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
        $user = User::where('email', $request->phone)->first();

        $type = $user->active == 0 ? "activate" : "reset";

        $this->sendCode($request->phone, $type);

//        $jwt_token = JWTAuth::fromUser($user);
//        $data = (new UsersResources($user))->token($jwt_token);
        return response()->json(msg( success(), trans('lang.success')));

    }


    public function socialLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'social_type' => 'required|in:facebook,google,apple',
            'social_id' => 'required',
            'email' => 'nullable',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
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
            return response()->json(msg( failed(), trans('lang.PhoneExists')));
        }

        $jwt_token = JWTAuth::fromUser($user);
        $data = (new UsersResources($user))->token($jwt_token);
        return response()->json(msgdata( success(), trans('lang.success'), $data));
    }
}
