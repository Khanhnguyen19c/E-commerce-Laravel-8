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
                        <form action="POST" class="form-horizontal" wire:submit.prevent="updateProduct">
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
                                    <input type="number" placeholder="giá sản phẩm" class="form-control input-md" wire:model="regular_price">
                                    @error('regular_price') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Giá Khuyến Mãi</label>
                                <div class="col-md-4">
                                    <input type="number" placeholder="giá sale" class="form-control input-md" wire:model="sale_price">
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
                                   @error('stock_status') <p class="text-danger">{{ $message }}</p> @enderror
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
                                    <input type="number" placeholder="số lượng sản phẩm" class="form-control input-md" wire:model="quantity">
                                    @error('quantity') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Hình Ảnh</label>
                                <div class="col-md-4">
                                    <input type="file"class="input-file" wire:model="newImage">

                                    @if ($newImage)
                                            <img src="{{$newImage->temporaryUrl() }}" width="120">
                                    @else
                                             <img src="{{asset('assets/images/products') }}/{{$image}}" width="120">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Hình Ảnh Phụ</label>
                                <div class="col-md-4">
                                    <input type="file"class="input-file" wire:model="newImages" multiple>
                                    @if ($newImages)
                                        @foreach ($newImages as $newImage)
                                            @if ($newImage)
                                            <img src="{{$newImage->temporaryUrl() }}" width="120">
                                            @endif
                                        @endforeach

                                    @else
                                            @foreach ($images as $image)
                                                @if ($image)
                                                <img src="{{asset('assets/images/products') }}/{{$image}}" width="120">
                                                @endif
                                            @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Thuộc Danh Mục</label>
                                <div class="col-md-4">
                                   <select class="form-control" wire:model="category_id" wire:change="changeSubcategory">
                                       <option value="">Chọn Danh Mục:</option>
                                       @foreach ($categories as $categories)
                                       <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                       @endforeach
                                   </select>
                                   @error('category_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Danh Mục Phụ</label>
                                <div class="col-md-4">
                                   <select class="form-control" wire:model="scategory_id">
                                       <option value="0">Chọn Danh Mục</option>
                                       @foreach ($scategories as $scategory)
                                       <option value="{{ $scategory->id }}">{{ $scategory->name }}</option>
                                       @endforeach
                                   </select>
                                   @error('scategory_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label">Thuộc tính sản phẩm</label>
                                <div class="col-md-4">
                                   <select class="form-control" wire:model="attr">
                                       <option value="0">Chọn Thuộc Tính</option>
                                       @foreach ($attributes as $attribute)
                                       <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                       @endforeach
                                   </select>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-info" wire:click.prevent="add">Add</button>
                                </div>
                            </div>
                            @foreach ($inputs as $key=>$value )
                            <div class="form-group">
                                <label class="col-md-4 control-label">{{$attributes->where('id',$attribute_arr[$key])->first()->name}}</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="{{$attributes->where('id',$attribute_arr[$key])->first()->name}}" class="form-control input-md" wire:model="attribute_value.{{$value}}">
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})">Loại bỏ</button>
                                </div>
                            </div>
                            @endforeach

                            
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mô Tả Ngắn</label>
                                <div class="col-md-8">
                                    <textarea placeholder="mô tả ngắn" class="form-control input-md" wire:model="short_desc"></textarea>
                                    @error('short_desc') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group" wire:ignore>
                                <label class="col-md-4 control-label">Mô Tả Sản Phẩm</label>
                                <div class="col-md-8">
                                    <textarea id="editor" class="form-control input-md" wire:model="desc">{{ $desc }} </textarea>
                                    @error('desc') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Cật Nhật</button>
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
    </script>
@endpush
