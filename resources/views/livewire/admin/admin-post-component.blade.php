<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block !important;
        }

        table,
        th {
            text-align: center;
        }

        th {
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
                            Danh Sách Bài Viết
                        </div>

                        <div class="col-md-8">
                            @can('posts-add')
                            <a href="{{ route('admin.addpost')}}" class="btn btn-success pull-right">Thêm bài viết</a>
                            @endcan

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
                                <th>Tên bài viết</th>
                                <th>Tác giả</th>
                                <th>Mô tả ngắn</th>
                                <th>Chi tiết bài viết</th>
                                <th>Ngày thêm</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id}}</td>
                                <td><img src="{{ asset('assets/images/posts')}}/{{$post->image}}" alt="{{ $post->name}}" width="60"></td>
                                <td>{{ $post->title}}</td>
                                <td>{{ Auth::user()->email}}</td>
                                <td>{{ $post->short_desc}}</td>
                                <td>{{ substr($post->content,0,200)}}...</td>
                                <td>{{ $post->create_at}}</td>
                                <td>
                                    @can('posts-edit')
                                    <a href="{{ route('admin.editpost',['post_id'=>$post->id]) }}"><i class="fa fa-edit fa-2x"></i> </a>
                                    @endcan
                                    @can('posts-delete')
                                    <a href="#" onclick="confirm('Bạn có chắc chắn muốn xoá bài viết này không?') || event.stopImmediatePropagation()" wire:click.prevent="deletePost({{ $post->id}})" style="margin-left: 10px"><i class="fa fa-times fa-2x text-danger"></i> </a>
                                    @endcan


                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
