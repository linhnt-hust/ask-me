@extends('layouts.master')
@section('title')
    Blog list
@endsection
@section('content')
    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Blog</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="#">Home</a>
                        <span class="crumbs-span">/</span>
                        <span class="current">Blog</span>
                    </div>
                </div>
            </div><!-- End row -->
        </section><!-- End container -->
    </div><!-- End breadcrumbs -->
    <section class="container main-content">
        <div class="row">
            <div class="col-md-9">
                <a href="{{ route('blog.create') }}" class="post-create button color small">CREATE BLOG</a>
            </div>
            <br>
            <br>
            <br>
            <div class="col-md-9">
                @foreach ($blogs as $blog)
                    @if ($blog->type == 1)
                        <article class="post blog_2 clearfix">
                            <div class="post-inner">
                                <h2 class="post-title"><span class="post-type"><i class="icon-file-alt"></i></span><a href="">{{ $blog->title }}</a></h2>
                                <div class="post-meta">
                                    <span class="meta-author"><i class="icon-user"></i><a>{{$blog->user->name}}</a></span>
                                    <span class="meta-date"><i class="icon-time"></i>{{ $blog->created_at->format('M d, Y') }}</span>
                                    <span class="meta-categories"><i class="icon-suitcase"></i><a href="#">{{ $blog->category->first()->name_category }},...</a></span>
                                    <span class="meta-comment"><i class="icon-comments-alt"></i><a href="#">{{count($blog->comments)}}</a></span>
                                </div>
                                <div class="post-content">
                                    {{--<p>{{substr($blog->description, 0, 888)}}</p>--}}
                                    <p>{!! substr($blog->description, 0, 888) !!}</p>
                                    <a href="{{route('blog.show', $blog->id) }}" class="post-read-more button color small">Continue reading</a>
                                </div><!-- End post-content -->
                            </div><!-- End post-inner -->
                        </article><!-- End article.post -->
                        @elseif ($blog->type == 2)
                        <article class="post blog_2 clearfix">
                            <div class="post-inner">
                                <h2 class="post-title"><span class="post-type"><i class="icon-film"></i></span><a href="">{{$blog->title}}</a></h2>
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
                                    <p>{!! substr($blog->description, 0, 888) !!}</p>
                                    <a href="{{route('blog.show', $blog->id) }}" class="post-read-more button color small">Continue reading</a>
                                </div><!-- End post-content -->
                            </div><!-- End post-inner -->
                        </article><!-- End article.post -->
                        @elseif ($blog->type == 3)
                        <article class="post blog_2 clearfix">
                            <div class="post-inner">
                                <h2 class="post-title"><span class="post-type"><i class="icon-play-circle"></i></span><a href="">{{ $blog->title }}</a></h2>
                                <div class="video_embed post-img">{!! $blog->getVideoHtmlAttribute($blog->url, 500, 200) !!}</div>
                                <div class="post-meta">
                                    <span class="meta-author"><i class="icon-user"></i><a href="#">{{$blog->user->name}}</a></span>
                                    <span class="meta-date"><i class="icon-time"></i>{{ $blog->created_at->format('M d, Y') }}</span>
                                    <span class="meta-categories"><i class="icon-suitcase"></i><a href="#">{{ $blog->category->first()->name_category }},...</a></span>
                                    <span class="meta-comment"><i class="icon-comments-alt"></i><a href="#">{{count($blog->comments)}}</a></span>
                                </div>
                                <div class="post-content">
                                    {{--<p>{{substr($blog->description, 0, 888)}}</p>--}}
                                    <p>{!! substr($blog->description, 0, 888) !!}</p>
                                    <a href="{{route('blog.show', $blog->id) }}" class="post-read-more button color small">Continue reading</a>
                                </div><!-- End post-content -->
                            </div><!-- End post-inner -->
                        </article><!-- End article.post -->
                    @endif
                @endforeach





                    {{--<article class="post blog_2 clearfix">--}}
                        {{--<div class="post-inner">--}}
                            {{--<h2 class="post-title"><span class="post-type"><i class="icon-picture"></i></span><a href="single_post.html">This is a Standard Post.</a></h2>--}}
                            {{--<div class="post-img"><a href="single_post.html"><img src="http://placehold.it/250x190/222/FFF" alt=""></a></div>--}}
                            {{--<div class="post-meta">--}}
                                {{--<span class="meta-author"><i class="icon-user"></i><a href="#">Administrator</a></span>--}}
                                {{--<span class="meta-date"><i class="icon-time"></i>September 30 , 2013</span>--}}
                                {{--<span class="meta-categories"><i class="icon-suitcase"></i><a href="#">Wordpress</a></span>--}}
                                {{--<span class="meta-comment"><i class="icon-comments-alt"></i><a href="#">15 comments</a></span>--}}
                            {{--</div>--}}
                            {{--<div class="post-content">--}}
                                {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate posuere nisl quis consequat.</p>--}}
                                {{--<a href="single_post.html" class="post-read-more button color small">Continue reading</a>--}}
                            {{--</div><!-- End post-content -->--}}
                        {{--</div><!-- End post-inner -->--}}
                    {{--</article><!-- End article.post -->                --}}

                <div class="pagination">
                    <a href="#" class="prev-button"><i class="icon-angle-left"></i></a>
                    <span class="current">1</span>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <span>...</span>
                    <a href="#">11</a>
                    <a href="#">12</a>
                    <a href="#">13</a>
                    <a href="#" class="next-button"><i class="icon-angle-right"></i></a>
                </div><!-- End pagination -->
            </div><!-- End main -->

            @include('layouts.asside_bar')

        </div><!-- End row -->
    </section><!-- End container -->

@endsection


