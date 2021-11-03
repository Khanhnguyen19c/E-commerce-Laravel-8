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
                        @if (Session::has('order_message'))
                            <div class="alert alert-success" role="alert">{{Session::get('order_message')}}</div>
                        @endif
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
                                        <th colspan="2">Hành động</th>
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
                                        <td><p class="btn btn-warning btn-sm">Chưa xử lý</p> </td>
                                        @elseif($order->status =="delivered")
                                        <td><p class="btn btn-success btn-sm">Đã giao hàng</p> </td>
                                        @else
                                        <td><p class="btn btn-danger btn-sm">Đã huỷ đơn</p> </td>

                                        @endif
                                        <td>{{$order->created_at}}</td>
                                        <td><a href="{{ route('admin.orderdetails',['order_id'=>$order]) }}" class="btn btn-info btn-sm">Xem chi Tiết</a></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Trang thái
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @if ($order->status =="ordered" or $order->status =="canceled")
                                                    <li><a href="#" wire:click.prevent="updateOrderStatus({{$order->id}},'delivered')">Đã giao hàng</a></li>
                                                    <li><a href="#" wire:click.prevent="updateOrderStatus({{$order->id}},'canceled')">Huỷ đơn</a></li>
                                                    @else
                                                    <li><a href="#" wire:click.prevent="updateOrderStatus({{$order->id}},'canceled')">Huỷ đơn</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
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

@push('scripts')
        <script>
            $(document).ready(function(){
                window.addEventListener('order_message', event =>{
                    toastr.options = {
                        "positionClass":"toast-bottom-right",
                        "progressBar": true,
                    }
                   toastr.success(event.detail.message,'Success');
                })
            });
        </script>
@endpush
