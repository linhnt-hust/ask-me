@extends('layouts.master')
@section('title')
Ask me – Anything you wanted to know 
@endsection
@section('content')
<div class="section-warp ask-me">
    <div class="container clearfix">
        <div class="box_icon box_warp box_no_border box_no_background" box_border="transparent" box_background="transparent" box_color="#FFF">
            <div class="row">
                <div class="col-md-3">
                    <h2>Welcome to Ask me</h2>
                    <p>AskMe’s mission is to share and grow the world’s knowledge. We want to bring together people with different perspectives so they can understand each other better, and to empower everyone to share their knowledge for the benefit of the rest of the world</p>
                    <div class="clearfix"></div>
                    <a class="color button dark_button medium" href="#">About Us</a>
                    <a class="color button dark_button medium" href="#">Join Now</a>
                </div>
                <div class="col-md-9">
                    <form class="form-style form-style-2">
                        <p>
                            <textarea rows="4" id="question_title" onfocus="if(this.value=='Ask any question and you be sure find your answer ?')this.value='';" onblur="if(this.value=='')this.value='Ask any question and you be sure find your answer ?';">Ask any question and you be sure find your answer ?</textarea>
                            <i class="icon-pencil"></i>
                            <span class="color button small publish-question">Ask Now</span>
                        </p>
                    </form>
                </div>
            </div><!-- End row -->
        </div><!-- End box_icon -->
    </div><!-- End container -->
