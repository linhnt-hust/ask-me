@extends('layouts.master')
@section('title')
    User Questions
@endsection
@section('content')
    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>User Questions : {{ $user->name }}</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="#">Home</a>
                        <span class="crumbs-span">/</span>
                        <a href="#">User</a>
                        <span class="crumbs-span">/</span>
                        <span class="current">User Questions : {{ $user->name }}</span>
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
                        <div class="col-md-12">
                            <div class="page-content page-content-user-profile">
                                <div class="user-profile-widget">
                                    <h2>User Stats</h2>
                                    <div class="ul_list ul_list-icon-ok">
                                        <ul>
                                            <li><i class="icon-question-sign"></i>Questions<span> ( <span>{{ count($userQuestions) }}</span> ) </span></a></li>
                                            <li><i class="icon-comment"></i><a href="user_answers.html">Answers<span> ( <span>10</span> ) </span></a></li>
                                            <li><i class="icon-star"></i><a href="user_favorite_questions.html">Favorite Questions<span> ( <span>3</span> ) </span></a></li>
                                            <li><i class="icon-heart"></i><a href="user_points.html">Points<span> ( <span>20</span> ) </span></a></li>
                                            <li><i class="icon-asterisk"></i>Best Answers<span> ( <span>2</span> ) </span></li>
                                        </ul>
                                    </div>
                                </div><!-- End user-profile-widget -->
                            </div><!-- End page-content -->
                        </div><!-- End col-md-12 -->
                    </div><!-- End user-profile -->
                </div><!-- End row -->
                <div class="clearfix"></div>
                <div class="page-content page-content-user">
                    <div class="user-questions">
                        @foreach($userQuestions as $userQuestion)
                        <article class="question user-question">
                            <h3>
                                <a href="{{ route('user.question.detail', $userQuestion->id) }}">{{ $userQuestion-> title }}</a>
                            </h3>

                            @switch( $userQuestion->approve_status )
                                @case (0)
                                    <div class="question-type-main"><i class="icon-spinner"></i>Pending</div>
                                    @break;
                                @case (1)
                                    <div class="question-type-main"><i class="icon-ok"></i>Approved</div>
                                    @break;
                                @case (2)
                                    <div class="question-type-main"><i class="icon-remove"></i>Denied</div>
                                    @break;
                            @endswitch

                            <div class="question-content">
                                <div class="question-bottom">
                                    <div class="question-answered"><i class="icon-ok"></i>in progress</div>
                                    <span class="question-favorite"><i class="icon-star"></i>5</span>
                                    <span class="question-category"><a href="#"><i class="icon-folder-close"></i>wordpress</a></span>
                                    <span class="question-date"><i class="icon-time"></i>15 secs ago</span>
                                    <span class="question-comment"><a href="#"><i class="icon-comment"></i>5 Answers</a></span>
                                    <a class="question-reply" href="#"><i class="icon-reply"></i>Reply</a>
                                    <span class="question-view"><i class="icon-user"></i>70 views</span>
                                </div>
                            </div>
                        </article>
                        @endforeach
                        {{--<article class="question user-question">--}}
                            {{--<h3>--}}
                                {{--<a href="single_question_poll.html">This Is My Second Poll Question</a>--}}
                            {{--</h3>--}}
                            {{--<div class="question-type-main"><i class="icon-signal"></i>Poll</div>--}}
                            {{--<div class="question-content">--}}
                                {{--<div class="question-bottom">--}}
                                    {{--<span class="question-favorite"><i class="icon-star-empty"></i>0</span>--}}
                                    {{--<span class="question-category"><a href="#"><i class="icon-folder-close"></i>CSS</a></span>--}}
                                    {{--<span class="question-date"><i class="icon-time"></i>15 secs ago</span>--}}
                                    {{--<span class="question-comment"><a href="#"><i class="icon-comment"></i>5 Answers</a></span>--}}
                                    {{--<a class="question-reply" href="#"><i class="icon-reply"></i>Reply</a>--}}
                                    {{--<span class="question-view"><i class="icon-user"></i>70 views</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</article>--}}
                        {{--<article class="question user-question">--}}
                            {{--<h3>--}}
                                {{--<a href="single_question.html">This is my third Question</a>--}}
                            {{--</h3>--}}
                            {{--<div class="question-type-main"><i class="icon-question-sign"></i>Question</div>--}}
                            {{--<div class="question-content">--}}
                                {{--<div class="question-bottom">--}}
                                    {{--<div class="question-answered question-answered-done"><i class="icon-ok"></i>solved</div>--}}
                                    {{--<span class="question-favorite"><i class="icon-star-empty"></i>0</span>--}}
                                    {{--<span class="question-category"><a href="#"><i class="icon-folder-close"></i>HTML</a></span>--}}
                                    {{--<span class="question-date"><i class="icon-time"></i>15 secs ago</span>--}}
                                    {{--<span class="question-comment"><a href="#"><i class="icon-comment"></i>5 Answers</a></span>--}}
                                    {{--<a class="question-reply" href="#"><i class="icon-reply"></i>Reply</a>--}}
                                    {{--<span class="question-view"><i class="icon-user"></i>70 views</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</article>--}}
                        {{--<article class="question user-question">--}}
                            {{--<h3>--}}
                                {{--<a href="single_question.html">This is my fourth Question</a>--}}
                            {{--</h3>--}}
                            {{--<div class="question-type-main"><i class="icon-question-sign"></i>Question</div>--}}
                            {{--<div class="question-content">--}}
                                {{--<div class="question-bottom">--}}
                                    {{--<span class="question-favorite"><i class="icon-star-empty"></i>0</span>--}}
                                    {{--<span class="question-category"><a href="#"><i class="icon-folder-close"></i>PHP</a></span>--}}
                                    {{--<span class="question-date"><i class="icon-time"></i>15 secs ago</span>--}}
                                    {{--<span class="question-comment"><a href="#"><i class="icon-comment"></i>5 Answers</a></span>--}}
                                    {{--<a class="question-reply" href="#"><i class="icon-reply"></i>Reply</a>--}}
                                    {{--<span class="question-view"><i class="icon-user"></i>70 views</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</article>--}}
                        {{--<article class="question user-question">--}}
                            {{--<h3>--}}
                                {{--<a href="single_question.html">This is my fifth Question</a>--}}
                            {{--</h3>--}}
                            {{--<div class="question-type-main"><i class="icon-question-sign"></i>Question</div>--}}
                            {{--<div class="question-content">--}}
                                {{--<div class="question-bottom">--}}
                                    {{--<div class="question-answered"><i class="icon-ok"></i>in progress</div>--}}
                                    {{--<span class="question-favorite"><i class="icon-star-empty"></i>0</span>--}}
                                    {{--<span class="question-category"><a href="#"><i class="icon-folder-close"></i>jQuery</a></span>--}}
                                    {{--<span class="question-date"><i class="icon-time"></i>15 secs ago</span>--}}
                                    {{--<span class="question-comment"><a href="#"><i class="icon-comment"></i>5 Answers</a></span>--}}
                                    {{--<a class="question-reply" href="#"><i class="icon-reply"></i>Reply</a>--}}
                                    {{--<span class="question-view"><i class="icon-user"></i>70 views</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</article>--}}
                    </div>
                </div>

                <div class="height_20"></div>

                {{--<div class="pagination">--}}
                    {{--<a href="#" class="prev-button"><i class="icon-angle-left"></i></a>--}}
                    {{--<span class="current">1</span>--}}
                    {{--<a href="#">2</a>--}}
                    {{--<a href="#">3</a>--}}
                    {{--<a href="#">4</a>--}}
                    {{--<a href="#">5</a>--}}
                    {{--<span>...</span>--}}
                    {{--<a href="#">11</a>--}}
                    {{--<a href="#">12</a>--}}
                    {{--<a href="#">13</a>--}}
                    {{--<a href="#" class="next-button"><i class="icon-angle-right"></i></a>--}}
                {{--</div><!-- End pagination -->--}}
                {!! $userQuestions->render() !!}
                <!-- if no questions
                <p>No questions yet</p>
                -->
            </div><!-- End main -->

            @include('layouts.asside_bar')

        </div><!-- End row -->
    </section><!-- End container -->
@endsection
