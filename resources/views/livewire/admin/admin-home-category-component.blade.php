<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block !important;
        }

        table,
        th {
            text-align: center;
        }

        th {
            FONT-SIZE: 18px;
            font-weight: bold;
        }
    </style>
    <div class="container" style="padding:30px 0px">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                        Quản lý Danh Mục Trang Chủ
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent="updateHomeCategory">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Chọn danh mục</label>
                            <div class="col-md-4" wire:ignore>
                                    <select class="sel_categories form-control" name="categories[]" multiple="multiple" wire:model="selected_categories">
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Số lượng sản phẩm hiển thị</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" wire:model="numberofproducts">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                @can('homeCategory-edit')
                                <button type="submit" class="btn btn-primary">Xác Nhận</button>
                                @endcan

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $('.sel_categories').select2();
        $('.sel_categories').on('change',function(event){
            var data = $('.sel_categories').select2("val");
            @this.set('selected_categories',data);
        });
    });
</script>
@endpush
