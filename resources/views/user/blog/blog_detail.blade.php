@extends('layouts.master')
@section('title')
    Blog detail
@endsection
@section('page_header')
    <link href="{{ asset('/zircos/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
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
                    <h1>{{ $blogDetail->title }}</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="#">Home</a>
                        <span class="crumbs-span">/</span>
                        <a href="#">Blog</a>
                        <span class="crumbs-span">/</span>
                        <span class="current">{{$blogDetail->title }}</span>
                    </div>
                </div>
            </div><!-- End row -->
        </section><!-- End container -->
    </div><!-- End breadcrumbs -->
    <section class="container main-content">
        <div class="row">
            <div class="col-md-9">
                <article class="post single-post clearfix">
                    <div class="post-inner">
                        @if ($blogDetail->type == 1)
                        @elseif ($blogDetail->type == 2)
                            <div class="flexslider flex-slider">
                                <ul class="slides">
                                    @foreach($blogDetail->blogUploaded as $img)
                                        <li>
                                            <img src="{{asset('/upload/blogs/'.$img->filename)}}" alt="">
                                        </li>
                                    @endforeach
                                </ul>
                            </div><!-- End flexslider -->
                        @elseif ( $blogDetail->type == 3)
                            <div class="video_embed post-img">{!! $blogDetail->getVideoHtmlAttribute($blogDetail->url, 500, 500) !!}</div>
                        @endif
                        <h2 class="post-title"><span class="post-type"><i class="icon-film"></i></span>{{ $blogDetail->title }}</h2>
                            @switch( $blogDetail->approve_status )
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
                        <div class="post-meta">
                            <span class="meta-author"><i class="icon-user"></i><a href="#">{{ $blogDetail->user->name }}</a></span>
                            <span class="meta-date"><i class="icon-time"></i>{{ $blogDetail->created_at->format('M d, Y') }}</span>
                            @foreach($blogDetail->category as $category)
                                <span class="meta-categories"><i class="icon-suitcase"></i><a>{{$category->name_category}}</a></span>
                            @endforeach
                            <span class="meta-comment"><i class="icon-comments-alt"></i><a href="#">{{count($blogDetail->comments)}}</a></span>
                        </div>
                        <div class="post-content">
                            <p>{!! $blogDetail->description !!}</p>
                        </div><!-- End post-content -->
                        <div class="clearfix"></div>
                    </div><!-- End post-inner -->
                </article><!-- End article.post -->

                <div class="share-tags page-content">
                    <div class="share-inside-warp">
                        <ul>
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" original-title="Facebook">
									<span class="icon_i">
										<span class="icon_square" icon_size="20" span_bg="#3b5997" span_hover="#666">
											<i i_color="#FFF" class="social_icon-facebook"></i>
										</span>
									</span>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank">Facebook</a>
                            </li>
                            <li>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}" target="_blank">
									<span class="icon_i">
										<span class="icon_square" icon_size="20" span_bg="#00baf0" span_hover="#666">
											<i i_color="#FFF" class="social_icon-twitter"></i>
										</span>
									</span>
                                </a>
                                <a target="_blank" href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}">Twitter</a>
                            </li>
                            <li>
                                <a href="https://plus.google.com/share?url={{ urlencode(request()->url()) }}" target="_blank">
									<span class="icon_i">
										<span class="icon_square" icon_size="20" span_bg="#ca2c24" span_hover="#666">
											<i i_color="#FFF" class="social_icon-gplus"></i>
										</span>
									</span>
                                </a>
                                <a href="https://plus.google.com/share?url={{ urlencode(request()->url()) }}" target="_blank">Google plus</a>
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
                        </ul>
                        <span class="share-inside-f-arrow"></span>
                        <span class="share-inside-l-arrow"></span>
                    </div><!-- End share-inside-warp -->
                    <div class="share-inside"><i class="icon-share-alt"></i>Share</div>
                    <div class="clearfix"></div>
                </div><!-- End share-tags -->

                <div class="about-author clearfix">
                    <div class="author-image">
                        <a href="#" original-title="admin" class="tooltip-n"><img alt="" src="{{ asset('/avatar/users/'.$blogDetail->user->avatar) }}"></a>
                    </div>
                    <div class="author-bio">
                        <h4>About the Author: {{$blogDetail->user->name}}</h4>
                        {{$blogDetail->user->description}}
                    </div>
                </div><!-- End about-author -->

                <div id="related-posts">
                    <h2>Related Posts</h2>
                    <ul class="related-posts">
                        @foreach($blogDetail->category->first()->blog as $key=>$relateBlog)
                            @if ($key <= 3)
                                <li class="related-item"><h3><a href="{{route('blog.show', $relateBlog->id) }}"><i class="icon-double-angle-right"></i>{{ substr($relateBlog->title,0,30) }}...</a></h3></li>
                            @endif
                        @endforeach
                    </ul>
                </div><!-- End related-posts -->

                <div id="commentlist" class="page-content">
                    <div class="boxedtitle page-title"><h2>Comments ( <span class="color" id="count_comment">{{ count($blogDetail->comments )}}</span> )</h2></div>
                    <ol class="commentlist clearfix">
                        @foreach($blogDetail->comments()->orderBy('votes', 'DESC')->get() as $comment)
                            @include('partials.comment_replies', ['comment' => $comment, 'question_id' => $blogDetail->id, 'isSolved' => 0])
                        @endforeach
                    </ol><!-- End commentlist -->
                </div><!-- End page-content -->

                <div id="respond" class="comment-respond page-content clearfix">
                    <div class="boxedtitle page-title"><h2>Leave a reply</h2></div>
                    <form  id="commentform" class="comment-form" method="POST" action="{{route('comment.store')}}">
                        {{ csrf_field() }}
                        <div id="respond-textarea">
                            <p>
                                <input type="hidden" name="question_id" id="blog_id" value="{{ $blogDetail->id }}" />

                                <input type="hidden" name="user_id" id="user_id" value="{{ $blogDetail->user->id }}" />
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
                @if ($blogDetail->approve_status != 0)
                    <div id="respond" class="comment-respond page-content clearfix">
                        <div class="author-bio">
                            <h4>Your question has been {{ \App\Models\Question::$approveStatus[$blogDetail->approve_status] }} by Admin</h4>
                            @if ($blogDetail->note)
                                With Note:
                                {{ $blogDetail->note }}
                            @endif
                        </div>
                    </div>
                @endif
                @if ($blogDetail->approve_status != 1)
                    <br>
                    <div>
                        <a class="btn btn-danger delete-modal" style="background-color: red; float: right" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="{{$blogDetail->id}}">
                            <span id="delete_modal" class='glyphicon glyphicon-trash'></span>Delete</a>
                        <a href="{{route('blog.edit', $blogDetail->id)}}" class="btn btn-success" style="background-color: #5bc0de; float: right">
                            <span id="delete_modal" class='glyphicon glyphicon-edit'></span>Edit</a>
                    </div>
                @endif
            </div><!-- End main -->

            @include('layouts.asside_bar')


        </div><!-- End row -->
    </section><!-- End container -->
    <div class="modal fade bs-example-modal-lg" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myLargeModalLabel">Delete modal</h4>
                </div>
                <form class="form-confirm" method="post">
                    <input type="hidden" name="_method" value="delete" />
                    {{ csrf_field() }}
                    <input type="hidden" id="id_delete" name="blog_id">
                    <input type="hidden" id="url_delete">
                    <div class="modal-body">
                        <h4 class="text-center">Are you sure you want to delete the following blogs?</h4>
                        <p class="text-center">Bạn có chắc muốn xoá bài đăng này không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger delete" data-dismiss="modal">
                            <span id="delete_modal" class='glyphicon glyphicon-trash'></span> Delete
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('inline_scripts')
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>
    @parent
    <script type="text/javascript">
        var popupSize = {
            width: 780,
            height: 550
        };

        $(document).on('click', '.share-inside-warp > ul > li > a', function(e){
            var
                verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
                horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

            var popup = window.open($(this).prop('href'), 'social',
                'width='+popupSize.width+',height='+popupSize.height+
                ',left='+verticalPos+',top='+horisontalPos+
                ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

            if (popup) {
                popup.focus();
                e.preventDefault();
            }

        });
        
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

        $(document).ready(function(){
            $('#submit-comment').on('click', function(event){
                event.preventDefault();
                var commentBody = $('#comment-body').val();
                var blogId = $('#blog_id').val();
                var userId = $('#user_id').val();
                $.ajax({
                    type: 'post',
                    url: "{{ route('comment.storeBlog') }}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'comment_body': commentBody,
                        'blog_id': blogId,
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

        $(document).on('click', '.delete-modal', function() {
            $('#id_delete').val($(this).data('id'));
            $('#deleteModal').modal('show');
            id = $('#id_delete').val();
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: '/blog/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function() {
                    window.location.href = "http://localhost:8000/user/blog";
                    toastr.success('Successfully delete Blog!', 'Success Alert', {timeOut: 5000});
                },
                error(data) {
                    console.log(data);
                }
            });
        });
    </script>
@stop

