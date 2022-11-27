<?php

namespace App\Http\Controllers\Interfaces\V1\User;

interface AuthRepositoryInterface{

    public function logIn($request);
    public function signUp($request);
    public function sendCode($email, $type);
    public function resendCode($request);
    public function verify($request);
    public function socialLogin($request);
    public function updateProfile($request);
    public function changePassword($request);


}
