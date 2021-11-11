<main id="main" class="main-site">
<style>
    .total{
        color: white !important;
        font-weight: bold;
        font-size: 22px;
        border-radius: 5px;
        padding: 5px 10px;
        text-decoration: underline;
    }
</style>
    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
            <li class="item-link"><a href="{{ route('home')}}" class="link">Trang Chủ</a></li>
                <li class="item-link"><a href="{{ route('login') }}" class="link"><span>Giỏ hàng</span></a></li>
            </ul>
        </div>
        <div class="main-content-area">
            @if (Cart::instance('cart')->count() > 0)

            <div class="wrap-iten-in-cart">
                @if (Session::has('success_message'))
                <div class="alert alert-success">
                    {{ Session::get('success_message') }} <strong>Thành công </strong>
                </div>
                @endif
                @if (Cart::instance('cart')->count() > 0)
                <h3 class="box-title">Tên sản phẩm</h3>
                <ul class="products-cart">
                    @foreach (Cart::instance('cart')->content() as $item)
                    <li class="pr-cart-item">
                        <div class="product-image">
                            <figure><img src="{{ asset('assets/images/products/') }}/{{ $item->model->image}}" alt="{{ $item->model->name }}"></figure>
                        </div>
                        <div class="product-name">
                            <a class="link-to-product" href="{{ route('product.details',['slug'=>$item->model->slug] )}}">{{ $item->model->name }}</a>
                        </div>
                        @foreach($item->options as $key=>$value)
                        <div style="vertical-align: middle; width:180px;">
                            <p><b>{{$key}}: </b> {{$value}}</p>
                        </div>
                        @endforeach
                        @if ($item->model->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                        <div class="price-field produtc-price">
                            <p class="price">{{ number_format($item->model->sale_price,0,',',',') }} đ</p>
                        </div>
                        @else
                        <div class="price-field produtc-price">
                            <p class="price">{{ number_format($item->model->regular_price,0,',',',') }} đ</p>
                        </div>
                        @endif
                        <div class="quantity">
                            <div class="quantity-input">
                                <input type="text" name="product-quatity" value="{{ $item->qty }}" data-max="120" pattern="[0-9]*">
                                <a class="btn btn-increase" href="#" wire:click.prevent="increaseQuantity('{{$item->rowId}}')"></a>
                                <a class="btn btn-reduce" href="#" wire:click.prevent="decreaseQuantity('{{$item->rowId}}')"></a>
                            </div>
                            <p class="btn btn-primary"><a style="color: white;" href="#" wire:click.prevent="switchToSaveForLater('{{ $item->rowId }}')">Lưu Sản Phẩm</a></p>
                        </div>
                        <div class="price-field sub-total">
                            <p class="price">{{ number_format($item->subtotal,0,',',',') }} đ</p>
                        </div>
                        <div class="delete">
                            <a href="#" class="btn btn-delete" title="" wire:click.prevent="destroy('{{$item->rowId}}')">
                                <span>Xoá sản phẩm</span>
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </a>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                <p>Bạn chưa thêm sản phẩm vào giỏ hàng</p>
                @endif
            </div>
            <div class="summary">
                <div class="order-summary">
                    <h4 class="title-box">Giỏ hàng</h4>
                    <p class="summary-info"><span class="title">Tổng cộng: </span><b class="index">{{ Cart::instance('cart')->subtotal(0, ',',',')}}đ </b></p>
                    @if (Session::has('coupon'))
                    <p class="summary-info"><span class="title">Mã Giảm : {{ Session::get('coupon')['code'] }} <a href="#" wire:click.prevent="removeCoupon"><i class="fa fa-times text-danger"></i></a></span><b class="index">-{{ number_format($discount,0,',',',') }}đ</b></p>
                    <p class="summary-info"><span class="title">Tiền đã giảm còn: </span><b class="index">{{ number_format($subtotalAfterDiscount,0,',',',') }}đ</b></p>
                    <p class="summary-info"><span class="title">Thuế: ({{ config('cart.tax') }}%)</span><b class="index">+{{ number_format($taxAfterDiscount,0,',',',') }}đ</b></p>
                    <p class="summary-info total-info "><span class="title">Thành Tiền: </span><b class="index btn btn-danger total">{{ number_format($totalAfterDiscount,0,',',',') }}đ</b></p>
                    @else
                    <p class="summary-info"><span class="title">Thuế: </span><b class="index">{{ Cart::instance('cart')->tax(0, ',','.')}}đ</b></p>
                    <p class="summary-info"><span class="title">Phí Ship</span><b class="index">Free Shipping</b></p>
                    <p class="summary-info total-info "><span class="title">Thành Tiền: </span><b class="index btn btn-danger total">{{ Cart::instance('cart')->total(0, ',','.') }}đ</b></p>
                    @endif
                </div>
                <div class="checkout-info">
                    @if (!Session::has('coupon'))
                    <label class="checkbox-field">
                        <input class="frm-input " name="have-code" id="have-code" value="1" type="checkbox" wire:model="haveCouponCode"><span>Tôi có mã khuyến mãi</span>
                    </label>
                    @if($haveCouponCode ==1)
                    <div class="summary-item">
                        <form wire:submit.prevent="applyCoupon">
                            <h4 class="title-box">Mã Khuyến Mãi</h4>
                            @if (session::has('coupon_message'))
                            <div class="alert alert-danger" role="danger">{{ session::get('coupon_message') }}</div>
                            @endif
                            <p class="row-in-form">
                                <label for="coupon-cde">Nhập mã của bạn tại đây!</label>
                                <input type="text" name="coupon-code" wire:model="couponCode" />
                            </p>
                            <button type="submit" class="btn btn-small">Xác Nhận</button>
                        </form>
                    </div>
                    @endif
                    @endif
                    <a class="btn btn-checkout" href="#" wire:click.prevent="checkout">Thanh Toán</a>
                    <a class="link-to-shop" href="shop.html">Tiếp tục mua hàng<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                </div>
                <div class="update-clear">
                    <a class="btn btn-clear" title="" wire:click.prevent="destroyAll()">Xoá tất cả sản phẩm</a>
                    <a class="btn btn-update" href="#">Cập nhật Giỏ hàng</a>
                </div>
            </div>
            @else
            <div class="text-center" style="padding: 30px 0;">
                <h1>Giỏ hàng của bạn đang trống!</h1>
                <p>Thêm sản phẩm vào ngay bây giờ</p>
                <a href="{{ route('shop') }}" class="btn btn-success">Mua Sắm Ngay</a>
            </div>

            @endif
            <div class=" main-content-area">
                <div class="wrap-iten-in-cart">
                    <h3 class="title-box" style="border-bottom: 1px solid; padding-bottom:15px;">{{ Cart::instance('saveForLater')->count() }} Sản phẩm đã được lưu</h3>
                    @if (Session::has('s_success_message'))
                    <div class="alert alert-success">
                        {{ Session::get('s_success_message') }} <strong>Thành công </strong>
                    </div>
                    @endif
                    @if (Cart::instance('saveForLater')->count() > 0)
                    <h3 class="box-title">Tên sản phẩm</h3>
                    <ul class="products-cart">
                        @foreach (Cart::instance('saveForLater')->content() as $item)
                        <li class="pr-cart-item">
                            <div class="product-image">
                                <figure><img src="{{ asset('assets/images/products/') }}/{{ $item->model->image}}" alt="{{ $item->model->name }}"></figure>
                            </div>
                            <div class="product-name">
                                <a class="link-to-product" href="{{ route('product.details',['slug'=>$item->model->slug] )}}">{{ $item->model->name }}</a>
                            </div>
                            @if ($item->model->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                        <div class="price-field produtc-price">
                            <p class="price">{{ number_format($item->model->sale_price,0,',',',') }} đ</p>
                        </div>
                        @else
                        <div class="price-field produtc-price">
                            <p class="price">{{ number_format($item->model->regular_price,0,',',',') }} đ</p>
                        </div>
                        @endif
                            <div class="quantity">
                                <p class="text-center btn btn-primary"><a style="color:white;" href="#" wire:click.prevent="moveToCart('{{ $item->rowId }}')">Chuyển về giỏ hàng</a></p>
                            </div>
                            <div class="price-field sub-total">
                                <p class="price">{{ number_format($item->subtotal,0,',',',') }} đ</p>
                            </div>
                            <div class="delete">
                                <a href="#" class="btn btn-delete" title="" wire:click.prevent="deleteFromSaveForLater('{{$item->rowId}}')">
                                    <span>Xoá sản phẩm</span>
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                </a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p>Bạn chưa lưu sản phẩm nào!</p>
                    @endif
                </div>
                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <h3 class="title-box">Sản phẩm nổi bật</h3>
                    <div class="wrap-products">
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>
                        @foreach ($popular_products as $popular)
                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                <a href="{{ route('product.details',['slug'=>$popular->slug])}}" title="{{ $popular->name }}">
                                            <figure><img src="{{ asset( 'assets/images/products/') }}//{{ $popular->image }}" alt="{{ $popular->name }}"></figure>
                                        </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                <a href="#" class="product-name"><span>{{ $popular->name }}</span></a>
                                        @if ($popular->sale_price > 0 && $sale->status ==1 && $sale->sale_date > Carbon\Carbon::now())
                                        <div class="wrap-price">
                                         <span class="product-price"> {{ number_format($popular->sale_price,0,',',',') }}đ </span>
                                            <span class="product-price product_regular_price"> {{ number_format($popular->regular_price,0,',',',') }}đ</span>
                                        </div>
                                        @else
                                        <div class="wrap-price"><span class="product-price">{{ number_format($popular->regular_price,0,',',',') }}<span class="price_unit">đ</span></span></div>
                                        @endif
                                </div>
                            </div>
                        @endforeach

                        </div>
                    </div>
                    <!--End wrap-products-->
                </div>

            </div>
            <!--end main content area-->
        </div>
        <!--end container-->

</main>
