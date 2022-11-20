<?php
/**
 * Created by PhpStorm.
 * User: Al Mohands
 * Date: 22/05/2019
 * Time: 01:52 م
 */

namespace App\Http\Controllers\Interfaces\V1\User;


interface HomeRepositoryInterface
{
    public function getMeals($user_id,$request,$lang);
    public function getMealDetails($user_id,$request,$lang);
    public function likeMeal($user_id,$request,$lang);
    public function searchMeals($user_id,$request,$lang);
    public function getLikedMeals($user_id,$request,$lang);
    public function searchLikedMeals($user_id,$request,$lang);

    public function getPackages($user_id,$request,$lang);
    public function makeSubscription($user_id,$request,$lang);

    public function getPeriods($request,$lang);
    public function checkCopon($request,$lang);
    public function makeOrder($user_id,$subscription_expire,$wallet,$points,$request,$lang);
    public function myOrders($user_id,$request,$lang);
    public function getVipMeals($user_id,$request,$lang);
    public function rateMeal($user_id,$request,$lang);

}
