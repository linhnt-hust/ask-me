<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}">

    <title>Ask Me - Admin Site</title>

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


<!-- Navigation Bar-->

@include('admin.layouts.body_header')

<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group pull-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li>
                                <a href="#">Ask-me</a>
                            </li>
                            <li>
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="active">
                                Dashboard
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">@yield('page_title')</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        @yield('content')

        @include('admin.layouts.footer')

    </div>
</div>

@include('admin.layouts.bottom_jquery')

</body>
</html>
