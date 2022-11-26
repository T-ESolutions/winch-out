<?php

namespace App\Http\Controllers\Eloquent\V1\User;


use App\Http\Controllers\Interfaces\V1\User\OrdersRepositoryInterface;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class OrdersRepository implements OrdersRepositoryInterface
{
    public function MyOrders($request)
    {
        // TODO: Implement MyOrders() method.
        $order = Order::where('user_id', Auth::guard('api')->id())->with('provider');
        if ($request->type) {
            $order->where('status', $request->type);
        } else {
            $status = Status::active()->first();
            if ($status) {
                $order->where('status', $status->title_en);
            }
        }
        return $order;
        $order->paginate(pagination_number());

    }
}
