<div>
   <div class="container">
       <div class="col-md-12">
           <div class="panel panel-default">
           <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
           <div class="row">
                        <div class="col-md-8">
                        Danh Sách đối tác
                        </div>
                        <div class="col-md-4">
                            <!-- <a href="{{ route('admin.addpayment')}}" class="btn btn-success pull-right">Thêm đối tác</a> -->
                            <button type="button" class="btn btn-success pull-right" wire:click.prevent="addPayment()">Thêm đối tác</button>
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
                                    <th>Name</th>
                                    <th>Images</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                @php
                                    $imgs = explode(",",$payment->images);
                                @endphp
                                <tr>
                                    <td>{{$payment->id}}</td>
                                    <td>{{$payment->name}}</td>
                                    <td>
                                    @foreach ($imgs as $key=>$img)
                                    @if($key >0 )
                                    <img src="{{asset('assets/images/payments')}}/{{$img}}" width="75">
                                    @endif
                                    @endforeach
                                    </td>
                                    <td>
                                    <!-- <a href="{{ route('admin.editpayment',['id'=>$payment->id]) }}" ><i class="fa fa-edit fa-2x"></i> </a> -->
                                        <a wire:click.prevent="editPayment({{$payment->id}})"><i class="fa fa-edit fa-2x"></i></a>
                                        <a href="#" onclick="confirm('Bạn có chắc chắn muốn xoá đối tác này không?') || event.stopImmediatePropagation()" wire:click.prevent="deletePayment({{ $payment->id}})" style="margin-left: 5px; color:red"><i class="fa fa-times fa-2x"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
               </div>
           </div>
       </div>
   </div>
   <!-- --MODAL-- -->
   <div class="modal" id="form" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                    <h5 class="modal-title" style="font-size:17px;font-weight:bold;">
                        @if ($showEditModal)
                        <span>Cập nhật đói tác</span>
                        @else
                        <span>Thêm đối tác mới</span>
                        @endif
                    </h5>
                </div>
                <div class="modal-body">
                    @if ($showEditModal)
                    <div class="panel-body">
                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form action="POST" class="form-horizontal" wire:submit.prevent="updateBrand">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tên Thương Hiệu</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Tên thương hiệu" class="form-control input-md" wire:model="name" wire:keyup="generateslug">
                                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Slug Thương Hiệu</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Slug danh mục" class="form-control input-md" wire:model="slug">
                                    @error('slug') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @else
                    @livewire('admin.admin-adminadd-component')
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click.prevent="refesh" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>
