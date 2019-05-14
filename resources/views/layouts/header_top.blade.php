<div id="header-top">
    <section class="container clearfix">
        <nav class="header-top-nav">
            <ul>
                <li><a href="contact_us.html"><i class="icon-envelope"></i>Contact</a></li>
                <li><a href="#"><i class="icon-headphones"></i>Support</a></li>
                @guest
                    <li><a href="" id="login-panel"><i class="icon-user"></i>Login Area</a></li>
                @else
                    <li><a><i class="icon-user">    {{ Auth::user()->name }}</i></a></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="icon-signout"> Logout</i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>   
                    </li>
                @endguest
            </ul>
        </nav>
        <div class="header-search">
            <form action="{{route('user.search')}}" method="POST">
                {{ csrf_field() }}
                <input type="text" id="search_text" name="search_text" value="Search here ..." onfocus="if(this.value=='Search here ...')this.value='';" onblur="if(this.value=='')this.value='Search here ...';">
                <button type="submit" class="search-submit" id="search_button"></button>
            </form>
        </div>
    </section><!-- End container -->
</div><!-- End header-top -->
{{--@section('page_scripts')--}}
    {{--@parent--}}
    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function(){--}}
            {{--$('#search_button').on('click', function(event){--}}
                {{--event.preventDefault();--}}
                {{--var search = $('#search_text').val();--}}
                {{--$.ajax({--}}
                    {{--type: 'post',--}}
                    {{--url: "{{ route('user.search.ajax') }}",--}}
                    {{--data: {--}}
                        {{--'_token': $('input[name=_token]').val(),--}}
                        {{--'search_text': search,--}}
                    {{--},--}}
                    {{--success: function() {--}}
                        {{--// $('.toggle-accordion').html(data);--}}
                        {{--window.location.href="http://localhost:8000/user/search";--}}

                    {{--},--}}
                    {{--error(data) {--}}
                        {{--console.log(data);--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
{{--@endsection--}}
