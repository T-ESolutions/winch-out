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

    public function logIn(Request $request)
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
        $data = $this->userAuthRepository->logIn($request);
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

        $data = $this->userAuthRepository->SignUp($request);
        return response()->json(msg(success(), trans('lang.CodeSent')));

    }

    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'phone' => 'required|min:12|regex:/(966)[0-9]{8}/',
            'phone' => 'required|email|exists:users,email',

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }

        $this->userAuthRepository->sendCode($request->phone, "reset");
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

        $result = $this->userAuthRepository->changePassword($request);
        $data = (new UsersResources($result));
        return response()->json(msgdata(success(), trans('lang.passwordChangedSuccess'), $data));
    }

    public function updateProfile(Request $request){
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

        $result = $this->userAuthRepository->updateProfile($request);
        $data = (new UsersResources($result));
        return response()->json(msgdata(success(), trans('lang.success'), $data));
    }

    public function verify(Request $request){
        $validator = Validator::make($request->all(), [
//            'phone' => 'required|min:12|regex:/(966)[0-9]{8}/',
            'phone' => 'required|exists:users,email',
            'code' => 'required|min:4',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }

        $result = $this->userAuthRepository->verify($request);
        if($result){
            $data = (new UsersResources($result));
            return response()->json(msgdata(success(), trans('lang.Verified_success'), $data));
        }
        return response()->json(msg(failed(), trans('lang.codeError')));
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

        $this->userAuthRepository->resendCode($request);
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

        $result = $this->userAuthRepository->socialLogin($request);

        if($result){
            $data = (new UsersResources($result));
            return response()->json(msgdata( success(), trans('lang.success'), $data));
        }
        return response()->json(msg( failed(), trans('lang.PhoneExists')));
    }
}
