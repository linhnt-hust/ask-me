@extends('layouts.master')
@section('title')
    Question Details
@endsection
@section('content')
    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $questionDetail->title }}</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="#">Home</a>
                        <span class="crumbs-span">/</span>
                        <a href="#">Questions</a>
                        <span class="crumbs-span">/</span>
                        <span class="current">{{ $questionDetail->title }}</span>
                    </div>
                </div>
            </div><!-- End row -->
        </section><!-- End container -->
    </div><!-- End breadcrumbs -->

    <section class="container main-content">
        <div class="row">
            <div class="col-md-9">
                <article class="question single-question question-type-normal">
                    <h2>
                        <a href="#">{{ $questionDetail->title }}</a>
                    </h2>
                    @if ($questionDetail->is_solved == 0)
                    <a class="question-report" href="{{ route('user.question.close', $questionDetail->id) }}">Close</a>
                    @else
                    <a class="question-report" href="{{ route('user.question.reopen', $questionDetail->id) }}">ReOpen</a>
                    @endif
                    @switch( $questionDetail->approve_status )
                        @case (0)
                        <div class="question-type-main" style="background-color: #ee9900"><i class="icon-spinner"></i>Pending</div>
                        @break;
                        @case (1)
                        <div class="question-type-main" style="background-color: #2fa360"><i class="icon-ok"></i>Approved</div>
                        @break;
                        @case (2)
                        <div class="question-type-main" style="background-color: red"><i class="icon-remove"></i>Denied</div>
                        @break;
                    @endswitch

                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <div class="question-desc">
                            <p> {{ $questionDetail->details }}</p>
                            <div class="post-img"><a><img src="{{ asset('/upload/questions/'.$questionDetail->filename) }}" alt=""></a></div>
                        </div>
                        <div class="question-details">
                            @if ($questionDetail->is_solved == 1)
                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>solved</span>
                            @else
                            <div class="question-answered"><i class="icon-ok"></i>in progress</div>
                            @endif
                            {{--<span class="question-favorite"><i class="icon-star"></i>5</span>--}}
                        </div>
                        <span class="question-category"><a href="{{route('question.category.detail',optional($questionDetail->category)->id )}}"><i class="icon-folder-close"></i>{{ optional($questionDetail->category)->name_category }}</a></span>
                        <span class="question-date"><i class="icon-time"></i>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $questionDetail->updated_at)->diffForHumans() }}</span>
                        <span class="question-comment"><a href="#"><i class="icon-comment"></i>5 Answer</a></span>
                        <span class="question-view"><i class="icon-user"></i>70 views</span>
                        <span class="single-question-vote-result">+22</span>
                        <ul class="single-question-vote">
                            <li><a href="#" class="single-question-vote-down" title="Dislike"><i class="icon-thumbs-down"></i></a></li>
                            <li><a href="#" class="single-question-vote-up" title="Like"><i class="icon-thumbs-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </article>

                <div class="share-tags page-content">
                    <div class="question-tags"><i class="icon-tags"></i>
                        @foreach($questionDetail->tag as $tag)
                        <a href="#">{{ $tag->name_tag }}</a>,
                        @endforeach
                    </div>
                    <div class="share-inside-warp">
                        <ul>
                            <li>
                                <a href="#" original-title="Facebook">
									<span class="icon_i">
										<span class="icon_square" icon_size="20" span_bg="#3b5997" span_hover="#666">
											<i i_color="#FFF" class="social_icon-facebook"></i>
										</span>
									</span>
                                </a>
                                <a href="#" target="_blank">Facebook</a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
									<span class="icon_i">
										<span class="icon_square" icon_size="20" span_bg="#00baf0" span_hover="#666">
											<i i_color="#FFF" class="social_icon-twitter"></i>
										</span>
									</span>
                                </a>
                                <a target="_blank" href="#">Twitter</a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
									<span class="icon_i">
										<span class="icon_square" icon_size="20" span_bg="#ca2c24" span_hover="#666">
											<i i_color="#FFF" class="social_icon-gplus"></i>
										</span>
									</span>
                                </a>
                                <a href="#" target="_blank">Google plus</a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
									<span class="icon_i">
										<span class="icon_square" icon_size="20" span_bg="#e64281" span_hover="#666">
											<i i_color="#FFF" class="social_icon-dribbble"></i>
										</span>
									</span>
                                </a>
                                <a href="#" target="_blank">Dribbble</a>
                            </li>
                            <li>
                                <a target="_blank" href="#">
									<span class="icon_i">
										<span class="icon_square" icon_size="20" span_bg="#c7151a" span_hover="#666">
											<i i_color="#FFF" class="icon-pinterest"></i>
										</span>
									</span>
                                </a>
                                <a href="#" target="_blank">Pinterest</a>
                            </li>
                        </ul>
                        <span class="share-inside-f-arrow"></span>
                        <span class="share-inside-l-arrow"></span>
                    </div><!-- End share-inside-warp -->
                    <div class="share-inside"><i class="icon-share-alt"></i>Share</div>
                    <div class="clearfix"></div>
                </div><!-- End share-tags -->

                <div class="about-author clearfix">
                    <div class="author-image">
                        <a href="#" original-title="admin" class="tooltip-n"><img alt="" src="{{ asset('/avatar/users/'.$questionDetail->user->avatar) }}"></a>
                    </div>
                    <div class="author-bio">
                        <h4>About the Author: {{ $questionDetail->user->name }}</h4>
                        {{ $questionDetail->user->description }}
                    </div>
                </div><!-- End about-author -->

                <div id="related-posts">
                    <h2>Related questions</h2>
                    <ul class="related-posts">
                        @foreach($relatedQuestions as $relate)
                            <li class="related-item"><h3><a href="{{route('question.show', $relate->id)}}"><i class="icon-double-angle-right"></i>{{ $relate->title }}</a></h3></li>
                        @endforeach
                    </ul>
                </div><!-- End related-posts -->

                <div id="commentlist" class="page-content">
                    <div class="boxedtitle page-title"><h2>Answers ( <span class="color" id="count_comment">{{ count($questionDetail->comments )}}</span> )</h2></div>
                    <ol class="commentlist clearfix">

                        @foreach($questionDetail->comments()->orderBy('votes', 'DESC')->get() as $comment)
                            @include('partials.comment_replies', ['comment' => $comment, 'question_id' => $questionDetail->id, 'isSolved'=>$questionDetail->is_solved])
                        @endforeach

                    </ol><!-- End commentlist -->
                </div><!-- End page-content -->

                <div id="respond" class="comment-respond page-content clearfix">
                    <div class="boxedtitle page-title"><h2>Leave a reply</h2></div>
                    <form  id="commentform" class="comment-form" method="POST" action="{{route('comment.store')}}">
                        {{ csrf_field() }}
                        <div id="respond-textarea">
                            <p>
                                <input type="hidden" name="question_id" id="question_id" value="{{ $questionDetail->id }}" />

                                <input type="hidden" name="user_id" id="user_id" value="{{ $questionDetail->user->id }}" />
                                <label class="required" for="comment">Comment<span>*</span></label>

                                <textarea id="comment-body" name="comment_body" aria-required="true" cols="58" rows="8"></textarea>
                            </p>
                        </div>
                        <p class="form-submit">
                            <!-- <input type="submit" id="submitAjax" value="Post your answer" class="button small color"> -->
                            <!-- <div id="submit-comment" class="button small color">Post your answer</div> -->
                        <div id="submit-comment" class="button small color">Post your answer</div>

                        </p>
                    </form>
                </div>

                @if ($questionDetail->approve_status != 0)
                <div id="respond" class="comment-respond page-content clearfix">
                    <div class="author-bio">
                        <h4>Your question has been {{ \App\Models\Question::$approveStatus[$questionDetail->approve_status] }} by Admin</h4>
                        @if ($questionDetail->note)
                            With Note:
                            {{ $questionDetail->note }}
                        @endif
                    </div>
                </div>
                @endif
                @if ($questionDetail->approve_status != 1)
                    <br>
                    <div>
                        <a class="button small color" style="background-color: red; float: right" data-toggle="modal" data-target="#modal-confirm" data-url="{!! URL::route('question.destroy', ['id' => $questionDetail->id]) !!}">Delete</a>
                        <a href="{{route('question.edit', $questionDetail->id)}}" class="button small color" style="background-color: #5bc0de; float: right">Edit</a>
                    </div>
                @endif

            </div><!-- End main -->

            @include('layouts.asside_bar')

        </div><!-- End row -->
    </section><!-- End container -->

