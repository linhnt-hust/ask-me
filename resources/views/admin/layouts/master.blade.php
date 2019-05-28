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

    <script src="{{ asset('/zircos/plugins/morris/morris.min.js')}}"></script>
    <script src="{{ asset('/zircos/plugins/raphael/raphael-min.js')}}"></script>
    <![endif]-->

    <script src="{{ asset('/zircos/js/modernizr.min.js') }}"></script>
    @yield('page_header')
</head>


<body>


<!-- Navigation Bar-->

@include('admin.layouts.body_header')

<div class="wrapper">
    <div class="container">



        @yield('content')

        @include('admin.layouts.footer')

    </div>
</div>

@include('admin.layouts.bottom_jquery')
@yield('page_scripts')
</body>
</html>
