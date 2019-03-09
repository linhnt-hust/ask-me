@extends('layouts.master')
@section('title')
    User Profile
@endsection
@section('content')
<div class="breadcrumbs">
		<section class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Edit Profile</h1>
				</div>
				<div class="col-md-12">
					<div class="crumbs">
						<a href="{{ route('home') }}">Home</a>
						<span class="crumbs-span">/</span>
						<a href="#">user</a>
						<span class="crumbs-span">/</span>
						<span class="current">Edit Profile</span>
					</div>
				</div>
			</div><!-- End row -->
		</section><!-- End container -->
	</div><!-- End breadcrumbs -->
	
	<section class="container main-content">
		<div class="row">
			<div class="col-md-9">
				<div class="page-content">
                    <div class="boxedtitle page-title"><h2>Edit Profile</h2></div>
                    
					<div class="form-style form-style-4">
						<form action="{{ route('profile.update', $user->id ) }}" method="POST">
                            {{ method_field('PATCH') }}   
                            {{ csrf_field() }}
							<div class="form-inputs clearfix">
								<p>
									<label>First Name</label>
									<input type="text" name="name" value="{{ $user->name }}">
								</p>
								<p>
									<label>Address</label>
									<input type="text" name="address" value="{{ $user->address }}">
								</p>
								<p>
									<label class="required">E-Mail<span>*</span></label>
									<input type="email" name="email" value="{{ $user->email }}">
								</p>
								<p>
									<label>Website</label>
									<input type="text" name="website" value="{{ $user->website }}">
								</p>
								<p>
									<label class="required">Password<span>*</span></label>
									<input type="password" value="password">
								</p>
								<p>
									<label class="required">Confirm Password<span>*</span></label>
									<input type="password" value="password">
								</p>
								<p>
									<label>Country</label>
									<input type="text" name="country" value="{{ $user->country }}">
								</p>
							</div>
							<div class="form-style form-style-2">
								<div class="user-profile-img"><img src="http://placehold.it/60x60/FFF/444" alt="admin"></div>
								<p class="user-profile-p">
									<label>Profile Picture</label>
									<div class="fileinputs">
										<input type="file" class="file" name="avatar" value="avatar">
										<div class="fakefile">
											<button type="button" class="button small margin_0">Select file</button>
											<span><i class="icon-arrow-up"></i>Browse</span>
										</div>
									</div>
								<p></p>
								<div class="clearfix"></div>
								<p>
									<label>About Yourself</label>
									<textarea cols="58" rows="8" name="description">{{ $user->description }}</textarea>
								</p>
							</div>
							<div class="form-inputs clearfix">
								<p>
									<label>Facebook</label>
									<input type="text" name="facebook_account" value="{{ $user->facebook_account }}">
								</p>
								<p>
									<label>Twitter</label>
									<input type="text" name="twitter_account" value="{{ $user->twitter_account }}">
								</p>
								<p>
									<label>Github</label>
									<input type="text" name="github_account" value="{{ $user->github_account }}">
								</p>
								<p>
									<label>Google plus</label>
									<input type="text" name="googleplus_account" value="{{ $user->googleplus_account }}">
								</p>
							</div>
							<p class="form-submit">
								<input type="submit" value="Update" class="button color small submit">
							</p>
						</form>
					</div>
				</div><!-- End page-content -->
			</div><!-- End main -->
			
			@include('layouts.asside_bar')

		</div><!-- End row -->
	</section><!-- End container -->
@endsection