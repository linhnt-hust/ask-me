@extends('layouts.master')
@section('title')
    Question Details
@endsection
@section('page_header')
    <link href="{{ asset('/zircos/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        a {
            text-decoration: none !important;
        }
    </style>
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
                    @if ($questionDetail->report->first() != null)
                        @if ($questionDetail->report->first()->user_id !== Auth::user()->id)
                            <a class="question-report" href="#">Report</a>
                        @endif
                    @elseif ($questionDetail->user_id != Auth::user()->id)
                        <a class="question-report" href="#">Report</a>
                    @endif
                    <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <div class="question-desc">
                            <p> {{ $questionDetail->details }}</p>
                            @if ($questionDetail->filename != null )
                            <div class="post-img"><a><img src="{{ asset('/upload/questions/'.$questionDetail->filename) }}" alt=""></a></div>
                            @endif
                        </div>
                        <div class="question-details">
                            @if ($questionDetail->is_solved == 0)
                                <div class="question-answered"><i class="icon-ok"></i>in progress</div>
                            @else
                                <div class="question-answered question-answered-done"><i class="icon-ok"></i>solved</div>
                            @endif
                            {{--<span class="question-favorite"><i class="icon-star"></i>5</span>--}}
                        </div>
                        <span class="question-category"><a href="{{route('question.category.detail',optional($questionDetail->category)->id )}}"><i class="icon-folder-close"></i>{{ optional($questionDetail->category)->name_category }}</a></span>
                        <span class="question-date"><i class="icon-time"></i>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $questionDetail->updated_at)->diffForHumans() }}</span>
                        <span class="question-comment"><a href="#"><i class="icon-comment"></i>5 Answer</a></span>
                        {{--<span class="question-view"><i class="icon-user"></i>{{ visits($questionDetail)->count() }} views</span>--}}
                        @if ($questionDetail->user->id != Auth::user()->id)
                            <div  id = "question_follow_parent">
                                @if ($questionDetail->follow()->exists() == false)
                                    <a class="follow-button" data-question-id="{{$questionDetail->id}}" data-email="{{ Auth::user()->email }}" data-follow-user="{{ Auth::user()->id }}" style="float: right; border: 2px solid dodgerblue ;border-radius: 5px;
                                      background-color: white;
                                      color: black;
                                      padding: 5px 15px;
                                      font-size: 11px;
                                      color: dodgerblue;
                                      cursor: pointer;"><i class="icon-ok"></i> Follow</a>
                                    <div class="clearfix"></div>
                                @else
                                    <a class="unfollow-button" onclick="unfollow_question( {{$questionDetail->id}}, {{ Auth::user()->id }})" style="float: right; border: 2px solid dodgerblue ;border-radius: 5px;
                                      background-color: white;
                                      color: black;
                                      padding: 5px 15px;
                                      font-size: 11px;
                                      color: dodgerblue;
                                      cursor: pointer;">Unfollow</a>
                                    <div class="clearfix"></div>
                                @endif
                            </div>
                        @endif
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
                        @include('partials.comment_replies', ['comment' => $comment, 'question_id' => $questionDetail->id, 'isSolved' => $questionDetail->is_solved])
                    @endforeach

                    </ol><!-- End commentlist -->
                </div><!-- End page-content -->

                @if ($questionDetail->is_solved == 0)
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
                             <div id="submit-comment" class="button small color">Post your answer</div>

                        </p>
                    </form>
                </div>
                @endif
                <br>
                <div class="page-content" id="report_form" style="display: none;">
                    <div class="boxedtitle page-title"><h2>Report Form</h2></div>
                    <form class="form-style form-style-3 form-style-5" action="{{ route('question.report') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="question_id" id="question_id" value="{{ $questionDetail->id }}">
                        <div class="form-inputs clearfix" id="question-submit">
                            <p class="question_poll_p">
                                <label class="required">Reasons<span>*</span></label>
                                <input type="checkbox" id="report_type" value="1" name="report[]">
                                <span class="question_poll">Spam</span>
                                <span class="poll-description">Đây là 1 nội dung spam .</span>
                            </p>
                            <p class="question_poll_p">
                                <label for="question_poll" ></label>
                                <input type="checkbox" value="2" id="report_type" name="report[]">
                                <span class="question_poll">Content inappropriate</span>
                                <span class="poll-description">Có nội dung không phù hợp .</span>
                            </p>
                            <p class="question_poll_p">
                                <label for="question_poll"></label>
                                <input type="checkbox" value="3" id="report_type" name="report[]">
                                <span class="question_poll">Contains sensitive or violent images</span>
                                <span class="poll-description">Có hứa hình ảnh nhạy cảm hoặc bạo lực .</span>
                            </p>

                        </div>
                        <div class="form-textarea">
                            <p>
                                <label class="required">Message</label>
                                <textarea aria-required="true" cols="58" rows="5" id="message" name="message"></textarea>
                            </p>
                        </div>
                        <p class="form-submit">
                            <input type="submit" value="Submit" id="submit_report" class="submit button medium color">
                            {{--<a class= "button small color">--}}
                        </p>
                    </form>
                </div>
            </div><!-- End main -->

            @include('layouts.asside_bar')

        </div><!-- End row -->
    </section><!-- End container -->

    <div class="modal fade bs-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myLargeModalLabel">Confirm modal</h4>
                </div>
                <form class="form-confirm" method="post">
                    <input type="hidden" id="question_id" />
                    <input type="hidden" id="follow_user_id">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_delete" name="question_id">
                    <div class="modal-body">
                        <h4 class="text-center">Is this your email address?</h4>
                        <p class="text-center">Đây có phải địa chỉ email của bạn ko?</p>
                        <div>
                            <input type="text" class="text-center" style="margin:0 auto;" id="user_email" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success follow" data-dismiss="modal">
                            <span id="delete_modal" class='glyphicon glyphicon-check'></span> Yes
                        </button>
                        <a class="btn btn-warning" href="{{route('profile.edit', Auth::user()->id)}}">
                            <span class='glyphicon glyphicon-remove'></span> No
                        </a>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
