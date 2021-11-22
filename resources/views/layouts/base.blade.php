<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @livewire('seo-component')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css')}}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flexslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chosen.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-01.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/nouislider.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/toastr.min.css')}}">
    @livewireStyles
</head>

<body class="home-page home-01 " >

    <!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>

    <!--header-->
    <header id="header" class="header header-style-1">
        <div class="container-fluid">
            <div class="row">
                <div class="topbar-menu-area">
                    <div class="container">
                        <div class="topbar-menu left-menu">
                            <ul>
                                <li class="menu-item">
                                    <a title="Hotline: (+84) 77 2879 116" href="#"><span class="icon label-before fa fa-mobile"></span>Hotline: (+84) 772 2879</a>
                                </li>
                            </ul>
                        </div>
                        <div class="topbar-menu right-menu">
                            <ul>

                                <li class="menu-item lang-menu menu-item-has-children parent">
                                    <a title="English" href="#"><span class="img label-before"><img src="{{ asset('assets/images/lang-en.png' ) }}" alt="lang-en"></span>English<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <ul class="submenu lang">
                                        <li class="menu-item"><a title="hungary" href="#"><span class="img label-before"><img src="{{ asset('assets/images/lang-hun.png' ) }}" alt="lang-hun"></span>Hungary</a></li>
                                        <li class="menu-item"><a title="german" href="#"><span class="img label-before"><img src="{{ asset('assets/images/lang-ger.png' ) }}" alt="lang-ger"></span>German</a></li>
                                        <li class="menu-item"><a title="french" href="#"><span class="img label-before"><img src="{{ asset('assets/images/lang-fra.png' ) }}" alt="lang-fre"></span>French</a></li>
                                        <li class="menu-item"><a title="canada" href="#"><span class="img label-before"><img src="{{ asset('assets/images/lang-can.png' ) }}" alt="lang-can"></span>Canada</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-has-children parent">
                                    <a title="Dollar (USD)" href="{{url('lang/vn')}}">VietNam (VNĐ)<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <ul class="submenu curency">
                                        <li class="menu-item">
                                            <a title="Pound (GBP)" href="#">Pound (GBP)</a>
                                        </li>
                                        <li class="menu-item">
                                            <a title="Euro (EUR)" href="{{url('lang/en')}}">Euro (EUR)</a>
                                        </li>
                                        <li class="menu-item">
                                            <a title="Dollar (USD)" href="#">Dollar (USD)</a>
                                        </li>
                                    </ul>
                                </li>

                                @if (Route::has('login'))
                                @auth
                                @if(Auth::user()->utype === 'ADM' or Auth::user()->utype === 'SADM')
                                <li class="menu-item menu-item-has-children parent">
                                    <a title=">My Account" href="#">My Account ({{ Auth::user()->name }})<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <ul class="submenu curency" style="overflow: scroll;max-height: 500px;">
                                        <li class="menu-item">
                                            <a title="Dashboard" href="{{ route('admin.dashboard') }}">Trang chủ</a>
                                        </li>
                                        @can('order-list')
                                        <li class="menu-item">
                                            <a title="Quản lý đơn hàng" href="{{ route('admin.orders') }}">Quản lý đơn hàng</a>
                                        </li>
                                        @endcan
                                        @can('category-list')
                                        <li class="menu-item">
                                            <a title="Danh mục sản phẩm" href="{{ route('admin.categories') }}">Quản lý danh mục</a>
                                        </li>
                                        @endcan
                                        @can('brand-list')
                                        <li class="menu-item">
                                            <a title="Thương hiệu sản phẩm" href="{{ route('admin.brands') }}">Quản lý thương hiệu</a>
                                        </li>
                                        @endcan
                                        @can('products-list')
                                        <li class="menu-item">
                                            <a title="Quản lý Sản phẩm" href="{{ route('admin.products') }}">Quản lý sản phẩm</a>
                                        </li>
                                        @endcan
                                        @can('productAtrribute-list')
                                        <li class="menu-item">
                                            <a title="Quản lý thuộc tính sản phẩm" href="{{ route('admin.attributes') }}">Quản lý thuộc tính sản phẩm</a>
                                        </li>
                                        @endcan
                                        @can('slider-list')
                                        <li class="menu-item">
                                            <a title="Slider trang chủ" href="{{ route('admin.homeslider') }}">Quản lý slider</a>
                                        </li>
                                        @endcan
                                        @can('homeCategory-list')
                                        <li class="menu-item">
                                            <a title="Danh mục trang chủ" href="{{ route('admin.homecategories') }}">Quản lý danh mục trang chủ</a>
                                        </li>
                                        @endcan
                                        @can('sale-list')
                                        <li class="menu-item">
                                            <a title="Quản lý thời gian sale" href="{{ route('admin.sale') }}">Quản lý thời gian khuyến mãi</a>
                                        </li>
                                        @endcan
                                        @can('coupon-list')
                                        <li class="menu-item">
                                            <a title="Quản lý mã giảm giá" href="{{ route('admin.coupons') }}">Quản lý mã khuyến mãi</a>
                                        </li>
                                        @endcan
                                        @can('feedback-list')
                                        <li class="menu-item">
                                            <a title="Quản lý phản hồi" href="{{ route('admin.contact') }}">Quản lý phản hồi</a>
                                        </li>
                                        @endcan
                                        @can('footer-list')
                                        <li class="menu-item">
                                            <a title="Quản lý thông tin website" href="{{ route('admin.settings') }}">Quản lý thông tin Website</a>
                                        </li>
                                        @endcan
                                        @can('payment-list')
                                        <li class="menu-item">
                                            <a title="Quản lý đối tác" href="{{ route('admin.payments') }}">Quản lý icon đối tác</a>
                                        </li>
                                        @endcan
                                        @can('posts-list')
                                        <li class="menu-item">
                                            <a title="Quản lý tin tucs" href="{{ route('admin.posts') }}">Quản lý tin tức</a>
                                        </li>
                                        @endcan
                                        @if(Auth::user()->utype === 'SADM')
                                        <li class="menu-item">
                                            <a title="Quản lý Admin" href="{{ route('admin.list') }}">Quản lý list Admin</a>
                                        </li>
                                        <li class="menu-item">
                                            <a title="Quản lý Admin" href="{{ route('admin.roles') }}">Quản lý vai trò Admin</a>
                                        </li>
                                        @endif
                                        <li class="menu-item">
                                            <a title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">Logout</a>
                                        </li>
                                        <form id="form-logout" method="POST" action="{{ route('logout') }}">
                                            @csrf
                                        </form>
                                    </ul>
                                </li>
                                @else
                                <li class="menu-item menu-item-has-children parent">
                                    <a title=">My Account" href="#">My Account ({{ Auth::user()->name }})<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <ul class="submenu curency">
                                        <li class="menu-item">
                                            <a title="Dashboard" href="{{ route('user.dashboard') }}">Trang chủ</a>
                                        </li>
                                        <li class="menu-item">
                                            <a title="Thông tin cá nhân" href="{{ route('user.profile') }}">Thông tin cá nhân</a>
                                        </li>
                                        <li class="menu-item">
                                            <a title="Đơn hàng của tôi" href="{{ route('user.orders') }}">Đơn hàng của tôi</a>
                                        </li>
                                        <li class="menu-item">
                                            <a title="Thay đổi mật khẩu" href="{{ route('user.changepassword') }}">Thay đổi mật khẩu</a>
                                        </li>
                                        <li class="menu-item">
                                            <a title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">Logout</a>
                                        </li>
                                        <form id="form-logout" method="POST" action="{{ route('logout') }}">
                                            @csrf
                                        </form>
                                    </ul>
                                </li>
                                @endif
                                @else
                                <li class="menu-item"><a title="Register or Login" href="{{route('login')}}">Đăng Nhập</a></li>
                                <li class="menu-item"><a title="Register or Login" href="{{route('register')}}">Đăng Ký</a></li>
                                @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="mid-section main-info-area">

                        <div class="wrap-logo-top left-section">
                            <a href="{{ route('home') }}" class="link-to-home"><img src="{{ asset('assets/images/logo-top-1.png' )  }}" alt="K-Shopper"></a>
                        </div>

                        @livewire('header-search-component')

                        <div class="wrap-icon right-section">
                            @livewire('wish-list-count-component')

                            @livewire('cart-count-component')

                            <div class="wrap-icon-section show-up-after-1024">
                                <a href="#" class="mobile-navigation">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="nav-section header-sticky">
                    <div class="header-nav-section">
                        <div class="container">
                            <ul class="nav menu-nav clone-main-menu" id="mercado_haead_menu" data-menuname="Sale Info">
                                <li class="menu-item"><a href="{{ route('products.topOnweek')}}" class="link-term">Nổi bật hàng tuần</a><span class="nav-label hot-label">hot</span></li>
                                <li class="menu-item"><a href="{{ route('products.topOnsales')}}" class="link-term">Các sản phẩm giảm giá</a><span class="nav-label hot-label">hot</span></li>
                                <li class="menu-item"><a href="{{ route('products.topSelling')}}" class="link-term">Bán chạy nhât</a><span class="nav-label hot-label">hot</span></li>
                                <li class="menu-item"><a href="{{ route('products.topReview')}}" class="link-term">Được đánh giá cao nhất</a><span class="nav-label hot-label">hot</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="primary-nav-section">
                        <div class="container">
                            <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu">
                                <li class="menu-item home-icon">
                                    <a href="{{ route('home') }}" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('about') }}" class="link-term mercado-item-title">Giới thiệu</a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('shop') }}" class="link-term mercado-item-title">Shop</a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('categorypost') }}" class="link-term mercado-item-title">Tin Tức</a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('product.cart') }}" class="link-term mercado-item-title">Giỏ hàng</a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('checkout') }}" class="link-term mercado-item-title">Thanh toán</a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('contact') }}" class="link-term mercado-item-title">Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{ $slot }}

    @livewire('footer-component')
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="{{ asset('assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('assets/js/functions.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <!-- <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script> -->
    <script src="https://cdn.tiny.cloud/1/eovfy0x0me91588prj1gvc4ss88ubsabp35or63sgedhbabe/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js" integrity="sha512-PDFb+YK2iaqtG4XelS5upP1/tFSmLUVJ/BVL8ToREQjsuXC5tyqEfAQV7Ca7s8b7RLHptOmTJak9jxlA2H9xQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js" integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script src="{{ asset('assets/ckeditor/vanilla-masker.min.js') }}"></script>

    <!-- fb js -->
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=457322882198955&autoLogAppEvents=1" nonce="o9z6N1pr"></script>
    {!! Toastr::message() !!}
    @livewireScripts
   <!-- Messenger Plugin chat Code -->
   <div id="fb-root"></div>
<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "152051286978850");
  chatbox.setAttribute("attribution", "biz_inbox");

  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v12.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
    <div id="paypal-button"></div>
    <!-- paypal -->
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <!-- thanh toán online -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=457322882198955&autoLogAppEvents=1" nonce="RLs1TlFK"></script>
<script src="https://apis.google.com/js/platform.js"></script>
    @stack('scripts')
    <script>
    window.addEventListener('hide-form', event => {
        $('#form').modal('hide');
        $('.form-horizontal').reset();
        //  toastr.success(event.detail.message, 'Success!');
    });
    window.addEventListener('show-form', event => {
        $('#form').modal('show');
    });
    </script>



</body>
</html>
