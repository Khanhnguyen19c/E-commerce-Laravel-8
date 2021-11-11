<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
            <li class="item-link"><a href="{{ route('home')}}" class="link">Trang Chủ</a></li>
                <li class="item-link"><span>Thanh Toán</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <form wire:submit.prevent="placeOrder" onsubmit="$('#processing').show();">
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrap-address-billing">
                            <h3 class="box-title">Địa chỉ thanh toán</h3>
                            <div class="biling-address">
                                <p class="row-in-form">
                                    <label for="fname">First name<span>*</span></label>
                                    <input type="text" name="fname" value="" placeholder="họ của bạn" wire:model="firstname">
                                    @error('firstname')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="lname">Last name<span>*</span></label>
                                    <input type="text" name="lname" value="" placeholder="tên của bạn" wire:model="lastname">

                                    @error('lastname')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="email">Emaild:<span>*</span></label>
                                    <input type="email" name="email" value="" placeholder="Email của bạn" wire:model="email">

                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="phone">Số điện thoại<span>*</span></label>
                                    <input type="number" name="phone" value="" placeholder="số điện thoại" wire:model="mobile">

                                    @error('mobile')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Địa chỉ:<span>*</span></label>
                                    <input type="text" name="add" value="" placeholder="địa chỉ của bạn" wire:model="line">
                                    @error('line')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>

                                <p class="row-in-form">
                                    <label for="city">Tỉnh thành phố<span>*</span></label>
                                    <select class="form-control sel_city" wire:model="selectedCity">
                                        <option value="" selected>-Chọn thành phố-</option>
                                        @foreach($city as $city)
                                        <option value="{{ $city->id }}">{{ $city->name_city }}</option>
                                        @endforeach
                                    </select>

                                    @error('selectedCity')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                @if (!is_null($selectedCity))
                                <p class="row-in-form">
                                    <label for="city">Quận Huyện<span>*</span></label>
                                    <select class="form-control sel_province" wire:model="selectedProvince">
                                        <option value="" selected>-Chọn Quận huyện-</option>
                                        @foreach($province as $province)
                                        <option value="{{ $province->id }}">{{ $province->name_province }}</option>
                                        @endforeach
                                    </select>

                                    @error('selectedProvince')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                @endif
                                @if (!is_null($selectedProvince))
                                <p class="row-in-form">
                                    <label for="city">Xã/Phường<span>*</span></label>
                                    <select class="form-control sel_ward" wire:model="selectedWard">
                                        <option value="" selected>-Chọn xã phường-</option>
                                        @foreach($ward as $ward)
                                        <option value="{{ $ward->id }}">{{ $ward->name_ward }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedWard')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                @endif
                                <p class="row-in-form fill-wife">

                                    <label class="checkbox-field">
                                        <input name="different-add" id="different-add" type="checkbox" wire:model="ship_to_different">
                                        <span>Gửi đến một địa chỉ khác?</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                    </div>
                    @if ($ship_to_different)
                    <div class="col-md-12">
                        <div class="wrap-address-billing">
                            <h3 class="box-title">Địa chỉ giao hàng</h3>
                            <div class="biling-address">
                                <p class="row-in-form">
                                    <label for="fname">First name<span>*</span></label>
                                    <input type="text" name="fname" value="" placeholder="họ của bạn" wire:model="s_firstname">
                                    @error('firstname')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="lname">Last name<span>*</span></label>
                                    <input type="text" name="lname" value="" placeholder="tên của bạn" wire:model="s_lastname">
                                    @error('lastname')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="email">Email:<span>*</span></label>
                                    <input type="email" name="email" value="" placeholder="Email của bạn" wire:model="s_email">
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="phone">Số điện thoại<span>*</span></label>
                                    <input type="number" name="phone" value="" placeholder="số điện thoại" wire:model="s_mobile">
                                    @error('mobile')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Địa chỉ:<span>*</span></label>
                                    <input type="text" name="add" value="" placeholder="địa chỉ của bạn" wire:model="s_line">
                                    @error('line')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>


                            </div>
                        </div>
                    </div>
                    @endif

                </div>

                <div class="summary summary-checkout">
                    <div class="summary-item payment-method">
                        <h4 class="title-box">Phương thức thanh toán</h4>
                        @if ($paymentmode =='card')
                        @if(Session::has('stripe_error'))
                        <div class="alert alert-danger" role="alert">{{Session::get('stripe_error')}}</div>
                        @endif
                                <div class="wrap-address-billing">
                                    <p class="row-in-form">
                                        <label for="cart-no">Số thẻ:<span>*</span></label>
                                        <input type="text" name="add" value="" placeholder="nhập số thẻ của bạn" wire:model="card_no">
                                        @error('card_no')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </p>
                                    <p class="row-in-form">
                                    <label for="cart-no">Năm phát hành:<span>*</span></label>
                                        <input type="text" name="add" value="" placeholder="YYYY" wire:model="exp_year">
                                        @error('exp_year')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </p>
                            <p class="row-in-form">
                                <label for="cart-no">Tháng phát hành:<span>*</span></label>
                                <input type="text" name="add" value="" placeholder="MM" wire:model="exp_month">
                                @error('exp_month')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </p>
                            <p class="row-in-form">
                                <label for="cart-no">CVC:<span>*</span></label>
                                <input type="password" name="add" class="form-control" value="" placeholder="" wire:model="cvc">
                                @error('cvc')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </p>
                        </div>
                        @endif
                        <div class="choose-payment-methods">
                            <label class="payment-method">
                                <input name="payment-method" value="cod" type="radio" wire:model="paymentmode">
                                <span>Thanh toán khi nhận hàng</span>
                                <span class="payment-desc">Đặt hàng và thanh toán sau khi nhận được hàng</span>
                            </label>
                            <label class="payment-method">
                                <input name="payment-method" value="card" type="radio" wire:model="paymentmode">
                                <span>Debit / Credit Card</span>
                                <span class="payment-desc">Thanh toán bằng thẻ ghi nợ, hoặc thẻ tính dụng </span>
                            </label>
                            <span class="text-danger">*Vui lòng thanh toán trước PayPal khi check vào Ô này</span>
                            <label class="payment-method">

                                <input name="payment-method" value="paypal" type="radio" wire:model="paymentmode">
                                <span>Paypal</span>
                                <span class="payment-desc">Bạn có thể thanh toán bằng tín dụng của mình</span>
                                <div class="payment-desc" id="paypal-button" style="display: block;"></div>
                                <input type="hidden" id="vnd_to_usd" value="{{round($vnd_to_usd,2)}}">
                            </label>
                            @error('paymentmode')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        @if(Session::has('checkout'))
                        <p class="summary-info grand-total"><span>Tổng cộng:</span> <span class="grand-total-price">{{ number_format(session::get('checkout')['total'],0,',',',')}}đ</span></p>
                        @endif
                        @if ($errors->isEmpty())
                        <div wire:ignore id="processing" style="font-size: 22px; margin-bottom: 20px; padding-left: 37px; color: green;display:none">
                            <i class="fa fa-spinner fa-pulse fa-fw"></i>
                            <span>Vui Lòng Chờ...</span>
                        </div>
                        @endif
                        <button type="submit" class="btn btn-medium">Đặt hàng ngay bây giờ</button>
                    </div>
                    <div class="summary-item shipping-method">
                        <h4 class="title-box f-title">Phương pháp vận chuyển</h4>
                        @if(session::has('coupon'))
                        <h4 class="title-box">Mã giảm giá: <span class="price_unit">{{ Session::get('coupon')['code'] }}</span></h4>
                        @endif

                    </div>
                </div>
            </form>

        </div>
        <!--end main content area-->
    </div>
    <!--end container-->

</main>
@push('scripts')
<script>
    $(document).ready(function() {
        $('.sel_city').select2();
        $('.sel_city').on('change', function(e) {
            var data = $('.sel_city').select2("val");
            @this.set('selectedCity', data);
        });
    });
</script>
<script>
    var usd = document.getElementById("vnd_to_usd").value;
    paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
            sandbox: 'demo_sandbox_client_id',
            production: 'demo_production_client_id'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        payment: function(data, actions) {
            return actions.payment.create({
                transactions: [{
                    amount: {
                        total: `${usd}`,
                        currency: 'USD'
                    }
                }]
            });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                // Show a confirmation message to the buyer
                swal('Thông Báo', 'Bạn đã thanh toán vui lòng nhập thông tin để chuyển hàng!', 'success');
            });
        }
    }, '#paypal-button');
</script>
@endpush
