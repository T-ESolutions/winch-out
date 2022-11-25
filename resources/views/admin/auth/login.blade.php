<!DOCTYPE html>

<html lang="ar" dir="rtl">
<!--begin::Head-->
<head>
    <base href="../../../">
    <title>Proten Chef</title>
    <meta charset="utf-8"/>
    <meta name="description" content="Proten Chef"/>
    <meta name="keywords" content="Proten Chef"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="Proten Chef"/>
    <meta property="og:url" content="http://tesolutionspro.com/metronic"/>
    <meta property="og:site_name" content="Keenthemes | Metronic"/>
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8"/>
    <link rel="shortcut icon" href="{{asset('/')}}/default.png"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ url('admin/dist/') }}/assets/plugins/global/plugins.bundle.rtl.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{ url('admin/dist/') }}/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->

    <link href="{{asset('admin/dist/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/dist/assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css"/>

    <style>
        .app-f-color {
            color: #F48120 !important;
        }

        .app-bg-color {
            background-color: #F48120 !important;
        }

        .svg-icon-orange {
            transition: fill 0.3s ease;
            fill: #F48120 !important;
        }

        @font-face {
            font-family: 'din';
            src: url({{asset('din.ttf')}}) format('opentype');
        }

        body, h1, h2, h3, h4, h5, h6, * {
            font-family: 'din';
        }

        /*.aside.aside-dark {*/
        /*    background-color: #F48120!important;*/
        /*}*/
        .aside-dark .menu .menu-item .menu-link .menu-title {
            color: white;
        }

        .aside-dark .menu .menu-item .menu-link.active {
            background-color: #292D32;
        }

        .btn-secondary {
            background-color: rgba(255, 136, 33, 0.71) !important;
        }

        .nav-line-tabs .nav-item .nav-link.active, .nav-line-tabs .nav-item.show .nav-link, .nav-line-tabs .nav-item .nav-link:hover:not(.disabled) {
            border-bottom: 2px solid #F48120 !important;
        }

        .aside-dark .menu .menu-item .menu-link.active {
            background-color: #F48120 !important;
        }

        .aside-dark .menu .menu-item .menu-section {
            color: white !important;
        }

        .aside.aside-dark .separator {
            border-bottom-color: white !important;
        }

        .aside.aside-dark .aside-logo {
            border: 7px solid #000000 !important;
            border-radius: 5px;
        }

        .btn-danger {
            background-color: #ea4335 !important;
        }

        .btn-warning {
            background-color: #fbbc05 !important;
        }

        .btn-success {
            background-color: #0ac630 !important;
        }

        .page-link {
            background-color: rgba(255, 136, 33, 0.71) !important;
            color: #3F4254 !important;
        }

    </style>

</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="bg-body">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div
        class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
        style="background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url({{asset('/')}}background.png)">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="{{asset('/')}}" class="mb-12">
{{--                background-color: white;--}}
                <img alt="Logo" src="{{asset('/')}}default.png"
                     style=" border-radius: 5px;padding: 10px;height:219px;width: 300px"/>
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-10 mx-auto">


                <!--begin::Form-->
                <form action="{{route('admin.login')}}" method="post" class="form w-100" id="kt_sign_in_form1">
                @csrf
                <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Link-->
                    {{--                        <div class="text-gray-400 fw-bold fs-4">--}}
                    {{--                            <a href="" class=" fw-bolder" style="color: #F48120">Proten Chef</a>--}}
                    {{--                        </div>--}}
                    {{--                        <br>--}}
                    <!--end::Link-->
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">تسجيل الدخول لوحة التحكم</h1>
                        <!--end::Title-->
                        @include('layouts.messages')
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">البريد الالكتروني</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg form-control-solid" type="text" name="email"
                               autocomplete="off"/>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack mb-2">
                            <!--begin::Label-->
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">كلمة المرور</label>
                            <!--end::Label-->
                            <!--begin::Link-->
                        {{--                            <a href="../../demo1/dist/authentication/layouts/basic/password-reset.html" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>--}}
                        <!--end::Link-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                               autocomplete="off"/>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg  w-100 mb-5"
                                style="background-color: #F48120">
                            <span class="indicator-label">تسجيل</span>
                            <span class="indicator-progress">جاري التحميل . . .
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Submit button-->
                        <!--begin::Separator-->
                    {{--                        <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>--}}
                    <!--end::Separator-->
                        <!--begin::Google link-->
                    {{--                        <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">--}}
                    {{--                            <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3" />Continue with Google</a>--}}
                    <!--end::Google link-->
                        <!--begin::Google link-->
                    {{--                        <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">--}}
                    {{--                            <img alt="Logo" src="assets/media/svg/brand-logos/facebook-4.svg" class="h-20px me-3" />Continue with Facebook</a>--}}
                    <!--end::Google link-->
                        <!--begin::Google link-->
                    {{--                        <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100">--}}
                    {{--                            <img alt="Logo" src="assets/media/svg/brand-logos/apple-black.svg" class="h-20px me-3" />Continue with Apple</a>--}}
                    <!--end::Google link-->
                    </div>

                    <!--end::Actions-->
                </form>
                <div class="download-buttons text-center row">
                    <div class="play-store col-md-6 mb-3">
                        <a href="https://play.google.com">
                            <img src="{{url('/')}}/uploads/play_store.png">
                        </a>
                    </div>
                    <div class="apple-store col-md-6 mb-3">
                        <a href="https://www.apple.com/app-store">
                            <img src="{{url('/')}}/uploads/apple_store.png">
                        </a>
                    </div>
                </div>
                <!--end::Form-->

                <a href="http://tesolutionspro.com" target="_blank" type="submit" id="kt_sign_in_submit" class="btn "
                   style="background-color: white">
                    <img alt="TES Logo" src="{{asset('/')}}/tes.png" class=" logo "
                         style="width: 30%;" ;/>
                </a>
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
    {{--        <div class="d-flex flex-center flex-column-auto p-10">--}}
    {{--            <!--begin::Links-->--}}
    {{--            <div class="d-flex align-items-center fw-bold fs-6">--}}
    {{--                <a href="http://tesolutionspro.com" class="text-muted text-hover-primary px-2">About</a>--}}
    {{--                <a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>--}}
    {{--                <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>--}}
    {{--            </div>--}}
    {{--            <!--end::Links-->--}}
    {{--        </div>--}}
    <!--end::Footer-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--end::Main-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ url('admin/dist/') }}/assets/plugins/global/plugins.bundle.js"></script>
<script src="{{ url('admin/dist/') }}/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ url('admin/dist/') }}/assets/js/custom/authentication/sign-in/general.js"></script>
<!--end::Page Custom Javascript-->

<?php
$errors = session()->get("errors");
?>
@if( session()->has("errors"))
    <?php
    $e = implode(' - ', $errors->all());
    ?>

    <script>
        Swal.fire({
            icon: 'warning',
            title: "برجاء التأكد من البيانات.",
            text: "{{$e}} ",
            type: "error",
            timer: 5000,
            showConfirmButton: false
        });
    </script>

@endif

@if( session()->has("error"))
    <?php
    $e = session()->get("error");
    ?>

    <script>
        Swal.fire({
            icon: 'warning',
            title: "تنبية",
            text: "{{$e}} ",
            type: "error",
            timer: 5000,
            showConfirmButton: false
        });
    </script>

@endif

@if( session()->has("success"))
    <?php
    $e = session()->get("success");
    ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: "تمت العملية بنجاح.",
            text: "{{$e}} ",
            type: "success",
            timer: 5000,
            showConfirmButton: false,
            dir:"row"
        });
    </script>

@endif
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
