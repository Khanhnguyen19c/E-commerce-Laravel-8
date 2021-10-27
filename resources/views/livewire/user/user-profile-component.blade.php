<div>
   <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Thông tin cá nhân
                </div>
                <div class="panel-body">
                    <div class="col-md-4">
                        @if ($user->profile->image)
                            <img src="{{asset('assets/images/profile')}}/{{$user->profile->image}}" width="100%">
                        @else
                            @if ($user->profile->sex == "Nam")
                            <img src="{{asset('assets/images/profile/profile_dummyBoy.png')}}" width="100%">
                            @elseif ($user->profile->sex == "Nữ")
                            <img src="{{asset('assets/images/profile/profile_dummyGirl.png')}}" width="100%">
                            @else
                            <img src="{{asset('assets/images/profile/profile_dummyDefault.png')}}" width="100%">
                            @endif
                        @endif
                    </div>
                    <div class="col-md-8">
                    <p><b>Họ và tên: </b><b>{{$user->name}}</b></p>
                    <p><b>Giới tính: </b><b>{{$user->profile->sex}}</b></p>
                    <p><b>Email: </b><b>{{$user->email}}</b></p>
                    <p><b>Phone: </b><b>{{$user->profile->mobile}}</b></p>
                    <br>
                    @if ($ward or $province or $city)
                    <p><b>Thành phố: </b><b>{{$city->name_city}}</b></p>
                    <p><b>Xã phường: </b><b>{{$ward->name_ward}}</b></p>
                    <b>Quận huyện: </b><b>{{$province->name_province}}</b></p>
                    @endif

                    <p><b>Địa chỉ 1: </b><b>{{$user->profile->line1}}</b></p>
                    <p><b>Địa chỉ 2: </b><b>{{$user->profile->line2}}</b></p>
                    <a href="{{ route('user.editprofile')}}" class="btn btn-info pull-right">Cập Nhật Thông Tin</a>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
