@extends('admin.layouts.master')
@section('page_title')
    Question Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-three">
                <div class="bg-icon pull-left">
                    <i class="ti-image"></i>
                </div>
                <div class="text-right">
                    <p class="text-muted m-t-5 text-uppercase font-600 font-secondary">Total Post</p>
                    <h2 class="m-b-10"><span data-plugin="counterup">2,562</span></h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-three">
                <div class="bg-icon pull-left">
                    <i class="ti-agenda"></i>
                </div>
                <div class="text-right">
                    <p class="text-muted m-t-5 text-uppercase font-600 font-secondary">Pages</p>
                    <h2 class="m-b-10"><span data-plugin="counterup">257</span></h2>
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
                    <h2 class="m-b-10"><span data-plugin="counterup">6,254</span></h2>
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
                    <h2 class="m-b-10"><span data-plugin="counterup">59</span></h2>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->


    {{--<div class="row">--}}
        {{--<div class="col-lg-6">--}}
            {{--<div class="card-box">--}}
                {{--<h4 class="header-title m-t-0">Total Views</h4>--}}

                {{--<div class="text-center">--}}
                    {{--<ul class="list-inline chart-detail-list">--}}
                        {{--<li class="list-inline-item">--}}
                            {{--<h5 class="text-teal"><i class="mdi mdi-crop-square m-r-5"></i>Page Views</h5>--}}
                        {{--</li>--}}
                        {{--<li class="list-inline-item">--}}
                            {{--<h5><i class="mdi mdi-details m-r-5"></i>Visitors</h5>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
                {{--<div id="morris-bar-stacked" style="height: 280px;"></div>--}}

            {{--</div>--}}

        {{--</div> <!-- end col -->--}}

        {{--<div class="col-lg-6">--}}
            {{--<div class="card-box">--}}
                {{--<h4 class="m-t-0 m-b-30 header-title">Visits</h4>--}}
                {{--<div id="world-map-markers" style="height: 305px"></div>--}}

            {{--</div>--}}

        {{--</div> <!-- end col -->--}}

    {{--</div>--}}
    {{--<!-- end row -->--}}

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 m-b-30 header-title">Top 5 Popular Questions</h4>

                <div class="table-responsive">
                    <table class="table table-colored table-centered table-inverse m-0">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Comments</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $questions as $question)
                        <tr>
                            <td><a href="#"> <img class="media-object" alt="64x64" src="{{ asset('/zircos/images/small/img-1.jpg') }}" style="width: 100px; height: 66px;"> </a></td>
                            <td><a href="{{ route('admin.question.detail', $question->id) }}"> {{ $question->title }}</a></td>
                            <td> Category</td>
                            <td>{{ $question->user->name }}</td>
                            <td>984</td>

                            @switch( $question->approve_status)
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
