@extends('layouts.app')


@section('content')

    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-row-fluid bg-white" id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside order-2 order-lg-1 d-flex flex-column-fluid flex-lg-row-auto bgi-size-cover bgi-no-repeat p-7 p-lg-10">
                <!--begin: Aside Container-->
                <div class="d-flex flex-row-fluid flex-column justify-content-between">
                    <!--begin::Aside body-->
                    <div class="d-flex flex-column-fluid flex-column flex-center mt-5 mt-lg-0">
                        <a href="#" class="mb-15 text-center">
                            <img src="{{asset('libs/assets/media/logos/logo-letter-1.png')}}" class="max-h-75px" alt="" />
                        </a>
                        <!--begin::Signin-->
                        <div class="login-form login-signin">
                            <div class="text-center mb-10 mb-lg-20">
                                <h2 class="font-weight-bold">Sign In</h2>
                                <p class="text-muted font-weight-bold">Enter your username and password</p>
                            </div>
                            <!--begin::Form-->
                            <form method="POST" class="form" novalidate="novalidate" id="kt_login_signin_form" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group py-3 m-0">
                                    <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="off" />
                                </div>
                                <div class="form-group py-3 border-top m-0">
                                    <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Password" placeholder="Password" name="password" required />
                                </div>
                                <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-3">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-outline m-0 text-muted">
                                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                            <span></span>Remember me</label>
                                    </div>
                                    <a href="javascript:;" id="kt_login_forgot" class="text-muted text-hover-primary">Forgot Password ?</a>
                                </div>
                                <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-2">
                                    <button type="submit" id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3">Sign In</button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>

                        <div class="login-form login-forgot">
                            <div class="text-center mb-10 mb-lg-20">
                                <h3 class="">Forgotten Password ?</h3>
                                <p class="text-muted font-weight-bold">Enter your email to reset your password</p>
                            </div>
                            <!--begin::Form-->
                            <form class="form" novalidate="novalidate" id="kt_login_forgot_form">
                                <div class="form-group py-3 border-bottom mb-10">
                                    <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="email" placeholder="Email" name="email" autocomplete="off" />
                                </div>
                                <div class="form-group d-flex flex-wrap flex-center">
                                    <button id="kt_login_forgot_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Submit</button>
                                    <button id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel</button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Forgot-->
                    </div>
                    <!--end::Aside body-->
                    <!--begin: Aside footer for desktop-->
                    <!--end: Aside footer for desktop-->
                </div>
                <!--end: Aside Container-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div class="order-1 order-lg-2 flex-column-auto flex-lg-row-fluid d-flex flex-column p-7" style="background-image: url({{asset('libs/assets/media/bg/bg-4.jpg')}});">
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-lg-center">
                    <div class="d-flex flex-column justify-content-center">
                        <h3 class="display-3 font-weight-bold my-7 text-white">Welcome to GiveBot!</h3>
                        <p class="font-weight-bold font-size-lg text-white opacity-80">The ultimate Bootstrap admin theme framework for telegram bot.</p>
                    </div>
                </div>
                <!--end::Content body-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>


    @push('login-styles')
        <link href="{{asset('libs/assets/css/pages/login/classic/login-2.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <!--end::Page Custom Styles-->
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="{{asset('libs/assets/plugins/global/plugins.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('libs/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('libs/assets/css/style.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
    @endpush

    @push('login-scripts')
        <!--end::Main-->
        <script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
        <!--begin::Global Config(global config for global JS scripts)-->
        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#8950FC", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#6993FF", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#EEE5FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#E1E9FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
        <!--end::Global Config-->
        <!--begin::Global Theme Bundle(used by all pages)-->
        <script src="{{asset('libs/assets/plugins/global/plugins.bundle.js?v=7.0.5')}}"></script>
        <script src="{{asset('libs/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5')}}"></script>
        <script src="{{asset('libs/assets/js/scripts.bundle.js?v=7.0.5')}}"></script>
        <!--end::Global Theme Bundle-->
        <!--begin::Page Scripts(used by this page)-->
        <!--<script src="{{asset('libs/assets/js/pages/custom/login/login-general.js?v=7.0.5')}}"></script>-->
        <!--end::Page Scripts-->
    @endpush
@endsection
