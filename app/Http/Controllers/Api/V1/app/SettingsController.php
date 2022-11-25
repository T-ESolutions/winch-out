<?php

namespace App\Http\Controllers\Api\V1\app;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandsResources;
use App\Http\Resources\CancelReasonResources;
use App\Http\Resources\LinksResources;
use App\Http\Resources\ModellsResources;
use App\Http\Resources\PageDetailsResources;
use App\Http\Resources\PagesResources;
use App\Http\Resources\ScreenResources;
use App\Models\Brand;
use App\Models\CancelReason;
use App\Models\Link;
use App\Models\Modell;
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
        return response()->json(msgdata(success(), trans('lang.success'), $settings));
    }

    public function custom_settings(Request $request, $key)
    {
        $key = $key . '_' . $request->header('lang');
        $data = Setting::where('key', $key)->first()->value;
        return response()->json(msgdata(success(), trans('lang.success'), $data));
    }


    public function pages()
    {
        $pages = Page::get();
        $data = (PagesResources::collection($pages));
        return response()->json(msgdata(success(), trans('lang.success'), $data));
    }

    public function page_details(Request $request)
    {
        $page = Page::findOrFail($request->id);
        $data = (new PageDetailsResources($page));
        return response()->json(msgdata(success(), trans('lang.success'), $data));
    }
    public function cancel_reasons(Request $request)
    {
        $data = CancelReason::active()->where('type',$request->type)->paginate(pagination_number());
        $data = (CancelReasonResources::collection($data))->response()->getData(true);
        return response()->json(msgdata(success(), trans('lang.success'), $data));
    }

    public function links(Request $request)
    {
        $data = Link::get();
        $data = (LinksResources::collection($data))->response()->getData(true);
        return response()->json(msgdata(success(), trans('lang.success'), $data));
    }

    public function screens()
    {
        $screens = Screen::get();
        $screens = (ScreenResources::collection($screens));
        return response()->json(msgdata(success(), trans('lang.success'), $screens));
    }

    public function brands()
    {
        $screens = Brand::paginate(pagination_number());
        $screens = (BrandsResources::collection($screens))->response()->getData(true);
        return response()->json(msgdata(success(), trans('lang.success'), $screens));
    }

    public function modells(Request $request)
    {
        $screens = Modell::active()->where('brand_id', $request->brand_id)->paginate(pagination_number());
        $screens = (ModellsResources::collection($screens))->response()->getData(true);
        return response()->json(msgdata(success(), trans('lang.success'), $screens));
    }
}
