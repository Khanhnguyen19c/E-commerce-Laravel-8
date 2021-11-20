<div>
    <div class="container" style="padding: 30px 0;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Thay đổi thông tin
                </div>
                <div class="panel-body">
                @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                    <form class="form-horizontal" wire:submit.prevent="saveSettings">
                    <div class="form-group" wire:ignore>
                            <label for="" class="col-md-4 control-label">Giới thiệu Website</label>
                            <div class="col-md-8">
                            <textarea class="form-control input-md"  id="editor" placeholder="giới thiệu về website" wire:model="about">{{$about}}</textarea>
                            @error('about') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Slogan</label>
                            <div class="col-md-8">
                            <input type="text" placeholder="Câu slogan" class="form-control input-md" wire:model="slogan" />
                            @error('slogan') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Tiêu chí 1</label>
                            <div class="col-md-8">
                            <input type="text" placeholder="Tiêu chí 1" class="form-control input-md" wire:model="criteria1" />
                            @error('criteria1') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Tiêu chí 2</label>
                            <div class="col-md-8">
                            <input type="text" placeholder="Tiêu chí 2" class="form-control input-md" wire:model="criteria2" />
                            @error('criteria2') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Tiêu chí 3</label>
                            <div class="col-md-8">
                            <input type="text" placeholder="Tiêu chí 3" class="form-control input-md" wire:model="criteria3" />
                            @error('criteria3') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        </div>
                    <div class="form-group">
                            <label for="" class="col-md-4 control-label">Email</label>
                            <div class="col-md-8">
                            <input type="email" placeholder="Email" class="form-control input-md" wire:model="email" />
                            @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Phone</label>
                            <div class="col-md-8">
                            <input type="text" placeholder="Phone" class="form-control input-md" wire:model="phone" />
                            @error('phone') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Phone2</label>
                            <div class="col-md-8">
                            <input type="text" placeholder="phone" class="form-control input-md" wire:model="phone2" />
                            @error('phone2') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Address</label>
                            <div class="col-md-8">
                            <input type="text" placeholder="Địa chỉ" class="form-control input-md" wire:model="address" />
                            @error('address') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Map</label>
                            <div class="col-md-8">
                            <input type="text" placeholder="Bản đồ" class="form-control input-md" wire:model="map" />
                            @error('map') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Twiter</label>
                            <div class="col-md-8">
                            <input type="text" placeholder="Twiter" class="form-control input-md" wire:model="twiter" />
                            @error('twiter') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Facebook</label>
                            <div class="col-md-8">
                            <input type="text" placeholder="Facebook" class="form-control input-md" wire:model="facebook" />
                            @error('facebook') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Youtube</label>
                            <div class="col-md-8">
                            <input type="text" placeholder="Youtube" class="form-control input-md" wire:model="youtube" />
                            @error('youtube') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Instagram</label>
                            <div class="col-md-8">
                            <input type="text" placeholder="Instagram" class="form-control input-md" wire:model="instagram" />
                            @error('instagram') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Pinterest</label>
                            <div class="col-md-8">
                            <input type="text" placeholder="Pinterest" class="form-control input-md" wire:model="pinterest" />
                            @error('pinterest') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                @can('footer-edit')
                                <button type="submit" id="submit" class="btn btn-primary" >Xác nhận</button>
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
          const editor = CKEDITOR.replace('editor');
    document.querySelector("#submit").addEventListener("click", () => {
        //console.log(editor.getData())
        @this.set('about', editor.getData());
    });

    </script>
@endpush
