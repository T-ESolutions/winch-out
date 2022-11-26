<?php
/**
 * Created by PhpStorm.
 * User: Al Mohands
 * Date: 22/05/2019
 * Time: 01:53 م
 */

namespace App\Http\Controllers\Eloquent\V1\User;

use App\Http\Controllers\Interfaces\V1\User\HomeRepositoryInterface;
use App\Http\Resources\V1\User\QuestionsResources;
use App\Models\Question;
use App\Models\Service;

class HomeRepository implements HomeRepositoryInterface
{

    public function services($request)
    {
        $data = Service::active()->paginate(pagination_number());
        return $data;
    }

    public function serviceQuestions($request)
    {
        $data = Question::active()->where('service_id', $request->service_id)->paginate(pagination_number());
        return $data;
    }

    public function calculateBrandCost($request)
    {
        $data = Question::active()->where('service_id', $request->service_id)->paginate(pagination_number());
        return $data;
    }


}
