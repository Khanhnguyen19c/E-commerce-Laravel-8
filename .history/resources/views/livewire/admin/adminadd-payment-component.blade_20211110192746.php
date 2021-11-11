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
    <div class="panel-body">
                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent="storePyament">
                        <div class="form-group">
                                <label class="col-md-4 control-label">Tên đối tác</label>
                                <div class="col-md-8">
                                    <input type="text" placeholder="tên đối tác" class="form-control input-md" wire:model="name" >
                                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Hình Ảnh </label>
                                <div class="col-md-4">
                                    <input type="file"class="input-file" wire:model="images" multiple>
                                    @if($images)
                                    @foreach ($images as $image)
                                    <img src="{{$image->temporaryUrl() }}" width="120">
                                    @endforeach
                                    @endif
                                    @error('images') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Xác Nhận</button>
                                </div>
                            </div>
                        </form>
                    </div>
