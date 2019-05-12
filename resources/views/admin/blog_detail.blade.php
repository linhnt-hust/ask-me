@extends('admin.layouts.master')
@section('page_title')
    Blog Detail
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

                            @switch( $blog->approve_status)
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
                            @if ($blog->type ==1 )
                            @elseif ($blog->type == 2)
                                @foreach( $blog->blogUploaded as $blogFileUpload)
                                        <img src="{{ asset('upload/blogs/'.$blogFileUpload->filename) }}" alt="" class="img-responsive">
                                @endforeach
                            @elseif ($blog->type == 3)
                                <div class="embed-responsive embed-responsive-16by9">
                                    {!! $blog->getVideoHtmlAttribute($blog->url, 500, 500)!!}
                                </div>
                            @endif
                        </div>
                        <div class="text-muted"><span>by <a class="text-dark font-secondary">{{ $blog->user->name }}</a>,</span> <span>{{ $blog->created_at->format('M d,Y') }}</span></div>
                        <div class="post-title">
                            <h3><a href="javascript:void(0);">{{ $blog->title }}</a></h3>
                        </div>
                        <div>
                            <p>{{ $blog->description }}
                            </p>
                        </div>

                    </div>

                    <div class="m-t-50">
                        <h4 class="text-uppercase">About Author</h4>
                        <div class="border m-b-20"></div>

                        <div class="media">
                            <div class="media-left">
                                <a href="#"> <img class="media-object m-r-10" alt="64x64" src="{{ asset('/avatar/users/'.$blog->user->avatar) }}" style="width: 96px; height: 96px;"> </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{ $blog->user->name }}</h4>
                                <p>
                                    {{ $blog->user->description }}
                                </p>

                            </div>
                        </div>
                    </div>

                    <hr/>
                    <div class="m-t-50 blog-post-comment">
                        <h4 class="text-uppercase">Comments <small>({{ count($blog->comments )}})</small></h4>
                        <div class="border m-b-20"></div>

                        <ul class="media-list">
                            @foreach ($blog->comments as $comment)
                                @include('admin.comment_replies',['comment' => $comment])
                            @endforeach
                        </ul>

                        <h4 class="text-uppercase m-t-50">Leave message for question owner</h4>
                        <div class="border m-b-20"></div>

                        <form name="ajax-form" action="{{ route('admin.blog.verify') }}" method="POST" class="contact-form" data-parsley-validate="" novalidate="">
                            @csrf
                            <!-- /Form-email -->
                            <input name="verify_author" type="hidden" value="{{ Auth::guard('admin')->user()->id }}">
                            <input name="approve_status" type="hidden" value="{{ $blog->approve_status }}">
                            <input name="question_id" type="hidden" value="{{ $blog->id }}">
                            <div class="form-group">
                                <textarea class="form-control" id="message2" name="note" rows="5" placeholder="Message" required=""></textarea>
                            </div>
                            <!-- /Form Msg -->

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="">
                                        @switch ( $blog->approve_status)
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
                                        <a href="{{ route('admin.blog') }}" class="btn btn-default waves-effect waves-light">Back</a>
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
                            <li><a href="#">Lifestyle</a></li>
                            <li><a href="#">Music</a></li>
                            <li><a href="#">Travel</a></li>
                            <li><a href="#">Fashion</a></li>
                            <li><a href="#">Videos</a></li>
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
@endsection
