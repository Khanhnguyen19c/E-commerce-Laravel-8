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
                        <div class="col-md-8">
                        Danh Sách Danh Mục
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.addcategories')}}" class="btn btn-success pull-right">Thêm danh mục</a>
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
                                    <th>Tên danh mục</th>
                                    <th>Slug</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id}}</td>
                                    <td>{{ $category->name}}</td>
                                    <td>{{ $category->slug}}</td>
                                    <td>
                                        <a href="{{ route('admin.editcategories',['category_slug'=>$category->slug]) }}" ><i class="fa fa-edit fa-2x"></i> </a>
                                        <a href="#" onclick="confirm('Bạn có chắc chắn muốn xoá danh mục này không?') || event.stopImmediatePropagation()" wire:click.prevent="deleteCategory({{ $category->id}})" style="margin-left: 10px; color:red"><i class="fa fa-times fa-2x"></i> </a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
   </div>
</div>
