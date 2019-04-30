<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}">

    <title>Admin Login</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('/zircos/plugins/morris/morris.css') }}">

    <!-- App css -->
    <link href="{{ asset('/zircos/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/zircos/css/core.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/zircos/css/components.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/zircos/css/icons.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/zircos/css/pages.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/zircos/css/menu.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/zircos/css/responsive.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="{{ asset('/zircos/plugins/switchery/switchery.min.css') }}">

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{ asset('/zircos/js/modernizr.min.js') }}"></script>

</head>


<body>

<!-- HOME -->
<section>
    <div class="container-alt">
        <div class="row">
            <div class="col-sm-12">

                <div class="wrapper-page">

                    <div class="m-t-40 account-pages">
                        <div class="text-center account-logo-box">
                            <h2 class="text-uppercase">
                                <a href="" class="text-success">
                                    <span><img src="{{ asset('/images/logo.png')}}" alt="" height="36"></span>
                                </a>
                            </h2>
                            <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                        </div>
                        <div class="account-content">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/login') }}">
                                {!! csrf_field() !!}
                                <div class="form-group ">
                                    <div class="col-xs-12">
                                        <input class="form-control" type="text" razequired="" name="name" placeholder="Username">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <input class="form-control" type="password" required="" name="password" placeholder="Password">
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="col-xs-12">
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox-signup" type="checkbox" checked>
                                            <label for="checkbox-signup">
                                                Remember me
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group text-center m-t-30">
                                    <div class="col-sm-12">
                                        <a href=" {{ url('/password/reset')}}" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                                    </div>
                                </div>

                                <div class="form-group account-btn text-center m-t-10">
                                    <div class="col-xs-12">
                                        <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </div>

                            </form>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <!-- end card-box-->


                    <div class="row m-t-50">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">Don't have an account? <a href="{{ route('admin.register') }}" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                        </div>
                    </div>

                </div>
                <!-- end wrapper -->

            </div>
        </div>
    </div>
</section>
<!-- END HOME -->

<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{asset('/zircos/js/jquery.min.js')}}"></script>
<script src="{{asset('/zircos/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/zircos/js/detect.js')}}"></script>
<script src="{{asset('/zircos/js/fastclick.js')}}"></script>
<script src="{{asset('/zircos/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('/zircos/js/waves.js')}}"></script>
<script src="{{asset('/zircos/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('/zircos/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('/zircos/plugins/switchery/switchery.min.js')}}"></script>

<!-- App js -->
<script src="{{ asset('/zircos/js/jquery.core.js')}}"></script>
<script src="{{ asset('/zircos/js/jquery.app.js')}}"></script>

</body>
</html>
