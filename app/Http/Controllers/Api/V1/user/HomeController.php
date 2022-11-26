<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\V1\User\HomeRepositoryInterface;
use App\Http\Requests\V1\User\CalculateBrandCostRequest;
use App\Http\Requests\V1\User\ServiceQuestionsRequest;
use App\Http\Resources\V1\User\QuestionsResources;
use App\Http\Resources\V1\User\ServicesResources;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $homeRepo;

    public function __construct(HomeRepositoryInterface $homeRepo)
    {
        $this->homeRepo = $homeRepo;
    }

    public function services(Request $request)
    {
        $data = $this->homeRepo->services($request);
        $data = (ServicesResources::collection($data))->response()->getData(true);
        return response()->json(msgdata(success(), trans('lang.success'), $data));
    }

    public function serviceQuestions(ServiceQuestionsRequest $request)
    {
        $data = $this->homeRepo->serviceQuestions($request);
        $data = (QuestionsResources::collection($data))->response()->getData(true);
        return response()->json(msgdata(success(), trans('lang.success'), $data));
    }

    public function calculateBrandCost(CalculateBrandCostRequest $request)
    {
        $data = $this->homeRepo->serviceQuestions($request);
        $data = (QuestionsResources::collection($data))->response()->getData(true);
        return response()->json(msgdata(success(), trans('lang.success'), $data));
    }

}
