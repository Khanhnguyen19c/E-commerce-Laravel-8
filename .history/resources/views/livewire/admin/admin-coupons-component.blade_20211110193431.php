<div>
<style>
    nav svg{
        height: 20px;
    }
    nav .hidden{
        display: block !important;
    }
    table,th{
        text-align: center;
    }
    th{
        FONT-SIZE: 18px;
        font-weight: bold;
    }
</style>
<div class="container" style="padding:30px 0px">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                    <div class="row">
                        <div class="col-md-8">
                        Danh Sách Mã Coupon
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.addcoupon')}}" class="btn btn-success pull-right">Thêm mã mới</a>
                        </div>
                    </div>

                    </div>
                    <div class="panel-body">
                     @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Mã Coupon</th>
                                    <th>Kiểu giảm giá</th>
                                    <th>Giá khuyến mãi</th>
                                    <th>Điều kiện giỏ hàng từ</th>
                                    <th>Ngày hết hạn</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->id}}</td>
                                    <td>{{ $coupon->code}}</td>
                                    @if ($coupon->type == 'fixed')
                                        <td>Theo mệnh giá tiền</td>
                                        <td>{{ number_format($coupon->value,0,',','.')}}đ</td>
                                    @else
                                        <td>Theo % đơn hàng</td>
                                        <td>{{ number_format($coupon->value,0,',','.')}} %</td>
                                    @endif
                                    <td>{{ number_format($coupon->cart_value,0,',','.')}}đ</td>
                                    <td>{{ $coupon->expiry_date }}</td>
                                    <td>
                                        <!-- <a href="{{ route('admin.editcoupon',['coupon_id'=>$coupon->id]) }}" ><i class="fa fa-edit fa-2x"></i> </a> -->
                                        <a wire:click.prevent="editbrand({{$brand->id}})"><i class="fa fa-edit fa-2x"></i></a>
                                        <a href="#" onclick="confirm('Bạn có chắc chắn muốn xoá mã này không?') || event.stopImmediatePropagation()" wire:click.prevent="DeleteCoupon({{ $coupon->id}})" style="margin-left: 10px; color:red"><i class="fa fa-times fa-2x"></i> </a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
   </div>
</div>
