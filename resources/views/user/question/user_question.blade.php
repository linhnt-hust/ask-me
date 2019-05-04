@extends('layouts.master')
@section('page_header')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
@endsection
@section('title')
    User Questions
@endsection
@section('content')
    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>User Questions : {{ $user->name }}</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="#">Home</a>
                        <span class="crumbs-span">/</span>
                        <a href="#">User</a>
                        <span class="crumbs-span">/</span>
                        <span class="current">User Questions : {{ $user->name }}</span>
                    </div>
                </div>
            </div><!-- End row -->
        </section><!-- End container -->
    </div><!-- End breadcrumbs -->

    <section class="container main-content">
        <div class="row">
            <div class="col-md-9">

                @if ($message = Session::get('success'))
                    <div class="alert-message success">
                        <i class="icon-ok"></i>
                        <p><span>success message</span><br>
                            {{$message}}</p>
                    </div>
                @endif

                <div class="row">
                    <div class="user-profile">
                        <div class="col-md-12">
                            <div class="page-content">
                                <h2>About {{ $user->name }}</h2>
                                <div class="user-profile-img"><img width="60" height="60" src="{{ asset('/avatar/users/'.$user->avatar) }}" alt="admin"></div>
                                <div class="ul_list ul_list-icon-ok about-user">
                                    <ul>
                                        <li><i class="icon-plus"></i>Registerd : <span>{{ $user->created_at->format('M d,Y') }}</span></li>
                                        <li><i class="icon-map-marker"></i>Country : <span>{{ $user->country }}</span></li>
                                        <li><i class="icon-globe"></i>Website : <a target="_blank" href="">{{ $user->website }}</a></li>
                                    </ul>
                                </div>
                                <p> {{ $user->description }}</p>
                                <div class="clearfix"></div>
                                <span class="user-follow-me">Follow Me</span>
                                <a href="#" original-title="Facebook" class="tooltip-n">
									<span class="icon_i">
										<span class="icon_square" icon_size="30" span_bg="#3b5997" span_hover="#2f3239">
											<i class="social_icon-facebook"></i>
										</span>
									</span>
                                </a>
                                <a href="#" original-title="Twitter" class="tooltip-n">
									<span class="icon_i">
										<span class="icon_square" icon_size="30" span_bg="#00baf0" span_hover="#2f3239">
											<i class="social_icon-twitter"></i>
										</span>
									</span>
                                </a>
                                <a href="#" original-title="Linkedin" class="tooltip-n">
									<span class="icon_i">
										<span class="icon_square" icon_size="30" span_bg="#006599" span_hover="#2f3239">
											<i class="social_icon-linkedin"></i>
										</span>
									</span>
                                </a>
                                <a href="#" original-title="Google plus" class="tooltip-n">
									<span class="icon_i">
										<span class="icon_square" icon_size="30" span_bg="#c43c2c" span_hover="#2f3239">
											<i class="social_icon-gplus"></i>
										</span>
									</span>
                                </a>
                                <a href="#" original-title="Email" class="tooltip-n">
									<span class="icon_i">
										<span class="icon_square" icon_size="30" span_bg="#000" span_hover="#2f3239">
											<i class="social_icon-email"></i>
										</span>
									</span>
                                </a>
                            </div><!-- End page-content -->
                        </div><!-- End col-md-12 -->
                        <div class="col-md-12">
                            <div class="page-content page-content-user-profile">
                                <div class="user-profile-widget">
                                    <h2>User Stats</h2>
                                    <div class="ul_list ul_list-icon-ok">
                                        <ul>
                                            <li><i class="icon-question-sign"></i>Questions<span> ( <span>{{ count($userQuestions) }}</span> ) </span></a></li>
                                            <li><i class="icon-comment"></i><a href="user_answers.html">Answers<span> ( <span>10</span> ) </span></a></li>
                                            <li><i class="icon-star"></i><a href="user_favorite_questions.html">Favorite Questions<span> ( <span>3</span> ) </span></a></li>
                                            <li><i class="icon-heart"></i><a href="user_points.html">Points<span> ( <span>20</span> ) </span></a></li>
                                            <li><i class="icon-asterisk"></i>Best Answers<span> ( <span>2</span> ) </span></li>
                                        </ul>
                                    </div>
                                </div><!-- End user-profile-widget -->
                            </div><!-- End page-content -->
                        </div><!-- End col-md-12 -->
                    </div><!-- End user-profile -->
                </div><!-- End row -->
                <div class="clearfix"></div>
                <div class="page-content page-content-user">
                    <div class="user-questions">
                        @foreach($userQuestions as $userQuestion)
                        <article class="question user-question" id="itemQuestion{{$userQuestion->id}}">
                            <h3>
                                <a href="{{ route('question.show', $userQuestion->id) }}">{{ $userQuestion-> title }}</a>
                            </h3>

                            @switch( $userQuestion->approve_status )
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

                            <div class="question-content">
                                <div class="question-bottom">
                                    <div class="question-answered"><i class="icon-ok"></i>in progress</div>
                                    <span class="question-favorite"><i class="icon-star"></i>5</span>
                                    <span class="question-category"><a href="#"><i class="icon-folder-close"></i>{{ optional($userQuestion->category)->name_category }}</a></span>
                                    <span class="question-date"><i class="icon-time"></i>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $userQuestion->updated_at)->diffForHumans() }}</span>
                                    <span class="question-comment"><a href="#"><i class="icon-comment"></i>5 Answers</a></span>
                                    <a class="question-reply" href="#"><i class="icon-reply"></i>Reply</a>
                                    <span class="question-view"><i class="icon-user"></i>70 views</span>
                                    <a class="button small">Edit</a>
                                    <a class="button small">Edit</a>
                                    <a class="button small">Edit</a>
                                    @if ( $userQuestion->approve_status != 1)
                                        <a class="edit-modal btn btn-info" href="{{ route('question.edit', $userQuestion->id)}}">
                                            <span class="glyphicon glyphicon-edit"></span> Edit</a>
                                        <button class="delete-modal btn btn-danger" data-id="{{ $userQuestion->id }}" data-title="" data-content="">
                                            <span class="glyphicon glyphicon-trash"></span> Delete</button>
                                    @endif
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>

                <div class="height_20"></div>

                {{--<div class="pagination">--}}
                    {{--<a href="#" class="prev-button"><i class="icon-angle-left"></i></a>--}}
                    {{--<span class="current">1</span>--}}
                    {{--<a href="#">2</a>--}}
                    {{--<a href="#">3</a>--}}
                    {{--<a href="#">4</a>--}}
                    {{--<a href="#">5</a>--}}
                    {{--<span>...</span>--}}
                    {{--<a href="#">11</a>--}}
                    {{--<a href="#">12</a>--}}
                    {{--<a href="#">13</a>--}}
                    {{--<a href="#" class="next-button"><i class="icon-angle-right"></i></a>--}}
                {{--</div><!-- End pagination -->--}}
                {!! $userQuestions->render() !!}
                <!-- if no questions
                <p>No questions yet</p>
                -->
            </div><!-- End main -->

            @include('layouts.asside_bar')

        </div><!-- End row -->
    </section><!-- End container -->

    <!-- Modal form to delete a form -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Are you sure you want to delete this question?</h3>
                    <br />
                    <input type="hidden" id="id_delete">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-trash'></span> Delete
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('inline_scripts')
    @parent
    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

    <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script type="text/javascript">
        $(document).on('click', '.delete-modal', function() {
            $('.modal-title').text('Delete');
            $('#id_delete').val($(this).data('id'));
            $('#deleteModal').modal('show');
            id = $('#id_delete').val();
            console.log(id);
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: '/question/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Successfully deleted Question!', 'Success Alert', {timeOut: 5000});
                    $('#itemQuestion' + data['id']).remove();
                },
                error(data) {
                    console.log(data);
                }
            });
        });
    </script>
@stop
