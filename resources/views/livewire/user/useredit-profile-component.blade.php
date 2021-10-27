<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cập nhật thông tin cá nhân
                </div>
                <div class="panel-body">
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                    @endif
                    <form wire:submit.prevent="updateProfile">
                    <div class="col-md-4">
                        @if ($newImage)
                        <img src="{{$newImage->temporaryUrl()}}" width="100%">
                        @elseif ($image)
                        <img src="{{asset('assets/images/profile')}}/{{$user->profile->image}}" width="100%">
                        @else
                        <img src="{{asset('assets/images/profile/profile_dummyDefault.png')}}" width="100%">
                        @endif
                        <input type="file" class="form-control" wire:model="newImage" />
                    </div>
                    <div class="col-md-8">
                        <p><b>Họ Tên: </b><b><input type="text" class="form-control" wire:model="name" /></b></p>
                        <p><b>Email: </b><b>{{$email}}</b></p>
                        <p><b>Phone: </b><b><input type="text" class="form-control" wire:model="mobile" /></b></p>
                        <p><b>Phone: </b><b><select class="form-control" wire:model="sex">
                                    <option value="">Chọn giới tính</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Khác">Khác</option>
                                </select></b></p>
                        <br>
                        <p><b>Địa chỉ 1: </b><b><input type="text" class="form-control" wire:model="line1" /></b></p>
                        <p><b>Địa chỉ 2: </b><b><input type="text" class="form-control" wire:model="line2" /></b></p>
                        <p ><b>Thành phố: </b><b>
                            <select class="form-control sel_city" wire:model="selectedCity" >
                                    <option value="" selected>-Chọn thành phố-</option>
                                    @foreach($city as $city)
                                    <option value="{{ $city->id }}">{{ $city->name_city }}</option>
                                    @endforeach
                                </select></b>

                             @error('selectedCity')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </p>
                        @if (!is_null($selectedCity))

                        <p><b>Quận huyện: </b><b>
                                <select class="form-control sel_province" wire:model="selectedProvince">
                                    <option value="" selected>-Chọn Quận huyện-</option>
                                    @foreach($province as $province)
                                    <option value="{{ $province->id }}">{{ $province->name_province }}</option>
                                    @endforeach
                                </select>

                                @error('selectedProvince')
                                <span class="text-danger">{{$message}}</span>
                                @enderror</b></p>
                        @endif
                        @if (!is_null($selectedProvince))
                        <p><b>Xã phường: </b><b>
                                <select class="form-control sel_ward" wire:model="selectedWard">
                                    <option value="" selected>-Chọn xã phường-</option>
                                    @foreach($ward as $ward)
                                    <option value="{{ $ward->id }}">{{ $ward->name_ward }}</option>
                                    @endforeach
                                </select>
                                @error('selectedWard')
                                <span class="text-danger">{{$message}}</span>
                                @enderror</b></p>
                        @endif
                        <button type="submit" class="btn btn-info pull-right">Cập Nhật</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $('.sel_city').select2();
        $('.sel_city').on('change', function(e) {
            var data = $('.sel_city').select2("val");
            @this.set('selectedCity', data);
        });
    });
</script>
@endpush
