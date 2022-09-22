<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Coffee Break Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />
<script src="{{asset('js/jquery.min.js')}}"></script>
<!---- start-smoth-scrolling---->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<script type="text/javascript" src="{{asset('js/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('js/easing.js')}}"></script>
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
		</script>
        <title>Khánh Blog</title>
<!--start-smoth-scrolling-->
</head>
<body>
	<!--header-top-starts-->
	<div class="header-top">
		<div class="container">
			<div class="head-main">
				<a href="index.html"><img src="{{ asset('images/logo-1.png') }}" alt="" /></a>
			</div>
		</div>
	</div>
	<!--header-top-end-->
	<!--start-header-->
    <div class="header">
		<div class="container">
			<div class="head">
			<div class="navigation">
				 <span class="menu"></span>
					<ul class="navig">
						<li><a href="{{ url('/')}}"  class="active">Trang Chủ</a></li>
						<li><a href="about.html">Giới Thiệu</a></li>
                        @foreach ($category as $key=> $cate)
                        <li><a href="{{ route('Danh-Muc.show',[$cate->id_category_post,'slug'=>Str::slug($cate->title_cate_post)]) }}">{{ $cate->title_cate_post }}</a></li>
                        @endforeach
						<li><a href="contact.html">Contact</a></li>
					</ul>
			</div>
			<div class="header-right">
				<div class="search-bar">
                    <form action="{{ url('tim-kiem')}}" method="GET">
                        @csrf
					<input type="text" placeholder="Tìm Kiếm..." name="keyworld">
					<input type="submit" value="">
                    </form>
				</div>
				<ul>
					<li><a href="#"><span class="fb"> </span></a></li>
					<li><a href="#"><span class="twit"> </span></a></li>
					<li><a href="#"><span class="pin"> </span></a></li>
					<li><a href="#"><span class="rss"> </span></a></li>
					<li><a href="#"><span class="drbl"> </span></a></li>
				</ul>
			</div>
				<div class="clearfix"></div>
			</div>
			</div>
		</div>

	<!-- script-for-menu -->
	<!-- script-for-menu -->
		<script>
			$("span.menu").click(function(){
				$(" ul.navig").slideToggle("slow" , function(){
				});
			});
		</script>
	<!-- script-for-menu -->
	@include('pages.banner')
    <!-- main starts -->
            @yield('content')
     <!-- end main starts -->
	<!--slide-starts-->
	<div class="slide">
		<div class="container">
			<div class="fle-xsel">
			<ul id="flexiselDemo3">
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="{{ asset('images/s-1.jpg')}}" class="img-responsive" alt="">
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="{{asset('images/s-2.jpg')}}" class="img-responsive" alt="">
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="{{ asset('images/s-3.jpg') }}" class="img-responsive" alt="">
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="{{ asset('images/s-4.jpg')}}" class="img-responsive" alt="">
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="{{ asset('images/s-5.jpg')}}" class="img-responsive" alt="">
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="{{ asset('images/s-6.jpg')}}" class="img-responsive" alt="">
						</div>
					</a>
				</li>
			</ul>

							 <script type="text/javascript">
								$(window).load(function() {

									$("#flexiselDemo3").flexisel({
										visibleItems: 5,
										animationSpeed: 1000,
										autoPlay: true,
										autoPlaySpeed: 3000,
										pauseOnHover: true,
										enableResponsiveBreakpoints: true,
										responsiveBreakpoints: {
											portrait: {
												changePoint:480,
												visibleItems: 2
											},
											landscape: {
												changePoint:640,
												visibleItems: 3
											},
											tablet: {
												changePoint:768,
												visibleItems: 3
											}
										}
									});

								});
								</script>
								<script type="text/javascript" src="{{ asset('js/jquery.flexisel.js')}}"></script>
					<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!--slide-end-->
	<!--footer-starts-->
	<div class="footer">
		<div class="container">
			<div class="footer-text">
				<p>© KhanhNguyen. All Rights Reserved | Design by  </p>
			</div>
		</div>
	</div>
	<!--footer-end-->
</body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=391401119062608&autoLogAppEvents=1" nonce="0lECpVRa"></script>
</html>
