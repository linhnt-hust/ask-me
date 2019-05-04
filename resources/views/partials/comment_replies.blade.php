
    <li class="comment">
        <div class="comment-body comment-body-answered clearfix">
            <div class="avatar"><img alt="" src="{{ asset('/avatar/users/'.$comment->user->avatar) }}"></div>
            <div class="comment-text">
                <div class="author clearfix">
                    <div class="comment-author"><a href="#">{{ $comment->user->name }}</a></div>
                    <div class="comment-vote">
                        <ul class="question-vote">
                            <li><a href="#" class="question-vote-up" title="Like"></a></li>
                            <li><a href="#" class="question-vote-down" title="Dislike"></a></li>
                        </ul>
                    </div>
                    <span class="question-vote-result">+1</span>
                    <div class="comment-meta">
                        <div class="date"><i class="icon-time"></i>{{ $comment->created_at->format('M d, Y - h:m') }}</div>
                    </div>
                    <a class="comment-reply" id="reply-button_{{$comment->id}}" ><i class="icon-reply"></i>Reply</a>
                </div>
                <div class="text"><p> {{ $comment->body }} </p>
                </div>
                {{--<div class="question-answered question-answered-done"><i class="icon-ok"></i>Best Answer</div>--}}
            </div>
            <br>
            <div id="respond" class="children respond-form-{{ $comment->id }}" style="display: none">
                <form action="{{ route('reply.add') }}" method="POST" id="commentform" class="comment-form">
                    {{ csrf_field() }}
                    <div id="respond-textarea">
                        <p>
                            <input type="hidden" name="question_id" value="{{ $question_id }}" />
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                            <textarea id="comment" name="comment_body" placeholder="Write a response..." style="overflow-x: hidden; overflow-wrap: break-word; height: 120px;" rows="1"></textarea>
                        </p>
                    </div>
                    <p class="form-submit">
                        <input type="submit" id="submit" value="Post your reply" class="button small color">
                    </p>
                </form>
            </div>
        </div>
        <ul class="children">
            <li class="comment">
                @foreach($comment->replies as $comment)
                    @include('partials.comment_replies', ['comment' => $comment])
                @endforeach
            </li>
        </ul><!-- End children -->
    </li>

