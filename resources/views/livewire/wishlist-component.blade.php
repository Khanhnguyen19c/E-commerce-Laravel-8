<main id="main" class="main-site left-sidebar">
    <div class="container">
        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="{{ route('home') }}" class="link">Trang Chủ</a></li>
                <li class="item-link"><span>Yêu Thích</span></li>
            </ul>
        </div>
        <div class="row">
            @if(Cart::instance('wishlist')->content()->count() > 0 )
            <ul class="product-list grid-products equal-container">
                @foreach (Cart::instance('wishlist')->content() as $item)
                <li class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ">
                    <div class="product product-style-3 equal-elem ">
                        <div class="product-thumnail">
                            <a href="{{ route('product.details',['slug'=>$item->model->slug])}}" title="{{ $item->model->name }}">
                                <figure><img src=" {{ asset('assets/images/products') }}/{{ $item->model->image }}" alt="{{ $item->model->name }}"></figure>
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="{{ route('product.details',['slug'=>$item->model->slug])}}"><span>{{ $item->model->name }}</span></a>
                            @if ($item->model->sale_price > 0 && $sale->status ==1 && $sale->sale_date > Carbon\Carbon::now() )
                            <div class="wrap-price">
                                <span class="product-price"> {{ number_format($item->model->sale_price,0,',',',') }}đ</span>
                                <span class="product-price product_regular_price"> {{ number_format($item->model->regular_price,0,',',',') }}đ</span></>
                            </div>
                            @else
                            <div class="wrap-price">
                                <span class="product-price"> {{ number_format($item->model->regular_price,0,',',',') }} đ</span>
                            </div>
                            @endif
                            <a href="#" class="btn add-to-cart" wire:click.prevent="moveProductFromWishlistToCart('{{$item->rowId}}')">Chuyển vào giỏ hàng</a>
                            <div class="product-wish">
                                <a href="#" wire:click.prevent="removeFromWishlist({{$item->model->id}},'{{ $item->model->name }}',{{ $item->model->regular_price }})"><i class="fa fa-heart fill-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach

            </ul>
            @else
            <h4>Bạn chưa có sản phẩm yêu thích nào!</h4>
            @endif
        </div>
    </div>
</main>
