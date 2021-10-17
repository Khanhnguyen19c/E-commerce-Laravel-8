<div>
   <div class="container" style="padding:30 px 0;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Đổi mật khẩu
                </div>
                <div class="panel-body">
                    @if (Session::has('password_success'))
                     <div class="alert alert-success" role="alert">{{ Session::get('password_success') }}</div>
                     @elseif (Session::has('password_error'))
                     <div class="alert alert-danger" role="alert">{{ Session::get('password_error') }}</div>
                    @endif
                    <form action="" class="form-horizontal" wire:submit.prevent="changePassword">
                        <div class="form-group">
                            <label class="col-md-4">Mật khẩu cũ</label>
                            <div class="col-md-4">
                                <input type="password" placeholder="mật khẩu cũ của bạn" class="form-control input-md" name="current_password" wire:model="current_password" />
                                @error('current_password') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4">Mật khẩu mới</label>
                            <div class="col-md-4">
                                <input type="password" placeholder="mật khẩu mới của bạn" class="form-control input-md" name="new_password" wire:model="password" />
                                @error('password') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4">Nhập lại mật khẩu mới</label>
                            <div class="col-md-4">
                                <input type="password" placeholder="nhập lại mật khẩu mới của bạn" class="form-control input-md" name="password_confirm" wire:model="password_confirmation" />
                                @error('password_confirmation') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4"></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Thực hiện</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
