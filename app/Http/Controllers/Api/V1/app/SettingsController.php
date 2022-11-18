<?php

namespace App\Http\Controllers\Api\V1\app;

use App\Http\Controllers\Controller;
use App\Http\Resources\PagesResources;
use App\Http\Resources\ScreenResources;
use App\Models\Page;
use App\Models\Screen;
use Illuminate\Http\Request;
use Auth;
use JWTAuth;
use TymonJWTAuthExceptionsJWTException;

class SettingsController extends Controller
{
    public function settings(Request $request)
    {
        $settings = Setting::get();
//        $screens = (ScreenResources::collection($screens));
        return response()->json(msgdata($request, success(), trans('lang.success'), $settings));
    }

    public function custom_settings(Request $request, $key)
    {
        $key = $key . '_' . $request->header('lang');
        $data = Setting::where('key', $key)->first()->value;
        return response()->json(msgdata($request, success(), trans('lang.success'), $data));
    }

    public function custom_settings_keys(Request $request)
    {
        if ($request->header('lang')) {
            $lang = $request->header('lang');
        } else {
            $lang = 'ar';
        }
        $data['working_hours'] = Setting::where('key', 'working_hours_' . $lang)->first()->value;
        $data['shipp_value'] = Setting::where('key', 'shipp_value')->first()->value;
        $data['freeze_days'] = Setting::where('key', 'freeze_days')->first()->value;
        return response()->json(msgdata($request, success(), trans('lang.success'), $data));
    }

    public function pages(Request $request, $type)
    {
        $page = Page::where('type', $type)->first();
        if (!$page) {
            return response()->json(['status' => 401, 'msg' => trans('lang.page_not_found')]);
        }
        $data = (new PagesResources($page));
        return response()->json(msgdata($request, success(), trans('lang.success'), $data));
    }

    public function screens(Request $request)
    {
        $screens = Screen::get();
        $screens = (ScreenResources::collection($screens));
        return response()->json(msgdata($request, success(), trans('lang.success'), $screens));
    }
}
