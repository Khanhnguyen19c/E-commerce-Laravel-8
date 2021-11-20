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
    <div class="container" style="padding:30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                        <div class="row">
                            <div class="col-md-8">
                                Thêm Bài Viết
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('admin.posts')}}" class="btn btn-success">Danh Sách Bài Viết</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form action="POST" class="form-horizontal" wire:submit.prevent="addPost">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tên bài viết</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Tên bài viết" class="form-control input-md" wire:model="title" wire:keyup="generateslug">
                                    @error('title') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Slug bài viết</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Slug bài viết" class="form-control input-md" wire:model="slug">
                                    @error('slug') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Hình ảnh bài viết</label>
                                <div class="col-md-4">
                                    <input type="file" class="input-file" wire:model="image">
                                    <div wire:loading wire:target="image"> <i class="fa fa-spinner fa-pulse fa-fw"></i></div>
                                    @error('image') <p class="text-danger">{{ $message }}</p> @enderror
                                    @if ($image)
                                    <img src="{{$image->temporaryUrl() }}" width="120">
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Hiển thị</label>
                                <div class="col-md-8">
                                    <select class="form-control" wire:model="status">
                                    <option value="0">Ẩn</option>
                                    <option value="1" selected >Hiển thị</option>
                                    </select>
                                    @error('status') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Mô tả bài viết</label>
                                <div class="col-md-8">
                                    <textarea placeholder="mô tả ngắn" id="short_editor" class="form-control input-md" wire:model="short_desc"></textarea>
                                    @error('short_desc') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group" wire:ignore>
                                <label class="col-md-4 control-label">Chi tiết bài viết</label>
                                <div class="col-md-8">
                                    <textarea id="editor" class="form-control input-md" wire:model="desc" name="editor">{{ $desc }}</textarea>
                                    @error('desc') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" id="submit" class="btn btn-primary">Thêm Mới</button>
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
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script>
    // ClassicEditor
    // .create( document.querySelector( '#editor' ))
    //     .then(function(editor) {
    //         editor.model.document.on('change:data', () => {
    //             @this.set('desc', editor.getData());
    //         })
    //     })
    //     .catch(error => {
    //         console.error(error);
    //     });
    const editor = CKEDITOR.replace('editor');
    document.querySelector("#submit").addEventListener("click", () => {
        // console.log(editor.getData())
        @this.set('desc', editor.getData());
    });
</script>
@endpush
