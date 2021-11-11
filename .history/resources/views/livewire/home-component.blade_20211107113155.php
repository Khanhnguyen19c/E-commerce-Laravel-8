<main id="main">
    <div class="container">
        <style>
            .wrap-main-slide .slide-carousel .slide-info.slide-1 {
                background-color: #e8dfdf57;
                border-radius: 5px;
                padding-right: 2px;
                padding: 0px 15px;
            }

            /* .equal-elem{
            border: 1px solid #8080800f;
            margin-right: 15px;
            box-shadow: 0px 1px 3px;
} */
        </style>
        <!--MAIN SLIDE-->
        <div class="wrap-main-slide">
            <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
                @foreach ($sliders as $slider)
                <div class="background">
                    <div class="item-slide">
                        <img src="{{ asset('assets/images/sliders') }}/{{$slider->image}}" alt="{{$slider->title}}" class="img-slide">
                        <div class="slide-info slide-1">
                            <h2 class="f-title"><b>{{ $slider->title }} </b></h2>
                            <span class="subtitle">{{ $slider->subtitle }} </span>
                            <p class="sale-info">Giá chỉ từ: <span class="price">{{ number_format($slider->price,0,',',',') }} Đ</span></p>
                            <a href="{{$slider->link}}" class="btn-link">Mua Sắm Ngay</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!--BANNER-->
        <div class="wrap-banner style-twin-default">
            @foreach ($banners as $banner)
            <div class="banner-item">
                <a href="#" class="link-banner banner-effect-1">
                    <figure><img src="{{ asset('assets/images/sliders') }}/{{$banner->image}}" alt="{{$banner->title}}" width="580" height="190"></figure>
                </a>
            </div>
            @endforeach
        </div>

        <!--On Sale-->
        @if ($sale_products->count() > 0 && $sale->status ==1 && $sale->sale_date > Carbon\Carbon::now() )

        <div class="wrap-show-advance-info-box style-1 has-countdown">
            <h3 class="title-box">Sale Sập Sàng</h3>
            <div class="wrap-countdown mercado-countdown" data-expire="{{ Carbon\Carbon::parse($sale->sale_date)->format('Y/m/d h:m:s') }}"></div>
            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                @foreach ($sale_products as $sale_product)
                <div class="product product-style-2 equal-elem ">
                    <div class="product-thumnail">
                        <a href="{{ route('product.details',['slug'=>$sale_product->slug]) }}" title="{{$sale_product->name }}">
                            <figure><img src="{{ asset('assets/images/products') }}/{{ $sale_product->image }}" width="800" height="800" alt="{{$sale_product->name }}"></figure>
                        </a>
                        <div class="group-flash">
                            <span class="flash-item sale-label">Sale</span>
                        </div>
                        <div class="wrap-btn">
                            <a href="#" class="function-link">Xem Nhanh</a>
                        </div>
                    </div>
                    <div class="product-info">
                        <a href="#" class="product-name"><span>{{$sale_product->name }}</span></a>
                        <div class="wrap-price"><span class="product-price">{{number_format($sale_product->sale_price,0,',',',') }}đ</span>
                            <span class="product-price product_regular_price"> {{ number_format($sale_product->regular_price,0,',',',') }}đ</span>
                        </div>
                    </div>
                </div>

                @endforeach

            </div>
        </div>
        @endif
        <!--Latest Products-->
        <div class="wrap-show-advance-info-box style-1">
            <h3 class="title-box">SẢN PHẨM MỚI NHẤT</h3>
            <div class="wrap-top-banner">
                <a href="#" class="link-banner banner-effect-2">
                    <figure><img src="{{ asset('assets/images/sliders') }}/{{$new_product_banner->image}}" alt="{{$new_product_banner->title}}" width="1170" height="240"></figure>
                </a>
            </div>
            <div class="wrap-products">
                <div class="wrap-product-tab tab-style-1">
                    <div class="tab-contents">
                        <div class="tab-content-item active" id="digital_1a">
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                                @foreach ($lproducts as $lproduct)
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{ route('product.details',['slug'=>$lproduct->slug])}}" title="{{ $lproduct->name }}">
                                            <figure><img src="{{ asset('assets/images/products') }}/{{$lproduct->image}}" width="800" height="800" alt="{{ $lproduct->name }}"></figure>
                                        </a>
                                        <div class="group-flash">
                                            <span class="flash-item new-label">New</span>
                                        </div>
                                        <div class="wrap-btn">
                                            <a href="#" class="function-link">Xem nhanh</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="product-name"><span>{{ $lproduct->name }}</span></a>
                                        @if ($lproduct->sale_price > 0 && $sale->status ==1 && $sale->sale_date > Carbon\Carbon::now() )
                                        <div class="wrap-price">
                                            <span class="product-price"> {{ number_format($lproduct->sale_price,0,',',',') }}đ</span>
                                            <span class="product-price product_regular_price"> {{ number_format($lproduct->regular_price,0,',',',') }}đ</span></>
                                        </div>
                                        @else
                                        <div class="wrap-price">
                                            <span class="product-price"> {{ number_format($lproduct->regular_price,0,',',',') }} đ</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Product Categories-->
        <div class="wrap-show-advance-info-box style-1">
            <h3 class="title-box">Danh Mục Sản Phẩm</h3>
            <div class="wrap-top-banner">
                <a href="#" class="link-banner banner-effect-2">
                    <figure><img src="{{ asset('assets/images/sliders') }}/{{$product_banner->image}}" width="1170" height="240" alt="{{$product_banner->name}}"></figure>
                </a>
            </div>
            <div class="wrap-products">
                <div class="wrap-product-tab tab-style-1">
                    <div class="tab-control">
                        @foreach ($categories as $key=> $category)
                        <a href="#cateogry_{{ $category->id }}" class="tab-control-item {{$key==0 ? 'active':'' }}">{{$category->name}}</a>
                        @endforeach
                    </div>
                    <div class="tab-contents">
                        @foreach ($categories as $key=>$category)
                        <div class="tab-content-item {{$key==0 ? 'active':'' }}" id="cateogry_{{ $category->id }}">
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                                @php
                                $c_products = DB::table('products')->where('category_id',$category->id)->get()->take($no_of_products);
                                @endphp
                                @foreach ($c_products as $c_product)
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{ route('product.details',['slug'=>$c_product->slug]) }}" title="{{$c_product->name}}">
                                            <figure><img src="{{ asset('assets/images/products') }}/{{$c_product->image}}" width="800" height="800" alt="{{$c_product->name}}"></figure>
                                        </a>
                                        <div class="group-flash">
                                            <span class="flash-item new-label">New</span>
                                        </div>
                                        <div class="wrap-btn">
                                            <button type="button" class="function-link">Xen Nhanh</button>
                                        </div>
                                        <div class="modal" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Modal body text goes here.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('product.details',['slug'=>$c_product->slug]) }}" class="product-name"><span>{{$c_product->name}}</span></a>
                                        @if ($c_product->sale_price > 0 && $sale->status ==1 && $sale->sale_date > Carbon\Carbon::now() )
                                        <div class="wrap-price">
                                            <span class="product-price"> {{ number_format($c_product->sale_price,0,',',',') }}đ</span>
                                            <span class="product-price product_regular_price"> {{ number_format($c_product->regular_price,0,',',',') }}đ</span></>
                                        </div>
                                        @else
                                        <div class="wrap-price">
                                            <span class="product-price"> {{ number_format($c_product->regular_price,0,',',',') }} đ</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
