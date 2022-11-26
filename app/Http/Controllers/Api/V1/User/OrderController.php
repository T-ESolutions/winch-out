<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\V1\User\OrdersRepositoryInterface;
use App\Http\Requests\V1\User\MyOrdersRequest;
use App\Http\Resources\ServicesResources;
use App\Http\Resources\V1\User\MyOrdersResource;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepo;

    public function __construct(OrdersRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function MyOrders(MyOrdersRequest $request)
    {
        $orders = $this->orderRepo->MyOrders($request);
        $data = MyOrdersResource::collection($orders->paginate(pagination_number()))->response()->getData(true);
        return response()->json(msgdata(success(), trans('lang.success'), $data));

    }


    public function services(Request $request)
    {
        $data = Service::active()->paginate(pagination_number());
        $data = (ServicesResources::collection($data))->response()->getData(true);
        return response()->json(msgdata(success(), trans('lang.success'), $data));
    }

}
