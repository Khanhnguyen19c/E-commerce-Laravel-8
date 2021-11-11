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
                        Danh Sách Danh Mục
                        </div>
                        <div class="col-md-4">
                            <button type="button" wire:click.prevent="Addform" class="btn btn-success pull-right">Thêm danh mục</button>
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
                                    <th>Danh Mục Con</th>
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
                                        <ol class="sclist">
                                            @foreach ($category->subCategory as $scategory)
                                                <li>{{$scategory->name}} <a class="slink" href="{{ route('admin.editcategories',['category_slug'=>$category->slug,'scategory_slug'=>$scategory->slug]) }}"> <i class="fa fa-edit fa-1x"></i></a>
                                                <a class="slink" href="#" onclick="confirm('Bạn có chắc chắn muốn xoá danh mục này không?') || event.stopImmediatePropagation()" wire:click.prevent="deleteSubcategory({{ $scategory->id}})" style="margin-left: 5px; color:red"><i class="fa fa-times fa-1x"></i> </a>
                                            </li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>
                                    <button type="button" data-target="#modal-formEdit" data-toggle="modal" class="btn btn-success pull-right"><i class="fa fa-edit fa-2x"></i> </button>
                                        <a href="#" onclick="confirm('Bạn có chắc chắn muốn xoá danh mục này không?') || event.stopImmediatePropagation()" wire:click.prevent="deleteCategory({{ $category->id}})" style="margin-left: 5px; color:red"><i class="fa fa-times fa-2x"></i> </a>
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

<div class="modal" id="modal-formAdd" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
        <h5 class="modal-title" style="font-size:17px;font-weight:bold;">Thêm danh mục mới</h5>
      </div>
      <div class="modal-body">
      @livewire('admin.admin-add-category-component')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click.prevent="refesh" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="modal-formEdit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
        <h5 class="modal-title" style="font-size:17px;font-weight:bold;">Cập nhật danh mục</h5>
      </div>
      <div class="modal-body">
      @livewire('admin.admin-add-category-component')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click.prevent="refesh" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
</div>
@push('scripts')
<script>
    $( document ).ready(function() {
    window.addEventListener('hide-form',event =>{
        $('#modal-Addform').modal('hide');
        toastr.success(event.detail.message,'Success!');
    });
    window.addEventListener('show-form',event =>{
        $('#modal-Addform').modal('show');
    });
</script>
@endpush
