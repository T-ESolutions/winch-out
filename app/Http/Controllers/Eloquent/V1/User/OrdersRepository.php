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
        $order = Order::where('user_id', Auth::guard('api')->id())
            ->with('provider')
            ->where(function ($q) use ($request) {
                if ($request->type) {
                    $q->where('status_key', $request->type);
                } else {
                    $q->whereNotIn('status_key', [finished(), canceled()]);
                }
            })->paginate(pagination_number());

        return $order;

    }

    public function OrderDetails($request)
    {
        $order = Order::whereId($request->order_id)->first();
        return $order;
    }
}
