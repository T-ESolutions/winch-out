<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\V1\User\OrdersRepositoryInterface;
use App\Http\Resources\ServicesResources;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepo;

    public function __construct(OrdersRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function MyOrder(Request $request){


    }


    public function services(Request $request)
    {
        $data = Service::active()->paginate(pagination_number());
        $data = (ServicesResources::collection($data))->response()->getData(true);
        return response()->json(msgdata(success(), trans('lang.success'), $data));
    }

}
