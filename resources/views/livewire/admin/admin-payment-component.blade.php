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
                            <a href="{{ route('admin.addpayment')}}" class="btn btn-success pull-right">Thêm đối tác</a>
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
                                    <a href="{{ route('admin.editpayment',['id'=>$payment->id]) }}" ><i class="fa fa-edit fa-2x"></i> </a>
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
</div>
