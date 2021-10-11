
  @if (Cart::instance('wishlist')->count() > 0)
<div class="wrap-icon-section wishlist">
    <a href="{{ route('product.wishlist') }}" class="link-direction">
        <i class="fa fa-heart fill-heart" aria-hidden="true"></i>
        <div class="left-info">
            <span class="index heart-item">{{Cart::instance('wishlist')->count()}} items</span>
            <span class="title">Yêu Thích</span>
        </div>
    </a>
</div>
@else
<div class="wrap-icon-section wishlist">
    <a href="#" class="link-direction">
        <i class="fa fa-heart " aria-hidden="true"></i>
        <div class="left-info">
            <span class="index">0 items</span>
            <span class="title">Yêu Thích</span>
        </div>
    </a>
</div>
@endif
