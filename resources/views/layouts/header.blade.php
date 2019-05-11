<header id="header" class="index-no-box">
    <section class="container clearfix">
        <div class="logo"><a href="{{ route('home') }}"><img alt="" src="{{ asset('/images/logo.png') }}"></a></div>
        <nav class="navigation">
            <ul>
                <li class="current_page_item"><a href="{{ route('home') }}">Home</a>
                </li>
                <li class="ask_question"><a href="{{ route('question.create') }}">Ask Question</a></li>
                <li><a href="{{route('blog.index')}}">Blog</a>
                </li>
                <li><a href="">Questions</a>
                    <ul>
                        <li><a href="{{ route('question.category') }}">Questions Category</a></li>
                        <li><a href="{{ route('question.single') }}">Question Text</a></li>
                        <li><a href="{{ route('question.poll') }}">Question Poll</a></li>
                    </ul>
                </li>
                @guest
                @else
                <li><a href="{{ route('profile.index')}}">User</a>
                    <ul>
                        <li><a href="{{ route('profile.index') }}">User Profile</a></li>
                        <li><a href="{{ route('user.question') }}">User Questions</a></li>
                        <li><a href="{{ route('user.blog') }}">User Blogs</a></li>
                        <li><a href="user_answers.html">User Answers</a></li>
                        <li><a href="user_favorite_questions.html">User Favorite Questions</a></li>
                        <li><a href="{{ route('profile.edit', Auth::user()->id) }}">Edit Profile</a></li>
                    </ul>
                </li>
                @endguest
                <li><a href="contact_us.html">Contact Us</a></li>
            </ul>
        </nav>
    </section><!-- End container -->
</header><!-- End header -->
