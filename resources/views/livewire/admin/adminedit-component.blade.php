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
    <div class="container" style="padding:30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                        <div class="row">
                            <div class="col-md-8">
                                Thêm nhân viên mới
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('admin.list')}}" class="btn btn-success">Danh Sách nhân viên</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form action="POST" class="form-horizontal" wire:submit.prevent="storeAdmin">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tên nhân viên</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Tên nhân viên" class="form-control input-md" wire:model="name" >
                                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Email nhân viên</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Email nhân viên" class="form-control input-md" wire:model="email" disabled>
                                    @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mật khẩu mới</label>
                                <div class="col-md-4">
                                    <input type="password" placeholder="**********" name="password" class="form-control input-md" wire:model="password">
                                    @error('password') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nhập lại mật khẩu</label>
                                <div class="col-md-4">
                                    <input type="password" placeholder="**********" name="password_confirmation" class="form-control input-md" wire:model="password_confirmation">
                                    @error('password_confirmtion') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Vai Trò</label>
                                <div class="col-md-4" wire:ignore>
                                    <select class="form-control input-md role" wire:model="role_id" multiple="multiple" name="role[]" >
                                        <option value="">Chọn Vai trò</option>
                                        @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->display_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
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
        $('.role').select2();
        $('.role').on('change', function(e) {
            var data = $('.role').select2("val");
            @this.set('role_id', data);
        });
    });
</script>
@endpush
