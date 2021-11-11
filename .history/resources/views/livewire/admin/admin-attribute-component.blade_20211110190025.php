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

    .sclist li {
    list-style-type: none;
    counter-increment: item;
    margin-bottom: 5px;
    line-height: 33px;
    border-bottom: 1px solid #ccc ;
}

.sclist li:before {
  content: counter(item);
  margin-right: 5px;
  font-size: 80%;
  background-color: #f9dd94;
  color: #7eb4e2;
  font-weight: bold;
  padding: 3px 8px;
  border-radius: 3px;
}
.slink{
    font-size: 16px;
    margin-left: 12px;
}

</style>
<div class="container" style="padding:30px 0px">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                    <div class="row">
                        <div class="col-md-8">
                        Danh Sách Thuộc Tính
                        </div>
                        <div class="col-md-4">
                        <button type="button" class="btn btn-success pull-right" wire:click.prevent="addbrand()">Thêm thuộc tính mới</button>
                            <!-- <a href="{{ route('admin.add_attribute')}}" class="btn btn-success pull-right">Thêm thuộc tính mới</a> -->
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
                                    <th>Tên thuộc tính</th>
                                    <th>Ngày tạo</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attributes as $attribute)
                                <tr>
                                    <td>{{ $attribute->id}}</td>
                                    <td>{{ $attribute->name}}</td>
                                    <td>{{ $attribute->created_at}}</td>
                                    <td>
                                        <!-- <a href="{{ route('admin.edit_attribute',['attribute_id'=>$attribute->id]) }}" ><i class="fa fa-edit fa-2x"></i> </a> -->
                                        <a wire:click.prevent="edit_({{$brand->id}})"><i class="fa fa-edit fa-2x"></i></a>
                                        <a href="#" onclick="confirm('Bạn có chắc chắn muốn xoá thuộc tính này không?') || event.stopImmediatePropagation()" wire:click.prevent="deleteAttribute({{ $attribute->id}})" style="margin-left: 5px; color:red"><i class="fa fa-times fa-2x"></i> </a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                        {{ $attributes->links() }}
                    </div>
                </div>
            </div>
   </div>
</div>
