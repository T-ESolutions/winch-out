<?php

namespace App\Http\Controllers\Interfaces\V1\User;

interface OrdersRepositoryInterface{

    public function sendOrderRequest($request);
    public function MyOrders($request);
    public function OrderDetails($request);
}