@section('inline_scripts')
    @parent
    <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>
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
                    // $("#upvote_"+commentId).remove();
                    $("#a_"+commentId).attr('style', 'color: white !important');
                    $("#a_"+commentId).css("pointer-events", "none");
                    $("#a_"+commentId).css("cursor", "default");
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

        function unfollow_question(questionId, unfollowedUser){
            $.ajax({
                type: 'post',
                url: "{{ route('question.unfollow') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'question_id': questionId,
                    'user_id': unfollowedUser,
                },
                success: function(data) {
                    toastr.success('successfully unfollow question!', 'Success Alert', {timeOut: 5000});
                    $(".unfollow-button").remove();
                    $("#question_follow_parent").html(data);
                },
                error(data) {
                    console.log(data);
                }
            });
        }

        $(document).ready(function(){
            // $("#report_form").hide();
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

            $(".question-report").click(function() {
                $("#report_form").show();
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#report_form").offset().top
                }, 2000);
            });

            $('#submit_report').on('click', function(event){
                event.preventDefault();
                var message = $('#message').val();
                var question_id = $('#question_id').val();
                var user_id = $('#user_id').val();
                // var report  = $('#report_type:checked').val();
                var report = [];
                $('#report_type:checked').each(function(i){
                    report[i] = $(this).val();
                });
                $.ajax({
                    type: 'post',
                    url: "{{ route('question.report') }}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'report': report,
                        'question_id': question_id,
                        'user_id': user_id,
                        'message': message,
                    },
                    success: function(data) {
                        $("#report_form").remove();
                        $(".question-report").remove();
                        $(window).scrollTop(0);
                        toastr.success('Thanks you for your report!', 'Success Alert', {timeOut: 5000});
                    },
                    error(data) {
                        console.log(data);
                    }
                });
            });

            $(document).on('click', '.follow-button', function() {
                $("#user_email").val($(this).data('email'));
                $('#follow_user_id').val($(this).data('follow-user'));
                $('#question_id').val($(this).data('question-id'));
                var questionId = $('#question_id').val();
                var followedUser = $("#follow_user_id").val();
                $('#editModal').modal('show');
                $('.modal-footer').on('click', '.follow', function() {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('question.follow') }}",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'question_id': questionId,
                            'user_id': followedUser,
                        },
                        success: function(data) {
                            toastr.success('you are now following this question! You will get an email everytime this question got new update', 'Success Alert', {timeOut: 5000});
                            $(".follow-button").remove();
                            $("#question_follow_parent").html(data);
                        },
                        error(data) {
                            console.log(data);
                        }
                    });
                });
            });
        });
    </script>
@stop
