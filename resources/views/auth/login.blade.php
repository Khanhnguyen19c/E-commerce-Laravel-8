
<x-base-layout>

<main id="main" class="main-site left-sidebar">

<div class="container">

    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home')}}" class="link">Trang Chủ</a></li>
            <li class="item-link"><span>Đăng Nhập</span></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
            <div class=" main-content-area">
                <div class="wrap-login-item ">
                    <div class="login-form form-item form-stl">
                    <x-jet-validation-errors class="mb-4" />
                        <form name="frm-login" method="POST" action="{{ route('login') }}">
                            @csrf
                        <fieldset class="wrap-title">
                                <h3 class="form-title">Đăng nhập tài khoản của bạn </h3>
                            </fieldset>
                            <fieldset class="wrap-input">
                                <label for="frm-login-uname">Email</label>
                                <input type="text" id="frm-login-uname" name="email" placeholder="Type your email address" :value="old('email')" required autofocus>
                            </fieldset>
                            <fieldset class="wrap-input">
                                <label for="frm-login-pass">Mật Khẩu</label>
                                <input type="password" id="frm-login-pass" name="password" placeholder="************" required autocomplete="current-password">
                            </fieldset>
                            <fieldset class="wrap-input">
                                <label class="remember-field">
                                    <input class="frm-input " name="rememberme" id="rememberme" value="forever" type="checkbox"><span>Ghi Nhớ</span>
                                </label>
                                <a class="link-function left-position" href="{{route('password.request')}}" title="Forgotten password?">Quên mật khẩu?</a>
                            </fieldset>
                            <fieldset class="wrap-input">



                            <button class="loginBtn loginBtn--facebook">
                            <a href="{{ url('auth/facebook') }}">
                                Login with Facebook
                                </a>
                            </button>


                                <button class="loginBtn loginBtn--google">
                                <a href="{{ url('auth/google') }}">
                                Login with Google
                                </a>
                                </button>

                             </fieldset>
                            <input type="submit" class="btn btn-submit" value="Login" name="submit" style="margin-top: 10px;">
                        </form>
                    </div>
                </div>
            </div><!--end main products area-->
        </div>
    </div><!--end row-->

</div><!--end container-->

</main>

</x-base-layout>
