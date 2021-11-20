<div id="main-content" class="blog-page" style="margin-top:20px">
        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 left-box">
                    <div class="card single_post">
                        <div class="body">
                            <div class="img-post">
                                <img class="d-block img-fluid" src="{{asset('assets/images/posts')}}/{{$post->image}}" alt="First slide">
                            </div>
                            <h3>{{$post->title}}</h3>
                            <span>Post By: {{ $post->author }}  </span>
                            <p>{{ $post->created_at }} <i class="fa fa-eye fa-1x"></i>{{ $post->views }}</p>
                            <p>{!! $post->content !!}</p>
                        </div>
                        <div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="10"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 right-box">

                    <div class="card">
                        <div class="header">
                            <h2>Bài viết liên quan</h2>
                        </div>
                        <div class="body widget popular-post">
                            <div class="row">
                                <div class="col-lg-12">


                                    @foreach ($popularPost as $popularPost)
                                    <div class="single_post">
                                    <div class="img-post">
                                            <img src="{{asset('assets/images/posts')}}/{{$popularPost->image}}" alt="Awesome Image">
                                            <span>Post By: {{ $popularPost->author }}</span>
                                        </div>
                                    <a style="font-weight:700;font-size:17px" href="{{ route('post',['post_slug'=>$popularPost->slug])}}">
                                        <p class="m-b-0">{{substr($popularPost->title,0,120)}}</p>
                                        </a>

                                        <p>{!! $post->short_desc !!}</p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
