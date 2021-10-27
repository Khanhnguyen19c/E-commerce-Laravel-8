<div>
    <div class="container" style="padding: 30px 0;">
    <div class="row">
                <div class="col-md-12">
                    @if (Session::has('order_message'))
                        <div class="alert alert-success" role="alert">{{Session::get('order_message')}}</div>
                    @endif
                <div class="panel panel-default">
                <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                        <div class="row">
                            <div class="col-md-6">
                                Chi tiết đơn hàng
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('user.orders')}}" class="btn btn-success pull-right">Đơn hàng của tôi</a>
                                @if ($order->status =='ordered')
                                <a href="#" class="btn btn-warning pull-right" style="margin-right:20px;" wire:click.prevent="cancelOrder">Huỷ đơn hàng</a>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                        <th>Mã đơn</th>
                        <td>{{$order->id }}</td>
                        <th>Ngày đặt</th>
                        <td>{{$order->created_at }}</td>
                        <th>Trạng thái</th>
                        @if ($order->status =='delivered')
                        <td>Đã giao hàng</td>
                        <th>Ngày giao hàng</th>
                        <td>{{$order->delivered_date }}</td>
                        @elseif ($order->status =='canceled')
                        <td>Đã huỷ đơn</td>
                        <th>Ngày huỷ đơn</th>
                        <td>{{$order->canceled_date }}</td>
                        @else
                        <td>Chưa xử lý</td>
                        @endif
                        </table>
                    </div>
                </div>
                </div>
            </div>
    <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                        Danh sách sản phẩm
                    </div>
                    <div class="panel-body">
                        <div class=" main-content-area">

                            <div class="wrap-iten-in-cart">

                                <h3 class="box-title">Tên sản phẩm</h3>
                                <ul class="products-cart">
                                    @foreach ($order->orderItems as $item)
                                    <li class="pr-cart-item">
                                        <div class="product-image">
                                            <figure><img src="{{ asset('assets/images/products/') }}/{{ $item->product->image}}" alt="{{ $item->product->name }}"></figure>
                                        </div>
                                        <div class="product-name">
                                            <a class="link-to-product" href="{{ route('product.details',['slug'=>$item->product->slug] )}}">{{ $item->product->name }}</a>
                                        </div>
                                        @if ($item->options)
                                        <div class="product-name">
                                           @foreach (unserialize($item->options) as $key =>$value )
                                                <p><b>{{$key}}: {{$value}}</b></p>
                                           @endforeach
                                        </div>
                                        @endif
                                        <div class="price-field produtc-price">
                                            <p class="price">{{ number_format($item->price,0,',',',') }} đ</p>
                                        </div>
                                        <div class="quantity">
                                            <div class="quantity">
                                                <h5>{{ $item->quantity }}</h5>
                                            </div>
                                        </div>
                                        <div class="price-field sub-total">
                                            <p class="price-">{{ number_format($item->price * $item->quantity,0,',',',') }} đ</p>
                                        </div>
                                        @if ($order->status == 'delivered' && $item->rstatus == false)
                                        <div class="price-field sub-total">
                                            <p class="price"><a href="{{ route('user.review',['order_item_id'=>$item->id] )}}">Viết đánh giá </a>
                                        </div>
                                        @endif

                                    </li>
                                    @endforeach
                                </ul>

                            </div>
                            <div class="summary">
                                <div class="order-summary">
                                    <h4 class="title-box">Tóm tắt</h4>
                                    <p class="summary-info"><span class="title">Tạm tính: </span><b class="index">{{ number_format($order->subtotal,0,',',',')}}đ</b></p>
                                    <p class="summary-info"><span class="title">Mã giảm: </span><b class="index">{{ number_format($order->discount,0,',',',')}}đ</b></p>
                                    <p class="summary-info"><span class="title">Thuế: </span><b class="index">{{ number_format($order->tax,0,',',',')}}đ</b></p>
                                    <p class="summary-info"><span class="title">Phí ship: </span><b class="index">FreeShing</b></p>
                                    <p class="summary-info"><span class="title">Thanh toán: </span><b class="index">{{ number_format($order->total,0,',',',')}}đ</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                            Thông tin khách hàng
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>Họ Tên Khách hàng</th>
                                    <td>{{$order->firstname}} {{$order->lastname}}</td>
                                    <th>Phone</th>
                                    <td>{{$order->mobile}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{$order->email}}</td>
                                    <th>Địa chỉ</th>
                                    <td>{{$order->line}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @if ($order->is_shipping_dirrent)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                            Thông tin vận chuyển hàng
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>Họ Tên Khách hàng</th>
                                    <td>{{$order->shipping->firstname}} {{$order->shipping->lastname}}</td>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{$order->shipping->mobile}}</td>
                                    <th>Email</th>
                                    <td>{{$order->shipping->email}}</td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td>{{$order->line}}</td>
                                    <th></th>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                            Chi tiết giao dịch
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>Phương thức thanh toán</th>
                                    @if ($order->transaction->mode == 'cod')
                                    <td>Thanh toán khi nhận hàng</td>
                                    @elseif ($order->transaction->mode == 'paypal')
                                    <td>Thanh toán qua thành khoản Paypal</td>
                                    @else
                                    <td>Thanh toán qua thẻ tín dụng</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Trạng thái thanh toán</th>
                                    @if ($order->transaction->status == 'pending')
                                    <td>Chưa thanh toán</td>
                                    @else
                                    <td>Đã được phê duyệt</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Ngày thanh toán</th>
                                    <td>{{$order->transaction->created_at}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
