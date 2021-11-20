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

        .sclist li {
            list-style-type: none;
            counter-increment: item;
            margin-bottom: 5px;
            line-height: 33px;
            border-bottom: 1px solid #ccc;
        }

        .sclist li:before {
            content: counter(item);
            margin-right: 5px;
            font-size: 80%;
            background-color: #f9dd94;
            color: #7eb4e2;
            font-weight: bold;
            padding: 3px 8px;
            border-radius: 3px;
        }

        .slink {
            font-size: 16px;
            margin-left: 12px;
        }
    </style>
    <div class="container" style="padding:30px 0px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                    <div class="row">
                        <div class="col-md-8">
                            Danh Sách Quyền
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-success pull-right" wire:click.prevent="addPermission()">Thêm Quyền Mới</button>
                        </div>
                    </div>

                </div>
                <div class="panel-body">
                    @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{route('admin.store')}}">
                       @csrf
                        <div class="form-group">
                            <label class="col-md-4 control-label">Chọn Tên Module</label>
                            <div class="col-md-4">
                                    <select class="sel_categories form-control" name="module_parent">
                                    <option value="">--Chọn tên quyền muốn thêm--</option>
                                    @foreach (config('permissions.table_module') as $item)
                                        <option value="{{ $item}}">{{ $item  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @foreach (config('permissions.module_childrent') as $item)
                            <div class="form-group">
                                <label class="col-md-4 control-label">{{$item}}</label>
                                <div class="col-md-4">
                                    <input type="checkbox" value="{{$item}}" class="form-control input-md" name="module_childrent[]">
                                </div>
                            </div>
                            @endforeach
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Xác Nhận</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

</div>

