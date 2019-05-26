@extends('admin.layouts.master')
@section('page_title')
    Question Detail
@endsection
@section('page_header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection
@section('content')
    <div class="blog-list-wrapper">
        <div class="row">
            @if ($message = Session::get('error'))
                <div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="mdi mdi-block-helper"></i>
                    <strong>Oh snap!</strong> {{ $message }}
                    again.
                </div>
            @endif
            <div class="col-sm-8">
                <div class="p-20">

                    <!-- Image Post -->
                    <div class="blog-post m-b-30">
                        <div class="post-image">

                            @switch( $question->approve_status)
                                @case (0)
                                <span class="label label-warning">Pending</span>
                                @break
                                @case (1)
                                <span class="label label-success">Approved</span>
                                @break;
                                @case (2)
                                <span class="label label-danger">Denied</span>
                                @break;
                            @endswitch
                                <img src="{{ asset('upload/questions/'.$question->filename) }}" alt="" class="img-responsive">
                        </div>
                        <div class="text-muted"><span>by <a class="text-dark font-secondary">{{ $question->user->name }}</a>,</span> <span>{{ $question->created_at->format('M d,Y') }}</span></div>
                        <div class="post-title">
                            <h3><a href="javascript:void(0);">{{ $question->title }}</a></h3>
                        </div>

                        @if ($question->question_poll == 1)
                        @php
                            $sumVotes = $question->poll->sum('votes');
                        @endphp
                            @foreach($question->poll as $poll)
                                @php
                                    if ( $sumVotes > 0){
                                        $votePercent = ($poll->votes)/$sumVotes * 100;
                                    } else {
                                        $votePercent = 0;
                                    }
                                @endphp

                                @switch (true)
                                    @case($votePercent <= 20)
                                        <div class="progress progress-md">
                                            <div class="progress-bar progress-bar-purple" role="progressbar" aria-valuenow="{{$votePercent}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$votePercent}}%;">
                                                {{ $poll->title }}
                                            </div>
                                        </div>
                                    @break
                                    @case(20 < $votePercent && $votePercent <= 40)
                                        <div class="progress progress-md">
                                            <div class="progress-bar progress-bar-inverse" role="progressbar" aria-valuenow="{{$votePercent}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$votePercent}}%;">
                                                {{ $poll->title }}
                                            </div>
                                        </div>
                                    @break
                                    @case(40 < $votePercent && $votePercent <= 60)
                                        <div class="progress progress-md">
                                            <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="{{$votePercent}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$votePercent}}%;">
                                                {{ $poll->title }}
                                            </div>
                                        </div>
                                    @break
                                    @case(60 < $votePercent && $votePercent <= 80)
                                        <div class="progress progress-md">
                                            <div class="progress-bar progress-bar-pink" role="progressbar" aria-valuenow="{{$votePercent}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$votePercent}}%;">
                                                {{ $poll->title }}
                                            </div>
                                        </div>
                                    @break
                                    @case(80 < $votePercent && $votePercent <= 100)
                                        <div class="progress progress-md">
                                            <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="{{$votePercent}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$votePercent}}%;">
                                                {{ $poll->title }}
                                            </div>
                                        </div>
                                    @break
                                @endswitch
                            @endforeach
                        @endif
                        <div>
                            <p>{{ $question->details }}
                            </p>
                        </div>

                    </div>

                    <div class="m-t-50">
                        <h4 class="text-uppercase">About Author</h4>
                        <div class="border m-b-20"></div>

                        <div class="media">
                            <div class="media-left">
                                <a href="#"> <img class="media-object m-r-10" alt="64x64" src="{{ asset('/avatar/users/'.$question->user->avatar) }}" style="width: 96px; height: 96px;"> </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{ $question->user->name }}</h4>
                                <p>
                                    {{ $question->user->description }}
                                </p>

                            </div>
                        </div>
                    </div>

                    <hr/>
                    <div class="m-t-50 blog-post-comment">
                        <h4 class="text-uppercase">Comments <small>({{ count($question->comments )}})</small></h4>

                        <div class="border m-b-20"></div>

                        <ul class="media-list">
                            @foreach ($question->comments as $comment)
                                @include('admin.comment_replies',['comment' => $comment])
                            @endforeach
                        </ul>
                        <h4 class="text-uppercase" style="color: red">Reports ({{ $question->reports }})</h4>
                        <h4 class="text-uppercase m-t-50">Leave message for question owner</h4>
                        <div class="border m-b-20"></div>

                        <form name="ajax-form" action="{{ route('admin.question.verify') }}" method="POST" class="contact-form" data-parsley-validate="" novalidate="">
                            @csrf
                            {{--<!-- /Form-email -->--}}
                            <input name="verify_author" type="hidden" value="{{ Auth::guard('admin')->user()->id }}">
                            <input name="approve_status" type="hidden" value="{{ $question->approve_status }}">
                            <input name="question_id" type="hidden" value="{{ $question->id }}">
                            <div class="form-group">
                                <textarea class="form-control" id="message2" name="note" rows="5" placeholder="Message" required=""></textarea>
                            </div>
                            <!-- /Form Msg -->

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="">
                                        {{--<button type="submit" class="btn btn-custom" id="send">Submit</button>--}}
                                        @switch ( $question->approve_status)
                                            @case (0)
                                                <button name="submitButton" type="submit"  value="approve" class="btn btn-success waves-effect waves-light">Approve</button>
                                                <button name="submitButton" type="submit" value="deny" class="btn btn-danger waves-effect waves-light">Deny</button>
                                            @break;
                                            @case (1)
                                                <button name="submitButton" type="submit" value="deny" class="btn btn-danger waves-effect waves-light">Deny</button>
                                            @break;
                                            @case (2)
                                                <button name="submitButton" type="submit" value="approve" class="btn btn-success waves-effect waves-light">Approve</button>
                                            @break;
                                        @endswitch
                                        <a href="{{ route('admin.question') }}" class="btn btn-default waves-effect waves-light">Back</a>
                                        <a class="btn btn-danger waves-effect waves-light delete-modal" style="float: right;" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="{{$question->id}}" data-url="{!! URL::route('admin.delete.question', ['id' => $question->id]) !!}"><i class="fa fa-trash-o"></i> Delete</a>
                                    </div>

                                </div> <!-- /col -->
                            </div> <!-- /row -->

                        </form>


                    </div><!-- end m-t-50 -->

                </div> <!-- end p-20 -->
            </div> <!-- end col -->

            <div class="col-sm-4">
                <div class="p-20">

                    <div class="">
                        <h4 class="text-uppercase">Search</h4>
                        <div class="border m-b-20"></div>
                        <div class="form-group search-box">
                            <input type="text" id="search-input" class="form-control" placeholder="Search here...">
                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                        </div>
                    </div>

                    <div class="m-t-50">
                        <h4 class="text-uppercase">Categories</h4>
                        <div class="border m-b-20"></div>

                        <ul class="blog-categories-list list-unstyled">
                            @foreach ($categories as $category)
                            <li><a href="#">{{ $category->name_category }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="m-t-50">
                        <h4 class="text-uppercase">Newsletter</h4>
                        <div class="border m-b-20"></div>

                        <form>
                            <div class="input-group m-t-10">
                                <input type="email" id="example-input2-group2" name="example-input2-group2" class="form-control" placeholder="Email">
                                <span class="input-group-btn">
                                                    <button type="button" class="btn waves-effect waves-light btn-primary">Submit</button>
                                                    </span>
                            </div>
                        </form>
                    </div>

                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>

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
                    <input type="hidden" id="id_delete" name="question_id">
                    <input type="hidden" id="url_delete">
                    <div class="modal-body">
                        <h4 class="text-center">Are you sure you want to delete the following question?</h4>
                        <p class="text-center">Bạn có chắc muốn xoá câu hỏi này không?</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="field-7" class="control-label">Reason:</label>
                                    <textarea class="form-control autogrow" id="reason" placeholder="Write down reason to delete for owner" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
                                </div>
                            </div>
                        </div>
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
@section ('page_scripts')
    @parent
    <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script type="text/javascript">
        $(document).on('click', '.delete-modal', function() {
            $('#id_delete').val($(this).data('id'));
            $('#deleteModal').modal('show');
            id = $('#id_delete').val();
        });
        $('.modal-footer').on('click', '.delete', function() {
            reason = $('#reason').val();
            $.ajax({
                type: 'post',
                async: false,
                url: "{{ route('admin.delete.question') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    question_id: id,
                    reason: reason,
                },
                success: function() {
                    window.location.href = "http://localhost:8000/admin/question";
                    toastr.success('Successfully deleted Question!', 'Success Alert', {timeOut: 5000});
                },
                error(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
