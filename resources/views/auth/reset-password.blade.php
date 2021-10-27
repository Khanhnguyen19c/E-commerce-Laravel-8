

<x-base-layout>

<main id="main" class="main-site left-sidebar">

<div class="container">

    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home')}}" class="link">Trang Chủ</a></li>
            <li class="item-link"><span>Lấy lại mật khẩu</span></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
            <div class=" main-content-area">
                <div class="wrap-login-item ">
                    <div class="login-form form-item form-stl">

                    <x-jet-validation-errors class="mb-4" />
                        <form name="frm-login" method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{$request->route('token')}}"/>
                        <fieldset class="wrap-title">
                                <h3 class="form-title">Lấy lại mật khẩu </h3>
                            </fieldset>
                            <fieldset class="wrap-input">
                                <label for="frm-login-uname">Địa Chỉ Email</label>
                                <input type="text" id="frm-login-uname" name="email" placeholder="Nhập Email của bạn" value="{{$request->email}}" required >
                            </fieldset>
                            <fieldset class="wrap-input item-width-in-half left-item ">
                                <label for="password">Password *</label>
                                <input type="password" id="password" name="password" placeholder="Password" required autocomplete="new-password">
                            </fieldset>
                            <fieldset class="wrap-input item-width-in-half ">
                                <label for="password_confirmation">Confirm Password *</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                            </fieldset>
                            <input type="submit" class="btn btn-submit" value="Xác Nhận" name="submit" style="margin-top: 10px;">
                        </form>
                    </div>
                </div>
            </div><!--end main products area-->
        </div>
    </div><!--end row-->

</div><!--end container-->

</main>

</x-base-layout>
