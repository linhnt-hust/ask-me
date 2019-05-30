@extends('admin.layouts.master')
@section('page_header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group pull-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li>
                            <a href="{{ route('admin.index') }}">Ask-me</a>
                        </li>
                        <li class="active">
                            Users
                        </li>
                    </ol>
                </div>
                <h4 class="page-title"> User Statistical</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-8">
                        <form>
                            <div class="form-group search-box">
                                <input type="text" id="search_input" class="form-control product-search" placeholder="Search here...">
                                <button type="submit" class="btn btn-search search-user"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mails m-0 table table-actions-bar">
                        <thead>
                        <tr>
                            <th style="width: 70px;">
                                <div class="btn-group dropdown m-l-10">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" id="newest">Newest</a></li>
                                        <li><a href="#" id="oldest">Oldest</a></li>
                                        <li><a href="#" id="most-question">Most Questions User</a></li>
                                        <li><a href="#" id="most-blog">Most Blogs User</a></li>
                                        <li><a href="#" id="most-comment">Most Comments User</a></li>
                                        {{--<li class="divider"></li>--}}
                                        {{--<li><a href="#">Separated link</a></li>--}}
                                    </ul>
                                </div>
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Questions</th>
                            <th>Blogs</th>
                            <th>Comments</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="item-user">
                        @foreach($newUsers as $user)
                        <tr id="deleteItem_{{$user->id}}">
                            <td>
                                <img src="{{ asset('/avatar/users/'.$user->avatar) }}" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                            </td>

                            <td>
                                {{ $user->name }}
                            </td>

                            <td>
                                <a href="#">{{$user->email}}</a>
                            </td>

                            <td>
                                {{ $user->userQuestions->count() }}
                            </td>
                            <td>
                                {{ $user->userBlogs->count() }}
                            </td>
                            <td>
                                {{ $user->userComments->count() }}
                            </td>
                            <td>
                                {{ $user->created_at }}
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = "{{$user->id}}"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end table responsive -->
            </div> <!-- end card-box -->

            <div class="text-right">
                {{ $newUsers->render('admin.elements.pagination') }}
            </div>

        </div> <!-- end col -->
    </div>
    <!-- end row -->

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
                    <div class="modal-body">
                        <h4 class="text-center">Are you sure you want to delete the following user?</h4>
                        <p class="text-center">Bạn có chắc muốn xoá người dùng này không?</p>
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
            $.ajax({
                type: 'post',
                url: "{{ route('admin.delete.user') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    user_id: id,
                },
                success: function(data) {
                    toastr.success('Successfully deleted user!', 'Success Alert', {timeOut: 5000});
                    $('#deleteItem_' + data['id']).remove();
                },
                error(data) {
                    console.log(data);
                }
            });
        });

        $('.search-user').on('click', function(event){
            event.preventDefault();
            var search = $('#search_input').val();
            $.ajax({
                type: 'post',
                url: "{{ route('admin.user.search') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'search': search,
                },
                success: function(data) {
                    $('.item-user').html(data);
                },
                error(data) {
                    console.log(data);
                }
            });
        });

        $('#oldest').on('click', function(event){
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: "{{ route('sort.user.oldest') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    $('.item-user').html(data);
                },
                error(data) {
                    console.log(data);
                }
            });
        });

        $('#newest').on('click', function(event){
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: "{{ route('sort.user.newest') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    $('.item-user').html(data);
                },
                error(data) {
                    console.log(data);
                }
            });
        });

        $('#most-question').on('click', function(event){
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: "{{ route('sort.user.mostQuestion') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    $('.item-user').html(data);
                },
                error(data) {
                    console.log(data);
                }
            });
        });

        $('#most-blog').on('click', function(event){
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: "{{ route('sort.user.mostBlog') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    $('.item-user').html(data);
                },
                error(data) {
                    console.log(data);
                }
            });
        });

        $('#most-comment').on('click', function(event){
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: "{{ route('sort.user.mostComment') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    $('.item-user').html(data);
                },
                error(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
