<li class="media">
    <a class="pull-left" href="#">
        <img class="media-object img-circle"
             src="{{ asset('/avatar/users/'.$comment->user->avatar) }}" alt="img">
    </a>
    <div class="media-body">
        <h5 class="media-heading">{{ $comment->user->name }}</h5>
        <h6 class="text-muted">{{ $comment->created_at->format('M d, Y - h:m') }}</h6>
        <p> {{ $comment->body }} </p>
        <div class="media sub_media">
            <ul class="media-list">
            @foreach($comment->replies as $comment)
                @include('admin.comment_replies', ['comment' => $comment])
            @endforeach
            </ul>
        </div>
    </div>
</li>
