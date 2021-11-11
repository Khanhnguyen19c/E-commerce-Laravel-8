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
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style=" text-align: center;font-size: 18px;color: white;background-color: #7373ff;">
                    <div class="row">
                        <div class="col-md-8">
                        Thêm đối tác mới
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.payments')}}" class="btn btn-success pull-right">Danh sách đối tác</a>
                        </div>
               </div>
                 </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $('.sel_categories').select2();
        $('.sel_categories').on('change',function(event){
            var data = $('.sel_categories').select2("val");
            @this.set('selected_categories',data);
        });
    });
</script>
@endpush
