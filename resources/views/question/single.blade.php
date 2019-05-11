@extends('layouts.master')
@section('title')
    All Question Text
@endsection
@section('content')
    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Questions Single</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="{{ route('home') }}">Home</a>
                        <span class="crumbs-span">/</span>
                        <span class="current">All Questions Text</span>
                    </div>
                </div>
            </div><!-- End row -->
        </section><!-- End container -->
    </div><!-- End breadcrumbs -->
    <section class="container main-content">
        <div class="row">
            <div class="col-md-9">
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
                            <p class="question-desc"> {{ $question->details }}</p>
                            <div class="question-details">
                                @if ($question->is_solved == 0)
                                    <div class="question-answered"><i class="icon-ok"></i>in progress</div>
                                @else
                                    <div class="question-answered question-answered-done"><i class="icon-ok"></i>solved</div>
                                @endif
                                {{--<span class="question-favorite"><i class="icon-star"></i>5</span>--}}
                            </div>
                            <span class="question-category"><a href="#"><i class="icon-folder-close"></i>{{ optional($question->category)->name_category }}</a></span>
                            <span class="question-date"><i class="icon-time"></i>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $question->updated_at)->diffForHumans() }}</span>
                            <span class="question-comment"><a href="#"><i class="icon-comment"></i>{{count($question->comments)}}</a></span>
                            <span class="question-view"><i class="icon-user"></i>70 views</span>
                            <div class="clearfix"></div>
                        </div>
                    </article>
                @endforeach

                {{ $questions->render('partials.pagination') }}
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
