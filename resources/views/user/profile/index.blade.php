@extends('layouts.master')
@section('title')
    User Profile
@endsection
@section('content')
<div class="breadcrumbs">
    @include('flash::message')
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>User Profile :  {{ $user->name }} </h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="crumbs-span">/</span>
                    <a href="#">User</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">User Profile : {{ $user->name }}</span>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->

<section class="container main-content">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="user-profile">
                    <div class="col-md-12">
                        <div class="page-content">
                            <h2>About {{ $user->name }}
                                 <a href="{{ route('profile.edit', $user->id) }}" class="button small blue-button custom-button">Edit</a>
                            </h2>
                            <div class="user-profile-img"><img width="60" height="60" src="http://placehold.it/60x60/FFF/444" alt="admin"></div>
                            <div class="ul_list ul_list-icon-ok about-user">
                                <ul>
                                    <li><i class="icon-plus"></i>Registerd : <span>{{ $user->created_at->format('M d,Y') }}</span></li>
                                    <li><i class="icon-map-marker"></i>Country : <span>{{ $user->country }}</span></li>
                                    <li><i class="icon-globe"></i>Website : <a target="_blank" href="http://themeforest.net/user/vbegy">view</a></li>
                                </ul>
                            </div>
                            <p>{{ $user->description }}</p>
                            <div class="clearfix"></div>
                            <span class="user-follow-me">Follow Me</span>
                            <a href="#" original-title="Facebook" class="tooltip-n">
                                <span class="icon_i">
                                    <span class="icon_square" icon_size="30" span_bg="#3b5997" span_hover="#2f3239">
                                        <i class="social_icon-facebook"></i>
                                    </span>
                                </span>
                            </a>
                            <a href="#" original-title="Twitter" class="tooltip-n">
                                <span class="icon_i">
                                    <span class="icon_square" icon_size="30" span_bg="#00baf0" span_hover="#2f3239">
                                        <i class="social_icon-twitter"></i>
                                    </span>
                                </span>
                            </a>
                            <a href="#" original-title="Linkedin" class="tooltip-n">
                                <span class="icon_i">
                                    <span class="icon_square" icon_size="30" span_bg="#006599" span_hover="#2f3239">
                                        <i class="social_icon-linkedin"></i>
                                    </span>
                                </span>
                            </a>
                            <a href="#" original-title="Google plus" class="tooltip-n">
                                <span class="icon_i">
                                    <span class="icon_square" icon_size="30" span_bg="#c43c2c" span_hover="#2f3239">
                                        <i class="social_icon-gplus"></i>
                                    </span>
                                </span>
                            </a>
                            <a href="#" original-title="Email" class="tooltip-n">
                                <span class="icon_i">
                                    <span class="icon_square" icon_size="30" span_bg="#000" span_hover="#2f3239">
                                        <i class="social_icon-email"></i>
                                    </span>
                                </span>
                            </a>
                        </div><!-- End page-content -->
                    </div><!-- End col-md-12 -->
                    <div class="col-md-12">
                        <div class="page-content page-content-user-profile">
                            <div class="user-profile-widget">
                                <h2>User Stats</h2>
                                <div class="ul_list ul_list-icon-ok">
                                    <ul>
                                        <li><i class="icon-question-sign"></i><a href="user_questions.html">Questions<span> ( <span>30</span> ) </span></a></li>
                                        <li><i class="icon-comment"></i><a href="user_answers.html">Answers<span> ( <span>10</span> ) </span></a></li>
                                        <li><i class="icon-star"></i><a href="user_favorite_questions.html">Favorite Questions<span> ( <span>3</span> ) </span></a></li>
                                        <li><i class="icon-heart"></i><a href="user_points.html">Points<span> ( <span>20</span> ) </span></a></li>
                                        <li><i class="icon-asterisk"></i>Best Answers<span> ( <span>2</span> ) </span></li>
                                    </ul>
                                </div>
                            </div><!-- End user-profile-widget -->
                        </div><!-- End page-content -->
                    </div><!-- End col-md-12 -->
                </div><!-- End user-profile -->
            </div><!-- End row -->
            <div class="clearfix"></div>
            <div class="page-content">
                <div class="user-stats">
                    <div class="user-stats-head">
                        <div class="block-stats-1 stats-head">#</div>
                        <div class="block-stats-2 stats-head">Today</div>
                        <div class="block-stats-3 stats-head">Month</div>
                        <div class="block-stats-4 stats-head">Total</div>
                    </div>
                    <div class="user-stats-item">
                        <div class="block-stats-1">Questions</div>
                        <div class="block-stats-2">5</div>
                        <div class="block-stats-3">20</div>
                        <div class="block-stats-4">100</div>
                    </div>
                    <div class="user-stats-item">
                        <div class="block-stats-1">Answers</div>
                        <div class="block-stats-2">30</div>
                        <div class="block-stats-3">150</div>
                        <div class="block-stats-4">1000</div>
                    </div>
                    <div class="user-stats-item user-stats-item-last">
                        <div class="block-stats-1">Visitors</div>
                        <div class="block-stats-2">100</div>
                        <div class="block-stats-3">3000</div>
                        <div class="block-stats-4">5000</div>
                    </div>
                </div><!-- End user-stats -->
            </div><!-- End page-content -->
        </div><!-- End main -->
        
        @include('layouts.asside_bar')
        
    </div><!-- End row -->
</section><!-- End container -->
@endsection
