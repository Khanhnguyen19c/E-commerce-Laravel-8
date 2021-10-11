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
                        Danh Sách Sliders
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.addhomeslider')}}" class="btn btn-success pull-right">Thêm Slider</a>
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
                                    <th>Tiêu đề</th>
                                    <th>Phụ đề</th>
                                    <th>Giá</th>
                                    <th>Đường dẫn</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày thêm</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id}}</td>
                                    <td><img src="{{ asset('assets/images/sliders')}}/{{$slider->image}}" alt="{{ $slider->title}}" width="120"></td>
                                    <td>{{ $slider->title}}</td>
                                    <td>{{ $slider->subtitle}}</td>
                                    <td>{{ number_format($slider->price,0,',',',')}} Đ</td>
                                    <td>{{ $slider->status == 1 ? 'Hoạt động':'Không hoạt động'}}</td>
                                    <td>{{ $slider->link}}</td>
                                    <td>{{ $slider->created_at}}</td>
                                    <td>
                                    <a href="{{ route('admin.edithomeslider',['slider_id'=> $slider->id]) }}" ><i class="fa fa-edit fa-2x"></i> </a>
                                        <a href="#" onclick="confirm('Bạn có chắc chắn muốn xoá không?') || event.stopImmediatePropagation()" wire:click.prevent="deleteSlider({{ $slider->id}})" style="margin-left: 10px"><i class="fa fa-times fa-2x text-danger"></i> </a>
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
