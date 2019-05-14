<footer id="footer">
    <section class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="widget widget_contact">
                    <h3 class="widget_title">Where We Are ?</h3>
                    <ul>
                        <li>
                            <span>Address :</span>
                            609 Trương Định, Hoàng Mai, Hà Nội.
                        </li>
                        <li>
                            <span>Support :</span>Support Telephone No : (+84)834921996
                        </li>
                        <li>Support Email Account : chaosmeteor@gmail.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <div class="widget">
                    <h3 class="widget_title">Quick Links</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('question.create') }}">Ask Question</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="{{ route('question.category') }}">Questions</a></li>
                        <li><a href="{{ route('profile.index') }}">Users</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                        <li><a href="contact_us.html">Contact Us</a></li>
                        <li><a href="#">FAQs</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget">
                    <h3 class="widget_title">Recent Questions</h3>
                    <ul class="related-posts">
                        <li class="related-item">
                            <h3><a href="{{ route('question.show', $recentQuestions[0]->id) }}">{{ substr($recentQuestions[0]->details, 0, 10) }}...</a></h3>
                            <p>{{ substr($recentQuestions[0]->details, 0, 20) }}...</p>
                            <div class="clear"></div><span>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $recentQuestions[0]->updated_at)->diffForHumans() }}</span>
                        </li>
                        <li class="related-item">
                            <h3><a href="{{ route('question.show', $recentQuestions[1]->id) }}">{{ substr($recentQuestions[1]->details, 0, 10) }}...</a></h3>
                            <p>{{ substr($recentQuestions[1]->details, 0, 20) }}...</p>
                            <div class="clear"></div><span>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $recentQuestions[1]->updated_at)->diffForHumans() }}</span>
                        </li>
                    </ul>
                </div>	
            </div>
            <div class="col-md-3">
                <div class="widget widget_twitter">
                    <h3 class="widget_title">Latest Tweets</h3>
                    <div class="tweet_1"></div>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</footer><!-- End footer -->
