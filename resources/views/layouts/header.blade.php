<header id="header" class="index-no-box">
    <section class="container clearfix">
        <div class="logo"><a href="{{ route('home') }}"><img alt="" src="{{ asset('/images/logo.png') }}"></a></div>
        <nav class="navigation">
            <ul>
                <li class="current_page_item"><a href="{{ route('home') }}">Home</a>
                </li>
                <li class="ask_question"><a href="{{ route('question.create') }}">Ask Question</a></li>
                <li><a href="{{route('blog.index')}}">Blog</a>
                    {{--<ul>--}}
                        {{--<li><a href="blog_1.html">Blog 1</a>--}}
                            {{--<ul>--}}
                                {{--<li><a href="blog_1.html">Right sidebar</a></li>--}}
                                {{--<li><a href="blog_1_l_sidebar.html">Left sidebar</a></li>--}}
                                {{--<li><a href="blog_1_full_width.html">Full Width</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                </li>
                <li><a href="cat_question.html">Questions</a>
                    <ul>
                        <li><a href="cat_question.html">Questions Category</a></li>
                        <li><a href="single_question.html">Question Single</a></li>
                        <li><a href="single_question_poll.html">Poll Question Single</a></li>
                    </ul>
                </li>
                @guest
                @else
                <li><a href="{{ route('profile.index')}}">User</a>
                    <ul>
                        <li><a href="{{ route('profile.index') }}">User Profile</a></li>
                        <li><a href="{{ route('user.question') }}">User Questions</a></li>
                        <li><a href="user_answers.html">User Answers</a></li>
                        <li><a href="user_favorite_questions.html">User Favorite Questions</a></li>
                        <li><a href="user_points.html">User Points</a></li>
                        <li><a href="edit_profile.html">Edit Profile</a></li>
                    </ul>
                </li>
                @endguest
                <li><a href="contact_us.html">Contact Us</a></li>
            </ul>
        </nav>
    </section><!-- End container -->
</header><!-- End header -->
