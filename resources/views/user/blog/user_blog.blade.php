@extends('layouts.master')
@section('title')
    User Blogs
@endsection
@section('content')
    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>User Blogs : {{ $user->name }}</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="#">Home</a>
                        <span class="crumbs-span">/</span>
                        <a href="#">User</a>
                        <span class="crumbs-span">/</span>
                        <span class="current">User Blogs : {{ $user->name }}</span>
                    </div>
                </div>
            </div><!-- End row -->
        </section><!-- End container -->
    </div><!-- End breadcrumbs -->

    <section class="container main-content">
        <div class="row">
            <div class="col-md-9">

                @if ($message = Session::get('success'))
                    <div class="alert-message success">
                        <i class="icon-ok"></i>
                        <p><span>success message</span><br>
                            {{$message}}</p>
                    </div>
                @endif

                <div class="row">
                    <div class="user-profile">
                        <div class="col-md-12">
                            <div class="page-content">
                                <h2>About {{ $user->name }}</h2>
                                <div class="user-profile-img"><img width="60" height="60" src="http://placehold.it/60x60/FFF/444" alt="admin"></div>
                                <div class="ul_list ul_list-icon-ok about-user">
                                    <ul>
                                        <li><i class="icon-plus"></i>Registerd : <span>{{ $user->created_at->format('M d,Y') }}</span></li>
                                        <li><i class="icon-map-marker"></i>Country : <span>{{ $user->country }}</span></li>
                                        <li><i class="icon-globe"></i>Website : <a target="_blank" href="">{{ $user->website }}</a></li>
                                    </ul>
                                </div>
                                <p> {{ $user->description }}</p>
                                <div class="clearfix"></div>
                                <span class="user-follow-me">Follow Me</span>
                                <a href="#" original-title="Facebook" class="tooltip-n">
									<span class="icon_i">
										<span class="icon_square" icon_size="30" span_bg="#3b5997" span_hover="#2f3239">
											<i class="social_icon-facebook"></i>
										</span>
									</span>
                                </a>
                                <a href="#" original-title="Twitter" class="tooltip-n">
									<span class="icon_i">
										<span class="icon_square" icon_size="30" span_bg="#00baf0" span_hover="#2f3239">
											<i class="social_icon-twitter"></i>
										</span>
									</span>
                                </a>
                                <a href="#" original-title="Linkedin" class="tooltip-n">
									<span class="icon_i">
										<span class="icon_square" icon_size="30" span_bg="#006599" span_hover="#2f3239">
											<i class="social_icon-linkedin"></i>
										</span>
									</span>
                                </a>
                                <a href="#" original-title="Google plus" class="tooltip-n">
									<span class="icon_i">
										<span class="icon_square" icon_size="30" span_bg="#c43c2c" span_hover="#2f3239">
											<i class="social_icon-gplus"></i>
										</span>
									</span>
                                </a>
                                <a href="#" original-title="Email" class="tooltip-n">
									<span class="icon_i">
										<span class="icon_square" icon_size="30" span_bg="#000" span_hover="#2f3239">
											<i class="social_icon-email"></i>
										</span>
									</span>
                                </a>
                            </div><!-- End page-content -->
                        </div><!-- End col-md-12 -->
                    </div><!-- End user-profile -->
                </div><!-- End row -->
                <div class="clearfix"></div>
                <div class="page-content page-content-user">
                    <div class="user-questions">
                        <br>
                        <br>
                        @foreach ($userBlogs as $blog)
                            @if ($blog->type == 1)
                                <article class="post blog_2 clearfix">
                                    <div class="post-inner">
                                        <h2 class="post-title"><span class="post-type"><i class="icon-file-alt"></i></span><a href="">{{ $blog->title }}</a></h2>
                                        @switch( $blog->approve_status )
                                            @case (0)
                                            <div class="question-type-main" style="background-color: #ee9900; float: right;"><i class="icon-spinner"></i>Pending</div>
                                            @break;
                                            @case (1)
                                            <div class="question-type-main" style="background-color: #2fa360; float: right"><i class="icon-ok"></i>Approved</div>
                                            @break;
                                            @case (2)
                                            <div class="question-type-main" style="background-color: red; float: right;"><i class="icon-remove"></i>Denied</div>
                                            @break;
                                        @endswitch
                                        <div class="post-meta">
                                            <span class="meta-author"><i class="icon-user"></i><a>{{$blog->user->name}}</a></span>
                                            <span class="meta-date"><i class="icon-time"></i>{{ $blog->created_at->format('M d, Y') }}</span>
                                            <span class="meta-categories"><i class="icon-suitcase"></i><a href="#">{{ $blog->category->first()->name_category }},...</a></span>
                                            <span class="meta-comment"><i class="icon-comments-alt"></i><a href="#">{{count($blog->comments)}}</a></span>
                                        </div>
                                        <div class="post-content">
                                            {{--<p>{{substr($blog->description, 0, 888)}}</p>--}}
                                            <p>{!! substr($blog->description, 0, 444) !!}</p>
                                            <a href="{{route('user.blog.detail', $blog->id) }}" class="post-read-more button color small">Continue reading</a>
                                        </div><!-- End post-content -->
                                    </div><!-- End post-inner -->
                                </article><!-- End article.post -->
                            @elseif ($blog->type == 2)
                                <article class="post blog_2 clearfix">
                                    <div class="post-inner">
                                        <h2 class="post-title"><span class="post-type"><i class="icon-film"></i></span><a href="">{{$blog->title}}</a></h2>
                                        @switch( $blog->approve_status )
                                            @case (0)
                                            <div class="question-type-main" style="background-color: #ee9900; float: right;"><i class="icon-spinner"></i>Pending</div>
                                            @break;
                                            @case (1)
                                            <div class="question-type-main" style="background-color: #2fa360; float: right"><i class="icon-ok"></i>Approved</div>
                                            @break;
                                            @case (2)
                                            <div class="question-type-main" style="background-color: red; float: right;"><i class="icon-remove"></i>Denied</div>
                                            @break;
                                        @endswitch
                                        <div class="flexslider blog_silder margin_b_20 post-img">
                                            <ul class="slides">
                                                @foreach($blog->blogUploaded as $img)
                                                    <li><img src="{{ asset('/upload/blogs/'.$img->filename) }}" alt=""></li>
                                                @endforeach
                                            </ul>
                                        </div><!-- End flexslider -->
                                        <div class="post-meta">
                                            <span class="meta-author"><i class="icon-user"></i><a href="#">{{$blog->user->name}}</a></span>
                                            <span class="meta-date"><i class="icon-time"></i>{{ $blog->created_at->format('M d, Y') }}</span>
                                            <span class="meta-categories"><i class="icon-suitcase"></i><a href="#">{{ $blog->category->first()->name_category }},...</a></span>
                                            <span class="meta-comment"><i class="icon-comments-alt"></i><a href="#">{{count($blog->comments)}}</a></span>
                                        </div>
                                        <div class="post-content">
                                            <p>{!! substr($blog->description, 0, 444) !!}</p>
                                            <a href="{{route('user.blog.detail', $blog->id) }}" class="post-read-more button color small">Continue reading</a>
                                        </div><!-- End post-content -->
                                    </div><!-- End post-inner -->
                                </article><!-- End article.post -->
                            @elseif ($blog->type == 3)
                                <article class="post blog_2 clearfix">
                                    <div class="post-inner">
                                        <h2 class="post-title"><span class="post-type"><i class="icon-play-circle"></i></span><a href="">{{ $blog->title }}</a></h2>
                                        @switch( $blog->approve_status )
                                            @case (0)
                                            <div class="question-type-main" style="background-color: #ee9900; float: right;"><i class="icon-spinner"></i>Pending</div>
                                            @break;
                                            @case (1)
                                            <div class="question-type-main" style="background-color: #2fa360; float: right"><i class="icon-ok"></i>Approved</div>
                                            @break;
                                            @case (2)
                                            <div class="question-type-main" style="background-color: red; float: right;"><i class="icon-remove"></i>Denied</div>
                                            @break;
                                        @endswitch
                                        <div class="video_embed post-img">{!! $blog->getVideoHtmlAttribute($blog->url, 500, 200) !!}</div>
                                        <div class="post-meta">
                                            <span class="meta-author"><i class="icon-user"></i><a href="#">{{$blog->user->name}}</a></span>
                                            <span class="meta-date"><i class="icon-time"></i>{{ $blog->created_at->format('M d, Y') }}</span>
                                            <span class="meta-categories"><i class="icon-suitcase"></i><a href="#">{{ $blog->category->first()->name_category }},...</a></span>
                                            <span class="meta-comment"><i class="icon-comments-alt"></i><a href="#">{{count($blog->comments)}}</a></span>
                                        </div>
                                        <div class="post-content">
                                            {{--<p>{{substr($blog->description, 0, 888)}}</p>--}}
                                            <p>{!! substr($blog->description, 0, 444) !!}</p>
                                            <a href="{{route('user.blog.detail', $blog->id) }}" class="post-read-more button color small">Continue reading</a>
                                        </div><!-- End post-content -->
                                    </div><!-- End post-inner -->
                                </article><!-- End article.post -->
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="height_20"></div>

            </div><!-- End main -->

            @include('layouts.asside_bar')

        </div><!-- End row -->
    </section><!-- End container -->
@endsection
