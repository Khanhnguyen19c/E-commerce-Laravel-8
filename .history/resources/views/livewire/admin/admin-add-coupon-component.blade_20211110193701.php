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
<div class="panel-body">
                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form action="POST" class="form-horizontal" wire:submit.prevent="storeCoupon">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mã giảm giá</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="mã giảm giá" class="form-control input-md" wire:model="code">
                                    @error('code') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Kiểu giảm giá</label>
                                <div class="col-md-4">
                                        <select class="form-control" wire:model="type">
                                            <option value="">Chọn kiểu giảm</option>
                                            <option value="fixed">Theo giá trị</option>
                                            <option value="percent">Theo phần trăm</option>
                                        </select>
                                    @error('type') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Giá trị của mã</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="giá trị của mã" class="form-control input-md" wire:model="value">
                                    @error('value') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Điều kiện giỏ hàng</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="giá trị của giỏ hàng" class="form-control input-md" wire:model="cart_value">
                                    @error('cart_value') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Ngày hết hạn</label>
                                <div class="col-md-4" wire:ignore>
                                    <input type="text" placeholder="ngày hết hạn sử dụng" id="expiry_date" class="form-control input-md" wire:model="expiry_date">
                                    @error('expiry_date') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Thêm Mới</button>
                                </div>
                            </div>
                        </form>
                    </div>

@push('scripts')
    <script>
        $(function(){
            $('#expiry_date').datetimepicker({
                format: 'Y-MM-DD'
            })
            .on('dp.change',function(ev){
                var data = $('#expiry_date').val();
                @this.set('expiry_date',data);
            })
        })
    </script>
@endpush
