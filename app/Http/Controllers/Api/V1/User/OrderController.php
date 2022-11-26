<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\V1\User\OrdersRepositoryInterface;
use App\Http\Requests\V1\User\MyOrdersRequest;
use App\Http\Requests\V1\User\OrderDetailsRequest;
use App\Http\Resources\ServicesResources;
use App\Http\Resources\V1\User\MyOrdersResource;
use App\Http\Resources\V1\User\OrderDetailsResource;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepo;

    public function __construct(OrdersRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function myOrders(MyOrdersRequest $request)
    {
        $orders = $this->orderRepo->MyOrders($request);
        $data = MyOrdersResource::collection($orders)->response()->getData(true);
        return response()->json(msgdata(success(), trans('lang.success'), $data));

    }

    public function orderDetails(OrderDetailsRequest $request){

        $order_details = $this->orderRepo->OrderDetails($request);
        $data = new OrderDetailsResource($order_details);
        return response()->json(msgdata(success(), trans('lang.success'), $data));
    }


    public function services(Request $request)
    {
        $data = Service::active()->paginate(pagination_number());
        $data = (ServicesResources::collection($data))->response()->getData(true);
        return response()->json(msgdata(success(), trans('lang.success'), $data));
    }

}
