<div>
<main id="main" class="main-site left-sidebar">

<div class="container">

    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home')}}" class="link">Trang chủ</a></li>
            <li class="item-link"><span>Liên hệ với chúng tôi</span></li>
        </ul>
    </div>
    <div class="row">
        <div class=" main-content-area">
            <div class="wrap-contacts ">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="contact-box contact-form">
                        <h2 class="box-title">Phản hồi dịch vụ</h2>
                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        @endif
                        <form action="#"  name="frm-contact" wire:submit.prevent="sendMessage">

                            <label for="name">Tên của bạn<span>*</span></label>
                            <input type="text" value="" id="name" name="name" wire:model="name">
                            @error('name') <p class="text-danger">{{ $message }}</p> @enderror

                            <label for="email">Email<span>*</span></label>
                            <input type="text" value="" id="email" name="email" wire:model="email">
                            @error('email') <p class="text-danger">{{ $message }}</p> @enderror

                            <label for="phone">Số điện thoại</label>
                            <input type="text" value="" id="phone" name="phone" wire:model="phone">
                            @error('phone') <p class="text-danger">{{ $message }}</p> @enderror

                            <label for="comment">Lời nhắn</label>
                            <textarea name="comment" id="comment" wire:model="comment"></textarea>
                            @error('comment') <p class="text-danger">{{ $message }}</p> @enderror

                            <input type="submit" name="ok" value="Gửi" >

                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="contact-box contact-info">
                        <div class="wrap-map">
                            <div class="mercado-google-maps">
                            <iframe src="{{ $setting->map }}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                        </div>
                        <h2 class="box-title">Thông tin liên hệ</h2>
                        <div class="wrap-icon-box">

                            <div class="icon-box-item">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <div class="right-info">
                                    <b>Email</b>
                                    <p>{{ $setting->email }}</p>
                                </div>
                            </div>

                            <div class="icon-box-item">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <div class="right-info">
                                    <b>Phone</b>
                                    <p>{{ $setting->phone }} - {{ $setting->phone2 }}</p>
                                </div>
                            </div>

                            <div class="icon-box-item">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <div class="right-info">
                                    <b>Mail Office</b>
                                    <p>Hãy gửi mail cho tôi nếu có bất kỳ thắc mắc<br />{{ $setting->address }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div><!--end main products area-->

    </div><!--end row-->

</div><!--end container-->

</main>
</div>
