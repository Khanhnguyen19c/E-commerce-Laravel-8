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

        .modal-content {
            width: 800px;
        }
    </style>

    <div class="container" style="padding:30px 0px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                    <div class="row">
                        <div class="col-md-8">
                            Danh Sách Admin
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.addrole')}}" class="btn btn-success pull-right">Thêm Vai trò</a>
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
                                <th>Tên vai trò</th>
                                <th>Vai Trò</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id}}</td>
                                <td>{{ $role->name}}</td>
                                <td>{{ $role->display_name}}</td>
                                <td>
                                    <a href="{{route('admin.editrole',['role_id' => $role->id])}}"><i class="fa fa-edit fa-2x"></i> </a>
                                    <a href="#" onclick="confirm('Bạn có chắc chắn muốn xoá vai trò này không?') || event.stopImmediatePropagation()" wire:click.prevent="deleteRole({{ $role->id}})" style="margin-left: 5px; color:red"><i class="fa fa-times fa-2x"></i> </a>
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

