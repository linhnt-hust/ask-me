@extends('admin.layouts.master')
@section('page_title')
    Blog Dashboard
@endsection
@section('content')
    <div class="row">
        @if ($message = Session::get('success'))
            <div class="alert alert-icon alert-info alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="mdi mdi-check-all"></i>
                <strong>Congratulation!</strong> {{$message}}
            </div>
        @endif

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-three">
                <div class="bg-icon pull-left">
                    <i class="ti-image"></i>
                </div>
                <div class="text-right">
                    <p class="text-muted m-t-5 text-uppercase font-600 font-secondary">Total Post</p>
                    <h2 class="m-b-10"><span data-plugin="counterup">{{ count($blogs) }}</span></h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-three">
                <div class="bg-icon pull-left">
                    <i class="ti-agenda"></i>
                </div>
                <div class="text-right">
                    <p class="text-muted m-t-5 text-uppercase font-600 font-secondary">Approved</p>
                    <h2 class="m-b-10"><span data-plugin="counterup">{{ count($verified) }}</span></h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-three">
                <div class="bg-icon pull-left">
                    <i class="ti-comment-alt"></i>
                </div>
                <div class="text-right">
                    <p class="text-muted m-t-5 text-uppercase font-600 font-secondary">Comments</p>
                    <h2 class="m-b-10"><span data-plugin="counterup">{{ count($totalComments) }}</span></h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-three">
                <div class="bg-icon pull-left">
                    <i class="ti-view-list-alt"></i>
                </div>
                <div class="text-right">
                    <p class="text-muted m-t-5 text-uppercase font-600 font-secondary">Categories</p>
                    <h2 class="m-b-10"><span data-plugin="counterup">{{ count($totalCategories) }}</span></h2>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 m-b-30 header-title">All Blogs</h4>

                <div class="table-responsive">
                    <table class="table table-colored table-centered table-inverse m-0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Author</th>
                            <th>Comments</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $blogs as $blog)
                            <tr>
{{--<td><a href="#"> <img class="media-object" alt="64x64" src="{{ asset('/upload/blogs/'.$blog->blogUploaded->filename) }}" style="width: 100px; height: 66px;"> </a></td>--}}
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('admin.blog.detail', $blog->id) }}"> {{ $blog->title }}</a></td>
                                <td>{{ \App\Models\Blog::$type[$blog->type] }}</td>
                                <td>{{ $blog->user->name }}</td>
                                <td>984</td>

                                @switch( $blog->approve_status)
                                    @case (0)
                                    <td><span class="label label-warning">Pending</span></td>
                                    @break
                                    @case (1)
                                    <td><span class="label label-success">Approved</span></td>
                                    @break;
                                    @case (2)
                                    <td><span class="label label-danger">Denied</span></td>
                                    @break;
                                @endswitch

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        var resizefunc = [];
    </script>

    <!-- Load page level scripts-->
    <script src="{{asset('/zircos/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('/zircos/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('/zircos/plugins/jvectormap/gdp-data.js')}}"></script>
    <script src="{{asset('/zircos/plugins/jvectormap/jquery-jvectormap-us-aea-en.js')}}"></script>

    <!-- Dashboard Init js -->
    <script src="{{asset('/zircos/pages/jquery.blog-dashboard.js')}}"></script>
@endsection
