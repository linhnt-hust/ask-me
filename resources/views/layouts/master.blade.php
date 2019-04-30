<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs -->
	<meta charset="utf-8">
	<title> @yield('title') </title>
	<meta name="description" content="Ask me Responsive Questions and Answers Template">
	<meta name="author" content="vbegy">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- Main Style -->
	<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
	
	<!-- Skins -->
	<link rel="stylesheet" href="{{ asset('/css/skins/blue.css') }}">
	
	<!-- Responsive Style -->
	<link rel="stylesheet" href="{{ asset('/css/responsive.css') }}">
	
	<!-- Favicons -->
	<link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}">
	
	@yield('page_scripts')
</head>
<body>

<div class="loader"><div class="loader_html"></div></div>

<div id="wrap" class="grid_1200">
	
	@include('auth.login_panel')
	
	@include('auth.signup')
	
	@include('auth.lost_password')
	
	@include('layouts.header_top')

	@include('layouts.header')

	<!-- Content -->
	@yield('content')
	<!-- End Content -->

	@include('layouts.footer')

	@include('layouts.footer_bottom')
</div><!-- End wrap -->

<div class="go-up"><i class="icon-chevron-up"></i></div>

@include('layouts.bottom_js')

@yield('page_scripts')
@yield('inline_scripts')

</body>
</html>
