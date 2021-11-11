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
    <div class="container" style="padding:30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                        <div class="row">
                            <div class="col-md-8">
                                Thêm Slider
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('admin.homeslider')}}" class="btn btn-success">Danh Sách Slider</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form action="POST" class="form-horizontal" wire:submit.prevent="addSlider">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tiêu Đề</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="tiêu đề slider" class="form-control input-md" wire:model="title">
                                    @error('title') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Phụ đề</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="phụ đề" class="form-control input-md" wire:model="subtitle">
                                    @error('subtitle') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Giá</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="giá khuyến mãi" class="form-control input-md" wire:model="price">
                                    @error('price') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Đường dẫn</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="đường dẫn slider" class="form-control input-md" wire:model="link">
                                    @error('link') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Hình Ảnh</label>
                                <div class="col-md-4">

                                    <!-- <div wire:loading wire:target="image"> <i class="fa fa-spinner fa-pulse fa-fw"></i></div> -->
                                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">

                                        <!-- File Input -->

                                        <input type="file" wire:model="image">


                                        <!-- Progress Bar -->

                                        <div x-show="isUploading">

                                            <progress max="100" x-bind:value="progress"></progress>

                                        </div>

                                    </div>
                                    @error('image') <p class="text-danger">{{ $message }}</p> @enderror
                                    @if ($image)
                                    <img src="{{$image->temporaryUrl() }}" width="120">
                                    @endif
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Tình Trạng</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model="status">
                                        <option value="0">Không hoạt động</option>
                                        <option value="1">Hoạt động</option>
                                    </select>
                                    @error('status') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Type</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model="type">
                                        <option value="" selected>Chọn Kiểu</option>
                                        <option value="0">Banner</option>
                                        <option value="1">Slider</option>
                                    </select>
                                    @error('type') <p class="text-danger">{{ $message }}</p> @enderror
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
                </div>
            </div>
        </div>
    </div>
</div>