</div><!-- End section-warp -->
<section class="container main-content">
    <div class="row">
        <div class="col-md-9">
            <div class="tabs-warp question-tab">
                <ul class="tabs">
                    <li class="tab"><a href="#" class="current">Recent Questions</a></li>
                    <li class="tab"><a href="#">Most Responses</a></li>
                    <li class="tab"><a href="#">Recently Answered</a></li>
                    <li class="tab"><a href="#">No answers</a></li>
                </ul>
                <div class="tab-inner-warp">
                    <div class="tab-inner">
                        @foreach( $recentQuestions as $recentQuestion)
                        <article class="question question-type-normal">
                            <h2>
                                <a href="{{ route('question.show', $recentQuestion->id) }}"> {{ $recentQuestion->title }}</a>
                            </h2>
                            @if (Auth::user() && $recentQuestion->user->id != Auth::user()->id)
                                <a class="question-report" href="{{ route('question.show', $recentQuestion->id) }}">Report</a>
                            @endif
                            @if ( $recentQuestion->question_poll == 0)
                            <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                            @else
                            <div class="question-type-main"><i class="icon-signal"></i>Poll</div>
                            @endif
                            <div class="question-author">
                                <a href="#" original-title="{{ $recentQuestion->user->name }}" class="question-author-img tooltip-n"><span></span><img alt="" src="{{ asset('/avatar/users/'.$recentQuestion->user->avatar) }}"></a>
                            </div>
                            <div class="question-inner">
                                <div class="clearfix"></div>
                                <p class="question-desc"> {{ $recentQuestion->details }}</p>
                                <div class="question-details">
                                    @if ($recentQuestion->is_solved == 0)
                                        <div class="question-answered"><i class="icon-ok"></i>in progress</div>
                                    @else
                                        <div class="question-answered question-answered-done"><i class="icon-ok"></i>solved</div>
                                    @endif
                                    {{--<span class="question-favorite"><i class="icon-star"></i>5</span>--}}
                                </div>
                                <span class="question-category"><a href="{{route('question.category.detail',$recentQuestion->category_id )}}"><i class="icon-folder-close"></i>{{ optional($recentQuestion->category)->name_category }}</a></span>
                                <span class="question-date"><i class="icon-time"></i>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $recentQuestion->updated_at)->diffForHumans() }}</span>
                                <span class="question-comment"><a href="#"><i class="icon-comment"></i>{{ count($recentQuestion->comments) }}</a></span>
                                {{--<span class="question-view"><i class="icon-user"></i>70 views</span>--}}
                                <div class="clearfix"></div>
                            </div>
                        </article>
                        @endforeach
                        <a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>
                    </div>
                </div>
                <div class="tab-inner-warp">
                    <div class="tab-inner">
                        @foreach( $mostResponseQuestions as $mostResponseQuestion)
                            <article class="question question-type-normal">
                                <h2>
                                    <a href="{{ route('question.show', $mostResponseQuestion->id) }}"> {{ $mostResponseQuestion->title }}</a>
                                </h2>
                                @if (Auth::user() && $mostResponseQuestion->user->id != Auth::user()->id)
                                    <a class="question-report" href="{{ route('question.show', $mostResponseQuestion->id) }}">Report</a>
                                @endif
                                @if ( $mostResponseQuestion->question_poll == 0)
                                    <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                                @else
                                    <div class="question-type-main"><i class="icon-signal"></i>Poll</div>
                                @endif
                                <div class="question-author">
                                    <a href="#" original-title="{{ $mostResponseQuestion->user->name }}" class="question-author-img tooltip-n"><span></span><img alt="" src="{{ asset('/avatar/users/'.$mostResponseQuestion->user->avatar) }}"></a>
                                </div>
                                <div class="question-inner">
                                    <div class="clearfix"></div>
                                    <p class="question-desc"> {{ $mostResponseQuestion->details }}</p>
                                    <div class="question-details">
                                        @if ($mostResponseQuestion->is_solved == 0)
                                            <div class="question-answered"><i class="icon-ok"></i>in progress</div>
                                        @else
                                            <div class="question-answered question-answered-done"><i class="icon-ok"></i>solved</div>
                                        @endif
                                        {{--<span class="question-favorite"><i class="icon-star"></i>5</span>--}}
                                    </div>
                                    <span class="question-category"><a href="{{route('question.category.detail',$mostResponseQuestion->category_id )}}"><i class="icon-folder-close"></i>{{ optional($mostResponseQuestion->category)->name_category }}</a></span>
                                    <span class="question-date"><i class="icon-time"></i>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $mostResponseQuestion->updated_at)->diffForHumans() }}</span>
                                    <span class="question-comment"><a href="#"><i class="icon-comment"></i>{{ count($mostResponseQuestion->comments) }}</a></span>
                                    <div class="clearfix"></div>
                                </div>
                            </article>
                        @endforeach
                        <a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>
                    </div>
                </div>
                <div class="tab-inner-warp">
                    <div class="tab-inner">
                        @foreach( $recentAnswerQuestions as $recentAnswerQuestion)
                            <article class="question question-type-normal">
                                <h2>
                                    <a href="{{ route('question.show', $recentAnswerQuestion->id) }}"> {{ $recentAnswerQuestion->title }}</a>
                                </h2>
                                @if (Auth::user() && $recentAnswerQuestion->user->id != Auth::user()->id)
                                    <a class="question-report" href="{{ route('question.show', $recentAnswerQuestion->id) }}">Report</a>
                                @endif
                                @if ( $recentAnswerQuestion->question_poll == 0)
                                    <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                                @else
                                    <div class="question-type-main"><i class="icon-signal"></i>Poll</div>
                                @endif
                                <div class="question-author">
                                    <a href="#" original-title="{{ $recentAnswerQuestion->user->name }}" class="question-author-img tooltip-n"><span></span><img alt="" src="{{ asset('/avatar/users/'.$recentAnswerQuestion->user->avatar) }}"></a>
                                </div>
                                <div class="question-inner">
                                    <div class="clearfix"></div>
                                    <p class="question-desc"> {{ $recentAnswerQuestion->details }}</p>
                                    <div class="question-details">
                                        @if ($recentAnswerQuestion->is_solved == 0)
                                            <div class="question-answered"><i class="icon-ok"></i>in progress</div>
                                        @else
                                            <div class="question-answered question-answered-done"><i class="icon-ok"></i>solved</div>
                                        @endif
                                        {{--<span class="question-favorite"><i class="icon-star"></i>5</span>--}}
                                    </div>
                                    <span class="question-category"><a href="{{route('question.category.detail',$recentAnswerQuestion->category_id )}}"><i class="icon-folder-close"></i>{{ optional($recentAnswerQuestion->category)->name_category }}</a></span>
                                    <span class="question-date"><i class="icon-time"></i>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $recentAnswerQuestion->updated_at)->diffForHumans() }}</span>
                                    <span class="question-comment"><a href="#"><i class="icon-comment"></i>{{ count($recentAnswerQuestion->comments) }}</a></span>
                                    <div class="clearfix"></div>
                                </div>
                            </article>
                        @endforeach
                        <a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>
                    </div>
                </div>
                <div class="tab-inner-warp">
                    <div class="tab-inner">
                        @foreach( $noAnswerQuestions as $noAnswerQuestion)
                            <article class="question question-type-normal">
                                <h2>
                                    <a href="{{ route('question.show', $noAnswerQuestion->id) }}"> {{ $noAnswerQuestion->title }}</a>
                                </h2>
                                @if (Auth::user() && $noAnswerQuestion->user->id != Auth::user()->id)
                                    <a class="question-report" href="{{ route('question.show', $noAnswerQuestion->id) }}">Report</a>
                                @endif
                                @if ( $noAnswerQuestion->question_poll == 0)
                                    <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                                @else
                                    <div class="question-type-main"><i class="icon-signal"></i>Poll</div>
                                @endif
                                <div class="question-author">
                                    <a href="#" original-title="{{ $noAnswerQuestion->user->name }}" class="question-author-img tooltip-n"><span></span><img alt="" src="{{ asset('/avatar/users/'.$noAnswerQuestion->user->avatar) }}"></a>
                                </div>
                                <div class="question-inner">
                                    <div class="clearfix"></div>
                                    <p class="question-desc"> {{ $noAnswerQuestion->details }}</p>
                                    <div class="question-details">
                                        @if ($noAnswerQuestion->is_solved == 0)
                                            <div class="question-answered"><i class="icon-ok"></i>in progress</div>
                                        @else
                                            <div class="question-answered question-answered-done"><i class="icon-ok"></i>solved</div>
                                        @endif
                                        {{--<span class="question-favorite"><i class="icon-star"></i>5</span>--}}
                                    </div>
                                    <span class="question-category"><a href="{{route('question.category.detail',$noAnswerQuestion->category_id )}}"><i class="icon-folder-close"></i>{{ optional($noAnswerQuestion->category)->name_category }}</a></span>
                                    <span class="question-date"><i class="icon-time"></i>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $noAnswerQuestion->updated_at)->diffForHumans() }}</span>
                                    <span class="question-comment"><a href="#"><i class="icon-comment"></i>{{ count($noAnswerQuestion->comments) }}</a></span>
                                    <div class="clearfix"></div>
                                </div>
                            </article>
                        @endforeach
                        <a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>
                    </div>
                </div>
            </div><!-- End page-content -->
        </div><!-- End main -->

        @include('layouts.asside_bar')

    </div><!-- End row -->
</section><!-- End container -->
@endsection
@section('inline_scripts')
    <script lang = "javascript" >
    var _vc_data = {
    id: 4944425,
    secret: 'e54fbccd97d2e8bac00ade6a1eb2b7c5'
    };
    (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.defer = true;
    ga.src = '//live.vnpgroup.net/client/tracking.js?id=4944425';
    var s = document.getElementsByTagName('script');
    s[0].parentNode.insertBefore(ga, s[0]);
    })();
    </script>
@endsection
