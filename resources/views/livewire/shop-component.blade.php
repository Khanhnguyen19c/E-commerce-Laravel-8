<main id="main" class="main-site left-sidebar">
		<div class="container">
			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="{{ route('home') }}" class="link">home</a></li>
					<li class="item-link"><span>Digital & Electronics</span></li>
				</ul>
			</div>
			<div class="row">
				<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

					<div class="banner-shop">
						<a href="#" class="banner-link">
                        <figure><img src=" {{ asset('assets/images/shop-banner.jpg') }}" alt=""></figure>
						</a>
					</div>
					<div class="wrap-shop-control">

						<h1 class="shop-title">Digital & Electronics</h1>

						<div class="wrap-right">

							<div class="sort-item orderby ">
								<select name="orderby" class="use-chosen" wire:model="sorting">
									<option value="default" selected="selected">Mặc định</option>
									<option value="date">Sắp xếp theo độ mới</option>
									<option value="price">Sắp xếp theo giá: thấp đến cao</option>
									<option value="price-desc">Sắp xếp theo giá: cao xuống thấp</option>
								</select>
							</div>

							<div class="sort-item product-per-page">
								<select name="post-per-page" class="use-chosen" wire:model="pagesize">
									<option value="12" selected="selected">12 sản phẩm</option>
									<option value="16">16 sản phẩm</option>
									<option value="18">18 sản phẩm</option>
									<option value="21">21 sản phẩm</option>
									<option value="24">24 sản phẩm</option>
									<option value="30">30 sản phẩm</option>
									<option value="32">32 sản phẩm</option>
								</select>
							</div>

							<div class="change-display-mode">
								<a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
								<a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
							</div>

						</div>

					</div><!--end wrap shop control-->

					<div class="row">
						<ul class="product-list grid-products equal-container">
                        @php
                        $witems = Cart::instance('wishlist')->content()->pluck('id');
                        @endphp
                        @foreach ($products as $product)
							<li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
								<div class="product product-style-3 equal-elem ">
									<div class="product-thumnail">

										<a href="{{ route('product.details',['slug'=>$product->slug])}}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
											<figure><img src=" {{ asset('assets/images/products') }}/{{ $product->image }}" alt="{{ $product->name }}"></figure>
										</a>
									</div>
									<div class="product-info">
                                    <a href="{{ route('product.details',['slug'=>$product->slug])}}"><span>{{ $product->name }}</span></a>
                                    @if ($product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                                         <div class="wrap-price">
                                         <span class="product-price"> {{ number_format($product->sale_price,0,',',',') }} đ</span>
                                            <span class="product-price" style="text-decoration: line-through;"> {{ number_format($product->regular_price,0,',',',') }} đ</span></>
                                        </div>
                                        <a href="#" class="btn add-to-cart" wire:click.prevent="store({{$product->id}},'{{ $product->name }}',{{ $product->sale_price }})">Thêm giỏ hàng</a>
                                        @else
                                        <div class="wrap-price">
                                        <span class="product-price"> {{ number_format($product->regular_price,0,',',',') }} đ</span>
                                        </div>
                                        <a href="#" class="btn add-to-cart" wire:click.prevent="store({{$product->id}},'{{ $product->name }}',{{ $product->regular_price }})">Thêm giỏ hàng</a>
                                        @endif


                                    <div class="product-wish">
                                    @if ($witems->contains($product->id))
                                    <a href="#" wire:click.prevent="removeFromWishlist({{$product->id}})"><i class="fa fa-heart fill-heart"></i></a>
                                    @else
                                    <a href="#" wire:click.prevent="addToWishlist({{$product->id}},'{{ $product->name }}',{{ $product->regular_price }})"><i class="fa fa-heart"></i></a>
                                    @endif
                                </div>
                                    </div>
								</div>
							</li>
                            @endforeach

						</ul>

					</div>

					<div class="wrap-pagination-info">
                        {{ $products->links() }}

					</div>
				</div><!--end main products area-->

				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
					<div class="widget mercado-widget categories-widget">
						<h2 class="widget-title">Danh Mục sản phẩm</h2>
						<div class="widget-content">
							<ul class="list-category">
								@foreach ($categories as $category)

								<li class="category-item">
									<a href="{{ route('product.category',['category_slug'=>$category->slug]) }}" class="cate-link">{{ $category->name }}</a>
								</li>
                                @endforeach
							</ul>
						</div>
					</div><!-- Categories widget-->

					<div class="widget mercado-widget filter-widget brand-widget">
						<h2 class="widget-title">Brand</h2>
						<div class="widget-content">
							<ul class="list-style vertical-list list-limited" data-show="6">
								<li class="list-item"><a class="filter-link active" href="#">Fashion Clothings</a></li>

								<li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>' class="btn-control control-show-more" href="#">Show more<i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div><!-- brand widget-->

					<div class="widget mercado-widget filter-widget price-filter">
						<h2 class="widget-title">Lọc giá: <span class="text-info">{{ number_format($min_price,0,',',',') }} - {{  number_format($max_price,0,',',',')}}<span class="price_unit" >đ</span></span></h2>
						<div class="widget-content" style="padding: 10px 5px 40px 5px;">
							<div id="slider" wire:ignore>
                            </div>
                        </div>
					</div><!-- Price-->

					<div class="widget mercado-widget filter-widget">
						<h2 class="widget-title">Color</h2>
						<div class="widget-content">
							<ul class="list-style vertical-list has-count-index">
								<li class="list-item"><a class="filter-link " href="#">Red <span>(217)</span></a></li>
								<li class="list-item"><a class="filter-link " href="#">Yellow <span>(179)</span></a></li>
								<li class="list-item"><a class="filter-link " href="#">Black <span>(79)</span></a></li>
								<li class="list-item"><a class="filter-link " href="#">Blue <span>(283)</span></a></li>
								<li class="list-item"><a class="filter-link " href="#">Grey <span>(116)</span></a></li>
								<li class="list-item"><a class="filter-link " href="#">Pink <span>(29)</span></a></li>
							</ul>
						</div>
					</div><!-- Color -->

					<div class="widget mercado-widget filter-widget">
						<h2 class="widget-title">Size</h2>
						<div class="widget-content">
							<ul class="list-style inline-round ">
								<li class="list-item"><a class="filter-link active" href="#">s</a></li>
								<li class="list-item"><a class="filter-link " href="#">M</a></li>
								<li class="list-item"><a class="filter-link " href="#">l</a></li>
								<li class="list-item"><a class="filter-link " href="#">xl</a></li>
							</ul>
							<div class="widget-banner">
								<figure><img src=" {{ asset('assets/images/size-banner-widget.jpg') }}" width="270" height="331" alt=""></figure>
							</div>
						</div>
					</div><!-- Size -->

					<div class="widget mercado-widget widget-product">
						<h2 class="widget-title">SẢN PHẨM PHỔ BIẾN</h2>
						<div class="widget-content">
							<ul class="products">
								<li class="product-item">
									<div class="product product-widget-style">
										<div class="thumbnnail">
											<a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
												<figure><img src=" {{ asset('assets/images/products/digital_01.jpg') }}" alt=""></figure>
											</a>
										</div>
										<div class="product-info">
											<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
											<div class="wrap-price"><span class="product-price">$168.00</span></div>
										</div>
									</div>
								</li>

								<li class="product-item">
									<div class="product product-widget-style">
										<div class="thumbnnail">
											<a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
												<figure><img src=" {{ asset('assets/images/products/digital_17.jpg') }}" alt=""></figure>
											</a>
										</div>
										<div class="product-info">
											<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
											<div class="wrap-price"><span class="product-price">$168.00</span></div>
										</div>
									</div>
								</li>

								<li class="product-item">
									<div class="product product-widget-style">
										<div class="thumbnnail">
											<a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
												<figure><img src=" {{ asset('assets/images/products/digital_18.jpg') }}" alt=""></figure>
											</a>
										</div>
										<div class="product-info">
											<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
											<div class="wrap-price"><span class="product-price">$168.00</span></div>
										</div>
									</div>
								</li>

								<li class="product-item">
									<div class="product product-widget-style">
										<div class="thumbnnail">
											<a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
												<figure><img src=" {{ asset('assets/images/products/digital_20.jpg') }}" alt=""></figure>
											</a>
										</div>
										<div class="product-info">
											<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
											<div class="wrap-price"><span class="product-price">$168.00</span></div>
										</div>
									</div>
								</li>

							</ul>
						</div>
					</div><!-- brand widget-->

				</div><!--end sitebar-->

			</div><!--end row-->

		</div><!--end container-->
	</main>
@push('scripts')
    <script>
        var slider = document.getElementById('slider');
        noUiSlider.create(slider,{
            start : [100000,5000000],
            connect:true,
            range :{
                'min' : 100000,
                'max' : 20000000
            },
            pips:{
                mode:'steps',
                stepped:true,
                density:4
            }
        });
        slider.noUiSlider.on('update',function(value){
            @this.set('min_price',value[0]);
            @this.set('max_price',value[1]);
        });
    </script>
@endpush
