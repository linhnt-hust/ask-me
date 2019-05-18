    <li class="comment" id="comment_{{$comment->id}}">
        <div class="comment-body comment-body-answered clearfix">
            <div class="avatar"><img alt="" src="{{ asset('/avatar/users/'.$comment->user->avatar) }}"></div>
            <div class="comment-text">
                <div class="author clearfix">
                    <div class="comment-author"><a href="#">{{ $comment->user->name }}</a></div>
                    @if ($comment->parent_id==0)
                        <div class="comment-vote">
                                <ul class="question-vote">
                                    @if ($comment->commentVoteHistory->first() == null)
                                        <li id="upvote_{{ $comment->id }}"><a id="a_{{ $comment->id }}" class="question-vote-up" title="Like" onclick="up_vote( {{$comment->id}}, {{ Auth::user()->id }})"></a></li>
                                        <li id="downvote_{{ $comment->id }}"><a class="question-vote-down" title="Dislike" onclick="down_vote( {{$comment->id}}, {{ Auth::user()->id }})"></a></li>
                                    @else
                                        @foreach($comment->commentVoteHistory as $history)
                                            @if ($history->user_id == Auth::user()->id && $history->up == 1 && $history->down == 0)
                                                <li id="upvote_{{ $comment->id }}"><a class="question-vote-up" style="color: white !important; pointer-events: none; cursor: default;" title="Like" onclick="up_vote( {{$comment->id}}, {{ Auth::user()->id }})"></a></li>
                                                <li id="downvote_{{ $comment->id }}"><a class="question-vote-down" title="Dislike" onclick="down_vote( {{$comment->id}}, {{ Auth::user()->id }})"></a></li>
                                            @elseif ($history->user_id == Auth::user()->id && $history->down == 1 && $history->up == 0)
                                                <li id="upvote_{{ $comment->id }}"><a class="question-vote-up" title="Like" onclick="up_vote( {{$comment->id}}, {{ Auth::user()->id }})"></a></li>
                                            @elseif ($history->user_id == Auth::user()->id && $history->down == 1 && $history->up == 1)
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                        </div>
                        <span class="question-vote-result" id="vote_{{$comment->id }}">{{ $comment->votes }}</span>
                    @endif
                    <div class="comment-meta">
                        <div class="date"><i class="icon-time"></i>{{ $comment->created_at->format('M d, Y - h:m') }}</div>
                    </div>
                    @if ($comment->user->id==\Auth::user()->id)
                        <a class="comment-reply remove-button" id="remove_{{$comment->id}}" style="margin-left: 10px;" onclick="delete_comment({{$comment->id}}, {{$question_id}})"><i class="icon-remove"></i>Remove</a>
                    @endif
                    <a class="comment-reply reply-button" id="reply-button_{{$comment->id}}" onclick="reply_box({{$comment->id}})"><i class="icon-reply"></i>Reply</a>
                </div>
                @if ($comment->user_id == \Auth::user()->id)
                    <div class="text"><p id="text_{{$comment->id}}" onclick="text_edit({{$comment->id}})"> {{ $comment->body }} </p>
                @else
                    <div class="text"><p> {{ $comment->body }} </p>
                @endif
                </div>
                {{--@if ($loop->first)--}}
                    {{--<div class="question-answered question-answered-done"><i class="icon-ok"></i>Best Answer</div>--}}
                {{--@endif--}}
            </div>
            <br>
            @if ($isSolved == 0)
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
            @endif
        </div>
        <ul class="children">
            <li class="comment">
                @foreach($comment->replies as $comment)
                    @include('partials.comment_replies', ['comment' => $comment])
                @endforeach
            </li>
        </ul><!-- End children -->
    </li>

