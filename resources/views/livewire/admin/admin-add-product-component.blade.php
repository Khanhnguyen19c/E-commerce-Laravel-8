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
                                Thêm Danh Mục
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('admin.products')}}" class="btn btn-success">Danh Sách Sản Phẩm</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form action="POST" class="form-horizontal" wire:submit.prevent="addProduct">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tên Sản Phẩm</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Tên sản phẩm" class="form-control input-md" wire:model="name" wire:keyup="generateslug">
                                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Slug Sản Phẩm</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Slug sản phẩm" class="form-control input-md" wire:model="slug">
                                    @error('slug') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Giá Bán</label>
                                <div class="col-md-4">
                                    <input type="number" value="1" placeholder="giá sản phẩm" class="form-control input-md" wire:model="regular_price">
                                    @error('regular_price') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Giá Khuyến Mãi</label>
                                <div class="col-md-4">
                                    <input type="text" value="0" placeholder="giá sale" class="form-control input-md" wire:model="sale_price">
                                    @error('sale_price') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mã Hàng</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="mã hàng" class="form-control input-md" wire:model="SKU">
                                    @error('SKU') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tình Trạng</label>
                                <div class="col-md-4">
                                   <select class="form-control" wire:model="stock_status">
                                       <option value="Trong Kho">Trong Kho</option>
                                       <option value="Chuẩn Bị Về">Chuẩn Bị Về</option>
                                       <option value="Hết Hàng">Hết Hàng</option>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Đặc Tính</label>
                                <div class="col-md-4">
                                   <select class="form-control" wire:model="feartured">
                                       <option value="0">Không Có</option>
                                       <option value="1">Có</option>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Số Lượng</label>
                                <div class="col-md-4">
                                    <input type="number" min="1" value="1" placeholder="số lượng sản phẩm" class="form-control input-md" wire:model="quantity">
                                    @error('quantity') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Hình Ảnh</label>
                                <div class="col-md-4">
                                    <input type="file"class="input-file" wire:model="image">
                                    @error('image') <p class="text-danger">{{ $message }}</p> @enderror
                                    @if ($image)
                                            <img src="{{$image->temporaryUrl() }}" width="120">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Thuộc Danh Mục</label>
                                <div class="col-md-4">
                                   <select class="form-control" wire:model="category_id">
                                       <option value="">Chọn Danh Mục:</option>
                                       @foreach ($categories as $categories)
                                       <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                       @endforeach
                                   </select>
                                   @error('category_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mô Tả Ngắn</label>
                                <div class="col-md-8">
                                    <textarea placeholder="mô tả ngắn" id="short_editor" class="form-control input-md" wire:model="short_desc"></textarea>
                                    @error('short_desc') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group" wire:ignore>
                                <label class="col-md-4 control-label">Mô Tả Sản Phẩm</label>
                                <div class="col-md-8">
                                    <textarea id="editor" class="form-control input-md" wire:model="desc"> </textarea>
                                    @error('desc') <p class="text-danger">{{ $message }}</p> @enderror
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

@push('scripts')
    <script>
       ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then(function(editor){
            editor.model.document.on('change:data',() =>{
                @this.set('desc',editor.getData());
            })
        })
        .catch( error => {
            console.error( error );
        } );
        ClassicEditor
        .create( document.querySelector( '#short_editor' ) )
        .then(function(editor){
            editor.model.document.on('change:data',() =>{
                @this.set('desc',editor.getData());
            })
        })
        .catch( error => {
            console.error( error );
        } );
    </script>
@endpush
