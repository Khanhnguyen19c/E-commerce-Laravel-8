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
                            <!-- <a href="{{ route('admin.addcoupon')}}" class="btn btn-success pull-right">Thêm mã mới</a> -->
                           @can('coupon-add')
                           <button type="button" class="btn btn-success pull-right" wire:click.prevent="addCoupon()">Thêm mã mới</button>
                           @endcan

                        </div>
                    </div>

                    </div>
                    <div class="panel-body">
                     @if (Session::has('message_del'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message_del') }}</div>
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
                                    <th>Gửi KH</th>
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
                                    @can('coupon-send')
                                    <div wire:loading wire:target="message_del"> <i class="fa fa-spinner fa-pulse fa-fw"></i></div>
                                        <a wire:click.prevent="sendcoupon({{$coupon->id}})"><i class="fa fa-envelope fa-2x"></i></a></td>
                                    @endcan
                                    <td>
                                        <!-- <a href="{{ route('admin.editcoupon',['coupon_id'=>$coupon->id]) }}" ><i class="fa fa-edit fa-2x"></i> </a> -->
                                       @can('coupon-edit')
                                       <a wire:click.prevent="editCoupon({{$coupon->id}})"><i class="fa fa-edit fa-2x"></i></a>
                                       @endcan
                                      @can('coupon-delete')
                                      <a href="#" onclick="confirm('Bạn có chắc chắn muốn xoá mã này không?') || event.stopImmediatePropagation()" wire:click.prevent="DeleteCoupon({{ $coupon->id}})" style="margin-left: 10px; color:red"><i class="fa fa-times fa-2x"></i> </a>
                                      @endcan
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
   </div>
    <!-- --MODAL-- -->
    <div class="modal" id="form" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                    <h5 class="modal-title" style="font-size:17px;font-weight:bold;">
                        @if ($showEditModal)
                        <span>Cập nhật mã giảm giá</span>
                        @else
                        <span>Thêm mã giảm mới</span>
                        @endif
                    </h5>
                </div>
                <div class="modal-body">
                    @if ($showEditModal)
                    <div class="panel-body">
                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form action="POST" class="form-horizontal" wire:submit.prevent="updateCoupon">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mã giảm giá</label>
                                <div class="col-md-8">
                                    <input type="text" placeholder="mã giảm giá" class="form-control input-md" wire:model="code">
                                    @error('code') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Kiểu giảm giá</label>
                                <div class="col-md-8">
                                        <select class="form-control" wire:model="type">
                                            <option value="fixed">Giá tiền</option>
                                            <option value="percent">Theo phần trăm</option>
                                        </select>
                                    @error('type') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Giá trị của mã</label>
                                <div class="col-md-8">
                                    <input type="number" placeholder="giá trị của mã" class="form-control input-md" wire:model="value">
                                    @error('value') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Giá trị giỏ hàng</label>
                                <div class="col-md-8">
                                    <input type="number" placeholder="giá trị của giỏ hàng" class="form-control input-md" wire:model="cart_value">
                                    @error('cart_value') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label">Ngày hết hạn</label>
                            <div class="col-md-8" wire:ignore>
                                <input id="expiry_date" type="text" placeholder="ngày hết hạn sử dụng" class="form-control input-md" wire:model="expiry_date">
                                @error('expiry_date') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @else
                    @livewire('admin.admin-add-coupon-component')
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click.prevent="refesh" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
        $(function(){
            $('#expiry_date').datetimepicker({
                format: 'Y-MM-DD'
            }).on('dp.change',function(ev){
                var data = $('#expiry_date').val();
                @this.set('expiry_date',data);
            })
        });
    </script>
@endpush
