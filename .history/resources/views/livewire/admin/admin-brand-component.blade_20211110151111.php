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
                        Danh Sách Thương Hiệu
                        </div>
                        <div class="col-md-4">
                        <button type="button" data-target="#modal-formAdd" data-toggle="modal" class="btn btn-success pull-right">Thêm thương hiệu</button>
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
                                    <th>Tên thương hiệu</th>
                                    <th>Slug</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id}}</td>
                                    <td>{{ $brand->name}}</td>
                                    <td>{{ $brand->slug}}</td>

                                    <td>
                                    <button type="button" data-target="#modal-formEdit" data-toggle="modal" class="btn btn-success pull-right" wire:model="editbrand({{$brand->id}})"><i class="fa fa-edit fa-2x"></i></button>
                                        <a href="#" onclick="confirm('Bạn có chắc chắn muốn xoá danh mục này không?') || event.stopImmediatePropagation()" wire:click.prevent="deleteBrand({{ $brand->id}})" style="margin-left: 5px; color:red"><i class="fa fa-times fa-2x"></i> </a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
   </div>
   <!-- <div class="modal" id="modal-formAdd" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
        <h5 class="modal-title" style="font-size:17px;font-weight:bold;">Thêm thương hiệu mới</h5>
      </div>
      <div class="modal-body">
      @livewire('admin.admin-add-brand-component')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click.prevent="refesh" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div> -->
<div class="modal" id="formEdit" id="formEdit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
        <h5 class="modal-title" style="font-size:17px;font-weight:bold;">Thêm thương hiệu mới</h5>
      </div>
      <div class="modal-body">

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
        window.addEventListener('show-form',event =>{
            $('#formEdit').modal('show');
        })
    </script>
@endpush
