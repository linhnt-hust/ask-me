<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">


    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}">
    <!-- App title -->
    <title>Create your blog</title>

    <!-- Summernote css -->
    <link href="{{ asset('/zircos/plugins/summernote/summernote.css')}}" rel="stylesheet" />

    <!-- Select2 -->
    <link href="{{ asset('/zircos/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Jquery filer css -->
    <link href="{{ asset('/zircos/plugins/jquery.filer/css/jquery.filer.css')}}" rel="stylesheet" />
    <link href="{{ asset('/zircos/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css')}}" rel="stylesheet" />

    <!-- App css -->
    <link href="{{ asset('/zircos/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/zircos/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/zircos/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/zircos/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/zircos/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/zircos/css/menu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/zircos/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/zircos/plugins/switchery/switchery.min.css') }}">

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{asset('/zircos/js/modernizr.min.js')}}"></script>

</head>


<body class="fixed-left">


<!-- Begin page -->
<div id="wrapper">

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Edit Post </h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li>
                                    <a href="{{route('home')}}">Ask-me</a>
                                </li>
                                <li>
                                    <a href="{{ route('blog.index') }}">Blogs </a>
                                </li>
                                <li class="active">
                                    Edit Post
                                </li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="card-box">
                            <div class="">
                                <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                    {{ method_field('PATCH') }}
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <div class="form-group m-b-20">
                                        <label for="exampleInputEmail1">Post Title</label>
                                        <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter title" value="{{$blog->title}}">
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label class="m-b-10">Post Type</label>
                                        <br/>
                                        <div class="radio radio-info radio-inline">
                                            <input type="radio" id="inlineRadio1" value="1"
                                                   name="type" @if ($blog->type == 1 ) checked=checked @endif>
                                            <label for="inlineRadio1"> Text </label>
                                        </div>
                                        <div class="radio radio-info radio-inline">
                                            <input type="radio" id="inlineRadio2" value="2"
                                                   name="type" @if ($blog->type == 2 ) checked=checked @endif>
                                            <label for="inlineRadio3" > SlideShow </label>
                                        </div>
                                        <div class="radio radio-info radio-inline">
                                            <input type="radio" id="inlineRadio3" value="3"
                                                   name="type" @if ($blog->type == 3 ) checked=checked @endif>
                                            <label for="inlineRadio4" > Video </label>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label>Description</label>
                                        <textarea class="summernote" name="summetnoteInput">
                                        </textarea>
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label>Post Category</label>
                                        <select class="select2 form-control select2-multiple" name="categories[]" multiple="multiple" data-placeholder="Choose ...">
                                            <option value="">Select a Category</option>
                                            @foreach( $categories as $cate)
                                                <option value="{{$cate->id}}" @if($blog->category->containsStrict('id', $cate->id)) selected="selected" @endif> {{ $cate->name_category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group m-b-20" id="file_change">
                                        <label>File Uploads</label>
                                        <a id="change_file" onclick="changeFile()"><i class="icon-bar">change</i></a>
                                        <input type="file" name="files[]" id="filer_input1"
                                               multiple="multiple">

                                    </div>
                                    {{--<div class="form-group m-b-20">--}}
                                        {{--<label>File Uploaded</label>--}}
                                        {{--@foreach($blog->blogUploaded as $upload)--}}
                                            {{--<input type="text" name="url" class="form-control" value="{{$upload->filename}}">--}}
                                        {{--@endforeach--}}
                                    {{--</div>--}}

                                    <div class="form-group m-b-20">
                                        <label for="videourl">URL</label>
                                        <input type="text" name="url" class="form-control" id="videourl" placeholder="Enter url.." value="{{$blog->url}}">
                                    </div>
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Save and Post</button>
                                    <a href="{{route('blog.index')}}" type="button" class="btn btn-danger waves-effect waves-light">Discard</a>
                                </form>
                            </div>
                        </div> <!-- end p-20 -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->



            </div> <!-- container -->

        </div> <!-- content -->
        <footer class="footer text-right">
            2019-linhnt © Ask-me.
        </footer>

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

</div>
<!-- END wrapper -->



<script>
    var resizefunc = [];
</script>

<script src="{{ asset('/zircos/js/jquery.min.js') }}"></script>
<script src="{{ asset('/zircos/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/zircos/js/detect.js') }}"></script>
<script src="{{ asset('/zircos/js/fastclick.js') }}"></script>
<script src="{{ asset('/zircos/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('/zircos/js/waves.js') }}"></script>
<script src="{{ asset('/zircos/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('/zircos/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('/zircos/plugins/switchery/switchery.min.js') }}"></script>

<!--Summernote js-->
<script src="{{ asset('/zircos/plugins/summernote/summernote.min.js') }}"></script>

<!-- Select 2 -->
<script src="{{ asset('/zircos/plugins/select2/js/select2.min.js') }}"></script>
<!-- Jquery filer js -->
<script src="{{ asset('/zircos/plugins/jquery.filer/js/jquery.filer.min.js') }}"></script>

<!-- page specific js -->
<script src="{{ asset('/zircos/pages/jquery.blog-add.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('/zircos/js/jquery.core.js') }}"></script>
<script src="{{ asset('/zircos/js/jquery.app.js') }}"></script>

<script>

    function changeFile(){
        $(".jFiler-input-dragDrop").toggle();
    }
    jQuery(document).ready(function(){
        $(".jFiler-input-dragDrop").hide();

        $('.summernote').summernote({
            height: 240,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });

        $('.summernote').summernote();
        var content = {!! json_encode($blog->description) !!};
        $('.summernote').summernote('code', content);

        // Select2
        $(".select2").select2();

        $(".select2-limiting").select2({
            maximumSelectionLength: 2
        });
    });
</script>

</body>
</html>
