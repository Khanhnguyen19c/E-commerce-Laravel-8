<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block !important;
        }
    </style>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                        Danh sách đơn hàng
                    </div>
                    <div class="panel-body">
                    <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Họ tên khách hàng</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Địa chỉ</th>
                                        <th>Thành tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày đặt</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->firstname}} {{$order->lastname}}</td>
                                        <td>{{$order->mobile}}</td>
                                        <td>{{$order->email}}</td>
                                        <td>{{$order->line}}</td>
                                        <td>{{number_format($order->total,0,',',',')}}đ</td>
                                        @if ($order->status =="ordered")
                                        <td>Chưa xử lý</td>
                                        @else
                                        <td>Đã xử lý</td>
                                        @endif
                                        <td>{{$order->created_at}}</td>
                                        <td><a href="{{ route('user.orderdetails',['order_id'=>$order]) }}" class="btn btn-info btn-sm">Chi Tiết</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
