<?php

namespace App\Http\Controllers\Api\V1\user;

use App\Http\Controllers\Controller;
use App\Http\Resources\CancelReasonResources;
use App\Http\Resources\ServicesResources;
use App\Http\Resources\UsersResources;
use App\Mail\SendCode;
use App\Models\CancelReason;
use App\Models\Service;
use App\Models\User;
use App\Models\Verfication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use JWTAuth;
use TymonJWTAuthExceptionsJWTException;
use Mail;

class OrderController extends Controller
{
    public function services(Request $request)
    {
        $data = Service::active()->paginate(pagination_number());
        $data = (ServicesResources::collection($data))->response()->getData(true);
        return response()->json(msgdata(success(), trans('lang.success'), $data));
    }

}
