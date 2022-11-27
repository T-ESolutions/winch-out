<?php

namespace App\Http\Controllers\Eloquent\V1\User;


use App\Http\Controllers\Interfaces\V1\User\OrdersRepositoryInterface;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderImage;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class OrdersRepository implements OrdersRepositoryInterface
{
    public function sendOrderRequest($request)
    {

        $data = $request->validated();

        $order = Order::create($data);
        if ($order) {
            //save order addresses after add order ...
            $address_data['order_id'] = $order->id;
            $address_data['pickup_lat'] = $data['pickup_lat'];
            $address_data['pickup_lng'] = $data['pickup_lng'];
            $address_data['pickup_address'] = $data['pickup_address'];
            if ($request->drop_off_lat && $request->drop_off_lng && $request->drop_off_address) {
                $address_data['drop_off_lat'] = $data['drop_off_lat'];
                $address_data['drop_off_lng'] = $data['drop_off_lng'];
                $address_data['drop_off_address'] = $data['drop_off_address'];
            }
            OrderAddress::create($address_data);

            //save order user car images after add order ...
            if($data['images']){
                foreach ($data['images'] as $image ){
                    $images_data['order_id'] = $order->id;
                    $images_data['image'] = $image;
                    $images_data['type'] = 'user';
                    OrderImage::create($images_data);
                }
            }
        }
        return $order;
    }

    public function MyOrders($request)
    {
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
