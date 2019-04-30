@extends('layouts.master')
@section('title')
    Login Form
@endsection
@section('content')
    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Login</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="#">Home</a>
                        <span class="crumbs-span">/</span>
                        <a href="#">Pages</a>
                        <span class="crumbs-span">/</span>
                        <span class="current">Login</span>
                    </div>
                </div>
            </div><!-- End row -->
        </section><!-- End container -->
    </div><!-- End breadcrumbs -->

    <section class="container main-content">
		<div class="login">
			<div class="row">
				<div class="col-md-6">
					<div class="page-content">
						<h2>Login</h2>
						<div class="form-style form-style-3">
							<form method="POST" role="form" action="{{ route('login') }}">
                                {{ csrf_field() }}
								<div class="form-inputs clearfix">
									<p class="login-text">
										<input type="text" value="Username" name="name" onfocus="if (this.value == 'Username') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Username';}">
										<i class="icon-user"></i>
									</p>
									<p class="login-password">
										<input type="password" value="Password" name="password" onfocus="if (this.value == 'Password') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Password';}">
										<i class="icon-lock"></i>
										<a href="#">Forget</a>
									</p>
								</div>
								<p class="form-submit login-submit">
									<input type="submit" value="Log in" class="button color small login-submit submit">
								</p>
								<div class="rememberme">
									<label><input type="checkbox" checked="checked"> Remember Me</label>
								</div>
							</form>
						</div>
					</div><!-- End page-content -->
    </div><!-- End col-md-6 -->
    <div class="col-md-6">
        <div class="page-content">
            <h2>Register Now</h2>
            <p>AskMe’s mission is to share and grow the world’s knowledge. We want to bring together people with different perspectives so they can understand each other better, and to empower everyone to share their knowledge for the benefit of the rest of the world</p>
            <a class="button small color signup">Create an account</a>
        </div><!-- End page-content -->
    </div><!-- End col-md-6 -->
    </div><!-- End row -->
    </div><!-- End login -->
    </section><!-- End container -->
@endsection
