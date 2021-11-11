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
        <form action="POST" class="form-horizontal" wire:submit.prevent="storeCategory">
            <div class="form-group">
                <label class="col-md-4 control-label">Tên Danh Mục</label>
                <div class="col-md-4">
                    <input type="text" placeholder="Tên danh mục" class="form-control input-md" wire:model="name" wire:keyup="generateslug">
                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Slug Danh Mục</label>
                <div class="col-md-4">
                    <input type="text" placeholder="Slug danh mục" class="form-control input-md" wire:model="slug">
                    @error('slug') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Danh Mục Cha</label>
                <div class="col-md-4">
                    <select class="form-control input-md" wire:model="category_id">
                        <option value="">None</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>

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
