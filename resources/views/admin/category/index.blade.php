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
                            Categories
                        </li>
                    </ol>
                </div>
                <h4 class="page-title"> Category Statistical</h4>
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
                                <button type="submit" class="btn btn-search search-category"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4">
                    <a href="#custom-modal" class="btn btn-success btn-rounded btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal"
                    data-overlaySpeed="200" data-overlayColor="#36404a" data-toggle="modal" data-target="#con-close-modal"><i class="md md-add"></i> Add New Category</a>
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
                                    </ul>
                                </div>
                            </th>
                            <th>Name</th>
                            <th>Questions</th>
                            <th>Blogs</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="item-user">
                        @foreach($categories as $category)
                            <tr id="deleteItem_{{$category->id}}">
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $category->name_category }}
                                </td>
                                <td>
                                    {{ $category->countQuestionByCategory($category->id) }}
                                </td>
                                <td>
                                    {{ $category->blog->count() }}
                                </td>
                                <td>
                                    {{ $category->created_at }}
                                </td>
                                <td>
                                    <a href="#" class="table-action-btn h3"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                    <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = "{{$category->id}}"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end table responsive -->
            </div> <!-- end card-box -->

            <div class="text-right">
                {{ $categories->render('admin.elements.pagination') }}
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
                        <h4 class="text-center">Are you sure you want to delete the following category?</h4>
                        <p class="text-center">Bạn có chắc muốn xoá chủ đề này không?</p>
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


    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add New Category</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Name Category</label>
                            <input type="text" class="form-control" id="name_category" placeholder="Write down name of category that you want" style="color: #00aff0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success waves-effect waves-light add-category" data-dismiss="modal">Save changes</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
@endsection
@section ('page_scripts')
    @parent
    <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript">
        $(document).on('click', '.delete-modal', function() {
            $('#id_delete').val($(this).data('id'));
            id = $('#id_delete').val();
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'post',
                url: "{{ route('admin.delete.category') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    category_id: id,
                },
                success: function(data) {
                    toastr.success('Successfully deleted category!', 'Success Alert', {timeOut: 5000});
                    $('#deleteItem_' + data['id']).remove();
                },
                error(data) {
                    console.log(data);
                }
            });
        });

        $('.search-category').on('click', function(event){
            event.preventDefault();
            var search = $('#search_input').val();
            $.ajax({
                type: 'post',
                url: "{{ route('admin.category.search') }}",
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

        $('.modal-footer').on('click', '.add-category', function() {
            var name = $('#name_category').val();
            $.ajax({
                type: 'post',
                url: "{{ route('admin.add.category') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    name_category: name,
                },
                success: function(data) {
                    toastr.success('Successfully add category!', 'Success Alert', {timeOut: 5000});
                    $('.item-user').append(data);
                },
                error(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
