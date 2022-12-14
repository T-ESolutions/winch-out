<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Interfaces\V1\User\OrdersRepositoryInterface;
use App\Http\Controllers\Interfaces\V1\User\ReviewRepositoryInterface;
use App\Http\Requests\V1\User\MyOrdersRequest;
use App\Http\Requests\V1\User\OrderDetailsRequest;
use App\Http\Requests\V1\User\ProviderReviewsRequest;
use App\Http\Resources\ServicesResources;
use App\Http\Resources\V1\User\MyOrdersResource;
use App\Http\Resources\V1\User\OrderDetailsResource;
use App\Http\Resources\V1\User\ProviderReviewResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $reviewRepo;

    public function __construct(ReviewRepositoryInterface $reviewRepo)
    {
        $this->reviewRepo = $reviewRepo;
    }

    public function providerReviews(ProviderReviewsRequest $request)
    {

        $reviews = $this->reviewRepo->providerReviews($request);
        $data = ProviderReviewResource::collection($reviews);
        return response()->json(msgdata(success(), trans('lang.success'), $data));
    }


}
