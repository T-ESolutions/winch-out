<?php

namespace App\Http\Controllers\Eloquent\V1\User;


use App\Http\Controllers\Interfaces\V1\User\ReviewRepositoryInterface;
use App\Models\Order;
use App\Models\OrderReview;
use App\Models\Provider;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class ReviewRepository implements ReviewRepositoryInterface
{


    public function providerReviews($request)
    {
        // TODO: Implement providerReviews() method.
        $provider = Provider::whereId($request->provider_id)->with('reviewsReached')->first();
        $reviews = $provider->reviewsReached;
        return $reviews;
    }
}
