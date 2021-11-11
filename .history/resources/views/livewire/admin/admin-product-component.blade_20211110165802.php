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
<div class="container" style="padding:30px 0px">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                    <div class="row">
                        <div class="col-md-4">
                        Danh Sách Sản Phẩm
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Tìm Kiếm..." wire:model="searchProduct" />
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.addproduct')}}" class="btn btn-success pull-right">Thêm sản phẩm</a>
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
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Tình trạng</th>
                                    <th>Giá sản phẩm</th>
                                    <th>Giá khuyến mãi</th>
                                    <th>Thuộc danh mục</th>
                                    <th>Ngày thêm</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id}}</td>
                                    <td><img src="{{ asset('assets/images/products')}}/{{$product->image}}" alt="{{ $product->name}}" width="60"></td>
                                    <td>{{ $product->name}}</td>
                                    <td>{{ $product->stock_status}}</td>
                                    <td>{{ number_format($product->regular_price,0,',',',')}} Đ</td>
                                    <td>{{ number_format($product->sale_price,0,',',',')}} Đ</td>
                                    <td>{{ $product->category->name}}</td>
                                    <td>{{ $product->created_at}}</td>
                                    <td>
                                        <a href="{{ route('admin.editproduct',['product_slug'=>$product->slug]) }}" ><i class="fa fa-edit fa-2x"></i> </a>
                                        <a href="#" onclick="confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?') || event.stopImmediatePropagation()" wire:click.prevent="deleteProduct({{ $product->id}})" style="margin-left: 10px"><i class="fa fa-times fa-2x text-danger"></i> </a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                        
                    </div>
                </div>
            </div>
   </div>

</div>
