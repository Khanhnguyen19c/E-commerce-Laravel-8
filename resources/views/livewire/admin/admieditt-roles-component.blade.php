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
                        <div class="row">
                            <div class="col-md-8">
                                Thêm vai trò
                            </div>
                            <div class="col-md-4">
                                <a class="btn btn-success" href="{{route('admin.roles')}}">Danh sách vai trò</a>
                            </div>
                        </div>

                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form method="POST" class="form-horizontal" action="{{route('admin.updateRole',)}}">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tên vai trò</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Tên vai trò" class="form-control input-md" wire:model="name" name="name">
                                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mô tả vai trò</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Mô tả vai trò" class="form-control input-md" wire:model="display_name" name="display_name">
                                    @error('display_name') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Full quyền</label>
                                <div class="col-md-4">
                                <input type="checkbox" class="form-control selectAll">
                                <input type="hidden" class="form-check-input" name="role_id" value="{{$role_id}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="row">

                                        @foreach ($permissions as $permission_item)
                                        <div class="card panel panel-default">
                                            <div class="panel-heading text-center" style="font-size: 16px;color: #fff;background-color: #939393;">
                                            <label for="">
                                                    <input type="checkbox" class="input-md checkbox_parent"  value="{{ $permission_item->id }}">
                                                </label>
                                                {{ $permission_item->name }}
                                            </div>
                                            <div class="row">
                                                @foreach ($permission_item->rolesChildrent as $rolesChildrent)
                                                <div class="panel-body col-md-3">
                                                 <label>
                                                        <input type="checkbox" class="input-md checkbox_childrent" name="rolesChildrent[]" value="{{$rolesChildrent->id}}"  {{ $checked->contains('id',$rolesChildrent->id) ? 'checked' : '' }} >
                                                    </label>
                                                    {{ $rolesChildrent->name }}
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
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
    $('.checkbox_parent').on('click',function(){
        $(this).parents('.card').find('.checkbox_childrent').prop('checked',$(this).prop('checked'));
    });
    $('.selectAll').on('click',function(){
        $(this).parents().find('.checkbox_childrent').prop('checked',$(this).prop('checked'));
    })
</script>
@endpush
