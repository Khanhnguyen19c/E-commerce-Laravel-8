<main id="main" class="main-site">
    <style>
        .regprice {
            font-weight: 300;
            font-size: 16px !important;
            color: gray !important;
            text-decoration: line-through;
            padding-left: 10px;
        }

        #description {
            height: 265px;
        }

        .block {
            display: block;
        }

        .none {
            display: none;
        }

        .desc_btn {
            position: absolute;
            bottom: -20px;
            left: 50%;
        }

        .desc_btn #show {
            color: #2087f1;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;

        }
        .desc_btn #show::after{
            content: '';
            width: 0;
            right: 0;
            border-top: 6px solid #288ad6;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            display: inline-block;
            vertical-align: middle;
            margin: -2px 0 0 5px;
        }
        .desc_btn #hidden {
            color: #2087f1;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }
        .desc_btn #hidden::after{
            content: '';
            width: 0;
            right: 0;
            border-top: 6px solid #288ad6;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            display: inline-block;
            vertical-align: middle;
            margin: -2px 0 0 5px;
            transform: rotate(180deg);
        }
        .color-gray {
            color: #e6e6e6 !important;
        }

        .width-0-peccent {
            width: 0%;
        }

        .width-20-peccent {
            width: 20%;
        }

        .width-40-peccent {
            width: 40%;
        }

        .width-60-peccent {
            width: 60%;
        }

        .width-80-peccent {
            width: 80%;
        }

        .width-100-peccent {
            width: 100%;
        }
        .owl-prev, .owl-next{
            display: none;
        }

        .product-gallery{
            cursor: pointer;
        }
    </style>
    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="{{ route('home') }}" class="link">Trang chủ</a></li>
                <li class="item-link"><a href="{{ route('product.category',['category_slug'=>$category->slug]) }}" class="link">{{$category->name}}</a></li>
                @if (count($category->subCategory)>0)
                <li class="item-link"><a href="{{ route('product.category',['category_slug'=>$category->slug,'scategory_slug'=>$scategory->slug]) }}" class="link">{{$scategory->name}}</a></li>
                @endif
                <li class="item-link"><span>{{$product->name}}</span></li>
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                <div class="wrap-product-detail">
                    <div class="detail-media">
                        <div class="product-gallery" wire:ignore>
                            <ul class="slides">
                                <li data-thumb="{{ asset( 'assets/images/products/') }}/{{ $product->image }}" >
                                    <img src="{{ asset( 'assets/images/products/') }}/{{ $product->image }}" alt="{{ $product->name }}" />
                                </li>
                                @php
                                    $images = explode(",",$product->images);
                                @endphp
                                @foreach ($images as $image)
                                @if ($image)
                                <li data-thumb="{{ asset( 'assets/images/products/') }}/{{ $image }}">
                                    <img src="{{ asset( 'assets/images/products/') }}/{{ $image }}" alt="{{ $product->name }}" />
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="detail-info">
                        <h2 class="product-name">{{ $product->name }}</h2>
                        <div class="product-rating">
                            @php
                            $avgrating =0;
                            @endphp
                            @foreach ($product->orderItems->where('rstatus',1) as $orderItem)
                            @php
                            $avgrating = $avgrating + $orderItem->review->rating;
                            @endphp
                            @endforeach
                            @for ($i=1;$i <= 5;$i++) @if ($i <=$avgrating) <i class="fa fa-star" aria-hidden="true"></i>
                                @else
                                <i class="fa fa-star color-gray" aria-hidden="true"></i>
                                @endif
                                @endfor
                                <a href="#" class="count-review">({{ $product->orderItems->where('rstatus',1)->count() }} đánh giá)</a>
                        </div>
                        <div class="short-desc">
                            {!! $product->short_desc !!}
                        </div>
                        <div class="wrap-social" wire:ignore>
                        <div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>
                        <div class="fb-share-button" data-href="{{$url_canonical}}" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?{{$url_canonical}}" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                        <div class="g-ytsubscribe" data-channel="GoogleDevelopers" data-layout="default" data-count="hidden"></div>
                        <a href="https://twitter.com/share?ref_src={{$url_canonical}}" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                        @if ($product->sale_price > 0 && $sale->status ==1 && $sale->sale_date > Carbon\Carbon::now())
                        <div class="wrap-price">
                            <span class="product-price">{{ number_format($product->sale_price,0,',',',') }}<span class="price_unit">đ</span></span>
                            <del><span class="product-price regprice">{{ number_format($product->regular_price,0,',',',') }}<span class="price_unit">đ</span></span></del>
                        </div>
                        @else
                        <div class="wrap-price"><span class="product-price">{{ number_format($product->regular_price,0,',',',') }}<span class="price_unit">đ</span></span></div>
                        @endif
                        <div class="stock-info in-stock">
                            <p class="availability">Tình Trạng: <b>{{ $product->stock_status}}</b></p>
                        </div>
                        <div>
                            @foreach ($product->attributevalues->unique('product_attribute_id') as $av)
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-xs-2">
                                    <p>{{$av->productAttribute->name}}</p>
                                    <div class="col-xs-10">
                                        <select class="form-control" style="width:  200px;" wire:model="satt.{{$av->productAttribute->name}}">
                                        @foreach ($av->productAttribute->attributeValues->where('product_id',$product->id) as $pav )
                                        <option value="{{$pav->value}}">{{$pav->value}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="quantity" style="margin-top: 10px;">
                            <span>Số Lượng:</span>
                            <div class="quantity-input">
                                <input type="text" disabled name="product-quatity" value="1" min="1" max="{{ $product->quantity}}" data-max="{{ $product->quantity}}" pattern="[0-9]*" wire:model="qty">
                                <a class="btn btn-reduce" href="#" wire:click.prevent="decreseQuantity"></a>
                                <a class="btn btn-increase" href="#" wire:click.prevent="increaseQuantity"></a>
                            </div>
                        </div>
                        <div class="wrap-butons">
                            @if ($product->sale_price > 0 && $sale->status ==1 && $sale->sale_date > Carbon\Carbon::now())
                            <a href="#" class="btn add-to-cart" wire:click.prevent="store({{$product->id}},'{{ $product->name }}',{{ $product->sale_price }})">Thêm giỏ hàng</a>
                            @else
                            <a href="#" class="btn add-to-cart" wire:click.prevent="store({{$product->id}},'{{ $product->name }}',{{ $product->regular_price }})">Thêm giỏ hàng</a>
                            @endif
                            @php
                            $witems = Cart::instance('wishlist')->content()->pluck('id');
                            @endphp
                            <div class="wrap-btn">
                                <a href="#" class="btn btn-compare">Thêm so sánh</a>
                                @if ($witems->contains($product->id))
                                <a href="#" class="btn btn-wishlist" wire:click.prevent="removeFromWishlist({{$product->id}})">Bỏ yêu thích</a>
                                @else
                                <a href="#" class="btn btn-wishlist" wire:click.prevent="addToWishlist({{$product->id}},'{{ $product->name }}',{{ $product->regular_price }})">Thêm yêu thích</a>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="advance-info">
                        <div class="tab-control normal">
                            <a href="#description" class="tab-control-item active">Mô tả</a>
                            <a href="#add_infomation" class="tab-control-item">Thông tin chi tiết</a>
                            <a href="#review" class="tab-control-item">Đánh giá</a>
                        </div>
                        <div class="tab-contents">
                            <div class="tab-content-item active" id="description" style="margin-bottom: 30px;">
                                {!! $product->desc !!}
                                <div class="desc_btn">
                                    <p class="btn btn-secondary button_show" id="show">Hiển thị thêm...</p>
                                    <p class="button_hidden none" id="hidden">Ẩn bớt...</p>
                                </div>
                            </div>

                            <!-- <div class="tab-content-item " id="add_infomation">

                                <table class="shop_attributes">
                                    <tbody>
                                        <tr>
                                            <th>Weight</th>
                                            <td class="product_weight">1 kg</td>
                                        </tr>
                                        <tr>
                                            <th>Dimensions</th>
                                            <td class="product_dimensions">12 x 15 x 23 cm</td>
                                        </tr>
                                        <tr>
                                            <th>Color</th>
                                            <td>
                                                <p>Black, Blue, Grey, Violet, Yellow</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> -->
                            <div class="tab-content-item " id="review">

                                <div class="wrap-review-form">

                                    <div id="comments">
                                        <h2 class="woocommerce-Reviews-title">{{ $product->orderItems->where('rstatus',1)->count(); }} đánh giá cho <span>{{$product->name}}</span></h2>
                                        <ol class="commentlist">
                                            @foreach ($product->orderItems->where('rstatus',1) as $orderItem)
                                            <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
                                                <div id="comment-20" class="comment_container">
                                                    @if ($orderItem->order->user->profile->image != null)
                                                    <img alt="{{ $orderItem->order->user->name }}" src="{{ asset('assets/images/profile') }}/{{$orderItem->order->user->profile->image}}" height="80" width="80">
                                                    @else
                                                    <img alt="{{ $orderItem->order->user->name }}" src="{{ asset('assets/images/profile/profile_dummyDefault.png') }}" height="80" width="80">
                                                    @endif
                                                    <div class="comment-text">
                                                        <div class="star-rating">
                                                            <span class="width-{{ $orderItem->review->rating * 20}}-peccent">Sao <strong class="rating">{{ $orderItem->review->rating }}</strong> out of 5</span>
                                                        </div>
                                                        <p class="meta">
                                                            <strong class="woocommerce-review__author">{{ $orderItem->order->user->name }}</strong>
                                                            <span class="woocommerce-review__dash">–</span>
                                                            <time class="woocommerce-review__published-date" datetime="2008-02-14 20:00">{{ Carbon\Carbon::parse($orderItem->review->created_at)->format('d F Y g:i A') }}</time>
                                                        </p>
                                                        <div class="description">
                                                            <p>{{ $orderItem->review->comment }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ol>
                                    </div><!-- #comments -->



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end main products area-->

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                <div class="widget widget-our-services ">
                    <div class="widget-content">
                        <ul class="our-services">

                            <li class="service">
                                <a class="link-to-service" href="#">
                                    <i class="fa fa-truck" aria-hidden="true"></i>
                                    <div class="right-content">
                                        <b class="title">Free Shipping</b>
                                        <span class="subtitle">Cho đơn hàng trên 3 triệu đồng</span>
                                        <p class="desc">{{Substr($setting->criteria1,0,150)}}...</p>
                                    </div>
                                </a>
                            </li>

                            <li class="service">
                                <a class="link-to-service" href="#">
                                    <i class="fa fa-gift" aria-hidden="true"></i>
                                    <div class="right-content">
                                        <b class="title">Special Offer</b>
                                        <span class="subtitle">Nhận ngay Nhiều Voucher hấp dẫn!</span>
                                        <p class="desc">{{Substr($setting->criteria2,0,150)}}...</p>
                                    </div>
                                </a>
                            </li>

                            <li class="service">
                                <a class="link-to-service" href="#">
                                    <i class="fa fa-reply" aria-hidden="true"></i>
                                    <div class="right-content">
                                        <b class="title">Order Return</b>
                                        <span class="subtitle">Đổi trả, bảo hành cam kết chất lượng</span>
                                        <p class="desc">{{Substr($setting->criteria3,0,150)}}...</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div><!-- Categories widget-->

                <div class="widget mercado-widget widget-product">
                    <h2 class="widget-title">SẢN PHẨM PHỔ BIẾN</h2>
                    <div class="widget-content">
                        <ul class="products">
                            @foreach ($popular_products as $popular)
                            <li class="product-item">
                                <div class="product product-widget-style">
                                    <div class="thumbnnail">
                                        <a href="{{ route('product.details',['slug'=>$popular->slug])}}" title="{{ $popular->name }}">
                                            <figure><img src="{{ asset( 'assets/images/products/') }}//{{ $popular->image }}" alt="{{ $popular->name }}"></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="product-name"><span>{{ $popular->name }}</span></a>
                                        @if ($popular->sale_price > 0 && $sale->status ==1 && $sale->sale_date > Carbon\Carbon::now())
                                        <div class="wrap-price"><span class="product-price">{{ number_format($popular->sale_price,0,',',',') }}<span class="price_unit">đ</span></span>
                                        <span class="product-price product_regular_price"> {{ number_format($popular->regular_price,0,',',',') }}đ</span>
                                    </div>

                                        @else
                                        <div class="wrap-price"><span class="product-price">{{ number_format($popular->regular_price,0,',',',') }}<span class="price_unit">đ</span></span></div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

            </div>
            <!--end sitebar-->
            <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <h3 class="title-box">Sản phẩm liên quan</h3>
                    <div class="wrap-products" >
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="4" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' wire:ignore>
                            @foreach ($related_products as $r_product)
                            <div class="product product-style-2 equal-elem" >
                                <div class="product-thumnail">
                                    <a href="{{ route('product.details',['slug'=>$r_product->slug])}}" title="{{ $r_product->name }}">
                                        <figure><img src="{{ asset('assets/images/products') }}/{{ $r_product->image }}" width="214" height="214" alt="{{ $r_product->name }}"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a class="product-name" href="{{ route('product.details',['slug'=>$r_product->slug])}}" title="{{ $r_product->name }}"><span>{{ $r_product->name }}</span></a>

                                        @if ($r_product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                        <div class="wrap-price"><span class="product-price">{{ number_format($r_product->sale_price,0,',',',') }}<span class="price_unit">đ</span></span>
                                        <span class="product-price product_regular_price"> {{ number_format($r_product->regular_price,0,',',',') }}đ</span>
                                        </div>


                                        @else
                                        <div class="wrap-price"><span class="product-price">{{ number_format($r_product->regular_price,0,',',',') }}<span class="price_unit" style="color: #e91261;">đ</span></span></div>
                                        @endif
                                </div>
                            </div>
                            @endforeach
                    </div>
                    <!--End wrap-products-->
                </div>
            </div>

        </div>
        <!--end row-->

    </div>
    <!--end container-->

</main>
@push('scripts')
<script>
    $(document).on('click', '#show', function() {
        $(".button_show").toggleClass('none');
        $(".button_hidden").toggleClass('none');
        $('#description').css('height', 'auto');
    });
    $(document).on('click', '#hidden', function() {
        $(".button_show").toggleClass('none');
        $(".button_hidden").toggleClass('none');
        $('#description').css('height', '265px');
    });
</script>
@endpush