@endsection
@section('inline_scripts')
    @parent
    <script type="text/javascript">
        function delete_comment(id, questionId){
            $.ajax({
                type: 'post',
                url: "{{ route('comment.delete') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': id,
                    'question_id': questionId,
                },
                success: function(data) {
                    $("#comment_"+id).remove();
                    $("#count_comment").html(data['comments']);
                },
                error(data) {
                    console.log(data);
                }
            });
        }
        function reply_box(id){
            $(".respond-form-"+id).toggle();
        }

        function up_vote(commentId, votedUser){
            $.ajax({
                type: 'post',
                url: "{{ route('comment.upvote') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'comment_id': commentId,
                    'voted_user': votedUser,
                },
                success: function(data) {
                    $("#vote_"+commentId).html(data['success']);
                    $("#upvote_"+commentId).remove();
                },
                error(data) {
                    console.log(data);
                }
            });
        }

        function down_vote(commentId, votedUser){
            $.ajax({
                type: 'post',
                url: "{{ route('comment.downvote') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'comment_id': commentId,
                    'voted_user': votedUser,
                },
                success: function(data) {
                    $("#vote_"+commentId).html(data['success']);
                    $("#downvote_"+commentId).remove();
                },
                error(data) {
                    console.log(data);
                }
            });
        }

        $(document).ready(function(){
            $('#submit-comment').on('click', function(event){
                event.preventDefault();
                var commentBody = $('#comment-body').val();
                var questionId = $('#question_id').val();
                var userId = $('#user_id').val();
                $.ajax({
                    type: 'post',
                    url: "{{ route('comment.store') }}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'comment_body': commentBody,
                        'question_id': questionId,
                        'user_id': userId,
                    },
                    success: function(data) {
                        $('.commentlist').append(data['success']);
                        $("#count_comment").html(data['comments']);
                    },
                    error(data) {
                        console.log(data);
                    }
                });
                $('#comment-body').val('');
            });
        });
    </script>
@stop
