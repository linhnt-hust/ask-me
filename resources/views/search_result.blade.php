@extends('layouts.master')
@section('title')
    Search Result
@endsection
@section('content')
    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Data with keyword: {{$search}}</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="{{ route('home') }}">Home</a>
                        <span class="crumbs-span">/</span>
                        <span class="current">Search Result</span>
                    </div>
                </div>
            </div><!-- End row -->
        </section><!-- End container -->
    </div><!-- End breadcrumbs -->
    <section class="container main-content">
        <div class="row">
            <div class="col-md-9">
                <div class="tabs-warp question-tab">
                    <ul class="tabs">
                        <li class="tab"><a href="#" class="current">Questions</a></li>
                        <li class="tab"><a href="#">Blogs</a></li>
                        <li class="tab"><a href="#">Categories</a></li>
                        <li class="tab"><a href="#">Tags</a></li>
                    </ul>
                    <div class="tab-inner-warp">
                        <div class="tab-inner">
                            @foreach( $questions as $question)
                                <article class="question question-type-normal">
                                    <h2>
                                        <a href="{{ route('question.show', $question->id) }}"> {{ $question->title }}</a>
                                    </h2>
                                    <a class="question-report" href="#">Report</a>
                                    @if ( $question->question_poll == 0)
                                        <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                                    @else
                                        <div class="question-type-main"><i class="icon-signal"></i>Poll</div>
                                    @endif
                                    <div class="question-author">
                                        <a href="#" original-title="{{ $question->user->name }}" class="question-author-img tooltip-n"><span></span><img alt="" src="{{ asset('/avatar/users/'.$question->user->avatar) }}"></a>
                                    </div>
                                    <div class="question-inner">
                                        <div class="clearfix"></div>
                                        <p class="question-desc"> {{ substr($question->details, 0, 500) }}</p>
                                        <div class="question-details">
                                            @if ($question->is_solved == 0)
                                                <div class="question-answered"><i class="icon-ok"></i>in progress</div>
                                            @else
                                                <div class="question-answered question-answered-done"><i class="icon-ok"></i>solved</div>
                                            @endif
                                            {{--<span class="question-favorite"><i class="icon-star"></i>5</span>--}}
                                        </div>
                                        <span class="question-category"><a href="{{route('question.category.detail',$question->category_id )}}"><i class="icon-folder-close"></i>{{ optional($question->category)->name_category }}</a></span>
                                        <span class="question-date"><i class="icon-time"></i>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $question->updated_at)->diffForHumans() }}</span>
                                        <span class="question-comment"><a href="#"><i class="icon-comment"></i>{{count($question->comments)}}</a></span>
                                        {{--<span class="question-view"><i class="icon-user"></i>70 views</span>--}}
                                        <div class="clearfix"></div>
                                    </div>
                                </article>
                            @endforeach

                            {{ $questions->render('partials.pagination') }}
                        </div>
                    </div>
                    <div class="tab-inner-warp">
                        <div class="tab-inner">
                            @foreach ($blogs as $blog)
                                @if ($blog->type == 1)
                                    <article class="post blog_2 clearfix">
                                        <div class="post-inner">
                                            <h2 class="post-title"><span class="post-type"><i class="icon-file-alt"></i></span><a href="">{{ $blog->title }}</a></h2>
                                            <div class="post-meta">
                                                <span class="meta-author"><i class="icon-user"></i><a>{{$blog->user->name}}</a></span>
                                                <span class="meta-date"><i class="icon-time"></i>{{ $blog->created_at->format('M d, Y') }}</span>
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
                                                <span class="meta-comment"><i class="icon-comments-alt"></i><a href="#">{{count($blog->comments)}}</a></span>
                                            </div>
                                            <div class="post-content">
                                                <p>{!! substr($blog->description, 0, 888) !!}</p>
                                                <a href="{{route('blog.show', $blog->id) }}" class="post-read-more button color small">Continue reading</a>
                                            </div><!-- End post-content -->
                                        </div><!-- End post-inner -->
                                    </article><!-- End article.post -->
                                @endif
                            @endforeach
                            {{ $blogs->render('partials.pagination') }}
                        </div>
                    </div>

                    <div class="tab-inner-warp">
                        <div class="tab-inner">
                            <div class="widget widget_tag_cloud">
                                <div class="ul_list ul_list-icon-ok ul_list_circle" list_background="#1abc9c" list_background_hover="#34495E" list_color="#FFF">
                                    <ul>
                                        @foreach($categories as $category)
                                            <li onclick="location.href='http://localhost:8000/category/detail/{{$category->id}};'"><i l_background="#3498db" l_background_hover="#34495E" class="icon-ok-sign ul_l_circle"></i>{{ $category->name_category }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-inner-warp">
                        <div class="tab-inner">
                            <div class="widget widget_tag_cloud">
                                <h3 class="widget_title">Tags</h3>
                                @foreach($tags as $tag)
                                    <a href="{{ route('question.tag.detail', $tag->id) }}">{{$tag->name_tag}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

            </div><!-- End main -->
            @include('layouts.asside_bar')

        </div><!-- End row -->
    </section><!-- End container -->
@endsection
@section('page_scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function(){
            // $('.accordion-inner').show();
        });
    </script>
@endsection
