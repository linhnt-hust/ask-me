<header id="topnav">
    <div class="topbar-main">
        <div class="container">

            <!-- Logo container-->
            <div class="logo">
                <!-- Text Logo -->
                <!--<a href="index.html" class="logo">-->
                <!--Zircos-->
                <!--</a>-->
                <!-- Image Logo -->
                <a href=" {{ route('home') }}" class="logo">
                    <img src="{{ asset('/images/logo.png')}}" alt="" height="30">
                </a>

            </div>
            <!-- End Logo container-->


            <div class="menu-extras">

                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="navbar-c-items">
                        <form role="search" class="navbar-left app-search pull-left hidden-xs">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>

                    {{--<li class="dropdown navbar-c-items">--}}
                        {{--<a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown">--}}
                            {{--<i class="mdi mdi-email"></i>--}}
                            {{--<span class="badge up bg-danger">8</span>--}}
                        {{--</a>--}}

                        {{--<ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">--}}
                            {{--<li class="text-center">--}}
                                {{--<h5>Messages</h5>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#" class="user-list-item">--}}
                                    {{--<div class="avatar">--}}
                                        {{--<img src="{{ asset('/zircos/images/users/avatar-2.jpg')}}" alt="">--}}
                                    {{--</div>--}}
                                    {{--<div class="user-desc">--}}
                                        {{--<span class="name">Patricia Beach</span>--}}
                                        {{--<span class="desc">There are new settings available</span>--}}
                                        {{--<span class="time">2 hours ago</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#" class="user-list-item">--}}
                                    {{--<div class="avatar">--}}
                                        {{--<img src="{{ asset('/zircos/images/users/avatar-3.jpg')}}" alt="">--}}
                                    {{--</div>--}}
                                    {{--<div class="user-desc">--}}
                                        {{--<span class="name">Connie Lucas</span>--}}
                                        {{--<span class="desc">There are new settings available</span>--}}
                                        {{--<span class="time">2 hours ago</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#" class="user-list-item">--}}
                                    {{--<div class="avatar">--}}
                                        {{--<img src="{{ asset('/zircos/images/users/avatar-4.jpg')}}" alt="">--}}
                                    {{--</div>--}}
                                    {{--<div class="user-desc">--}}
                                        {{--<span class="name">Margaret Becker</span>--}}
                                        {{--<span class="desc">There are new settings available</span>--}}
                                        {{--<span class="time">2 hours ago</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="all-msgs text-center">--}}
                                {{--<p class="m-0"><a href="#">See all Messages</a></p>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}



                    <li class="dropdown navbar-c-items dropdown-notifications">
                        <a href="#notifications-panel" class="right-menu-item dropdown-toggle" data-toggle="dropdown">
                            <i class="mdi mdi-bell" data-count="0"></i>
                            <span class="badge up bg-danger notif-count"></span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
                            {{--<li class="text-center">--}}
                                {{--<h5>Notifications</h5>--}}
                            {{--</li>--}}

                            {{--<li>--}}
                                {{--<a href="#" class="user-list-item">--}}
                                    {{--<div class="icon bg-danger">--}}
                                        {{--<i class="mdi mdi-comment"></i>--}}
                                    {{--</div>--}}
                                    {{--<div class="user-desc">--}}
                                        {{--<span class="name">New Message received</span>--}}
                                        {{--<span class="time">1 day ago</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#" class="user-list-item">--}}
                                    {{--<div class="icon bg-warning">--}}
                                        {{--<i class="mdi mdi-settings"></i>--}}
                                    {{--</div>--}}
                                    {{--<div class="user-desc">--}}
                                        {{--<span class="name">Settings</span>--}}
                                        {{--<span class="time">1 day ago</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            <li class="all-msgs text-center">
                                <p class="m-0"><a href="#">See all Notification</a></p>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown navbar-c-items">
                        <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="{{ asset('/avatar/admins/'.Auth::guard('admin')->user()->avatar)}}" alt="user-img" class="img-circle"> </a>
                        <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                            <li class="text-center">
                                <h5>Hi, {{Auth::guard('admin')->user()->name}}</h5>
                            </li>
                            <li><a href="{{ route('admin.profile') }}"><i class="ti-user m-r-5"></i> Profile</a></li>
                            <li><a href="{{ route('admin.profile.edit',Auth::guard('admin')->user()->id) }}"><i class="ti-settings m-r-5"></i> Edit Profile</a></li>
                            <li><a href="javascript:void(0)" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>

                    </li>
                </ul>
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>
            <!-- end menu-extras -->

        </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->

    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="has-submenu">
                        <a href="{{ route('admin.index') }}"><i class="mdi mdi-view-dashboard"></i>Users</a>
                    </li>

                    <li class="has-submenu">
                        <a href="{{ route('admin.question') }}"><i class="mdi mdi-comment-text"></i>Questions</a>
                    </li>
                    <li class="has-submenu">
                        <a href="{{ route('admin.blog') }}"><i class="mdi mdi-book-multiple"></i>Blogs</a>
                    </li>
                    <li class="has-submenu">
                        <a href="{{ route('admin.category') }}"><i class="mdi mdi-layers"></i>Categories</a>
                    </li>
                    <li class="has-submenu">
                        <a href="{{ route('admin.tag') }}"><i class="mdi mdi-diamond"></i>Tags</a>
                    </li>
                </ul>
                <!-- End navigation menu -->
            </div> <!-- end #navigation -->
        </div> <!-- end container -->
    </div> <!-- end navbar-custom -->
</header>
<!-- End Navigation Bar-->


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//js.pusher.com/3.1/pusher.min.js"></script>
{{--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>--}}

<script type="text/javascript">

    var notificationsWrapper   = $('.dropdown-notifications');
    var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));
    var notifications          = notificationsWrapper.find('ul.notify-list');

    // if (notificationsCount <= 0) {
    //     notificationsWrapper.hide();
    // }

    //Thay giá trị PUSHER_APP_KEY vào chỗ xxx này nhé
    var pusher = new Pusher('5cd88edf539f7701d31c', {
        encrypted: true,
        cluster: "ap1"
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('development');

    // Bind a function to a Event (the full Laravel class)
    channel.bind('App\\Events\\NotifyPusherEvent', function(data) {
        var existingNotifications = notifications.html();
        var newNotificationHtml = `
          <li>
                <a href="/admin/question/detail/`+data.id+`" class="user-list-item">
                    <div class="icon bg-info">
                        <i class="mdi mdi-account"></i>
                    </div>
                    <div class="user-desc">
                        <span class="name">New Question Create</span>
                        <span class="desc">`+data.title+`</span>
                        <span class="time">`+data.createAt+`</span>
                    </div>
                </a>
            </li>
        `;
        notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();
    });
</script>
