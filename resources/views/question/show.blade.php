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
                    <a class="question-report" href="#">Report</a>

                    @if ( $questionDetail->question_poll == 0)
                        <div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
                    @else
                        <div class="question-type-main"><i class="icon-signal"></i>Poll</div>
                    @endif

                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <div class="question-desc">
                            <p> {{ $questionDetail->details }}</p>
                        </div>
                        <div class="question-details">
                            <span class="question-answered question-answered-done"><i class="icon-ok"></i>solved</span>
                            <span class="question-favorite"><i class="icon-star"></i>5</span>
                        </div>
                        <span class="question-category"><a href="#"><i class="icon-folder-close"></i>{{ optional($questionDetail->category)->name_category }}</a></span>
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
                        <a href="#">wordpress</a>, <a href="#">question</a>, <a href="#">developer</a>
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
                        <a href="#" original-title="admin" class="tooltip-n"><img alt="" src="http://placehold.it/60x60/FFF/444"></a>
                    </div>
                    <div class="author-bio">
                        <h4>About the Author: {{ $questionDetail->user->name }}</h4>
                        {{ $questionDetail->user->description }}
                    </div>
                </div><!-- End about-author -->

                <div id="related-posts">
                    <h2>Related questions</h2>
                    <ul class="related-posts">
                        <li class="related-item"><h3><a href="#"><i class="icon-double-angle-right"></i>This Is My Second Poll Question</a></h3></li>
                        <li class="related-item"><h3><a href="#"><i class="icon-double-angle-right"></i>This is my third Question</a></h3></li>
                        <li class="related-item"><h3><a href="#"><i class="icon-double-angle-right"></i>This is my fourth Question</a></h3></li>
                        <li class="related-item"><h3><a href="#"><i class="icon-double-angle-right"></i>This is my fifth Question</a></h3></li>
                    </ul>
                </div><!-- End related-posts -->

                <div id="commentlist" class="page-content">
                    <div class="boxedtitle page-title"><h2>Answers ( <span class="color">{{ count($questionDetail->comments )}}</span> )</h2></div>
                    <ol class="commentlist clearfix">

                    @foreach($questionDetail->comments as $comment)
                        @include('partials.comment_replies', ['comment' => $comment, 'question_id' => $questionDetail->id])
                    @endforeach

                    </ol><!-- End commentlist -->
                </div><!-- End page-content -->

                <div id="respond" class="comment-respond page-content clearfix">
                    <div class="boxedtitle page-title"><h2>Leave a reply</h2></div>
                    <form id="commentform" class="comment-form">
                        <div id="respond-textarea">
                            <p>
                                <input type="hidden" id="question_id" name="question_id" value="{{ $questionDetail->id }}" />
                                <label class="required" for="comment">Comment<span>*</span></label>
                                <textarea id="comment-body" name="comment_body" aria-required="true" cols="58" rows="8"></textarea>
                            </p>
                        </div>
                        <p class="form-submit">
                            <div id="submit-comment" class="button small color">Post your answer</div>
                        </p>
                    </form>
                </div>

                <div class="alert alert-success" style="display:none"></div>

                <div class="post-next-prev clearfix">
                    <p class="prev-post">
                        <a href="#"><i class="icon-double-angle-left"></i>&nbsp;Prev question</a>
                    </p>
                    <p class="next-post">
                        <a href="#">Next question&nbsp;<i class="icon-double-angle-right"></i></a>
                    </p>
                </div><!-- End post-next-prev -->
            </div><!-- End main -->

            @include('layouts.asside_bar')

        </div><!-- End row -->
    </section><!-- End container -->

@endsection
@section('inline_scripts')
@parent
<script type="text/javascript">
    $(".comment-reply").click(function() {
                id=this.id.split("_")[1];
                $(".respond-form-"+id).toggle();
            });
    
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
            },
            error(data) {
                console.log(data);
            }
        });
        $('#comment-body').val('');
    });
</script>
@endsection
