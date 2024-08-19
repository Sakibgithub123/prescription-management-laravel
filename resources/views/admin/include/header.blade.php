<div class="header">
    <div class="header-left">
        <a class="logo">
            <img src="{{asset('superAdmin')}}/assets/img/logo.png" width="35" height="35" alt=""> <span>MediCareOPS</span>
        </a>
    </div>
    <a id="toggle_btn"  href="javascript:void(0);"><i class="fa fa-bars"></i></a>
    <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars pt-2"></i></a>
    <ul class="nav user-menu float-right">
        <li class="nav-item dropdown d-none d-sm-block">
            <!-- <a class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">3</span></a> -->

            <a onclick="event.preventDefault(); document.getElementById('bellForm').submit()" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">{{Auth::guard('admin')->user()->unreadNotifications->count()}}</span></a>
            <form method="post" action="{{route('notifications.markAsRead')}}" id="bellForm">@csrf</form>

            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span>Notifications</span>
                </div>
                <div class="drop-scroll">
                    @if(Auth::guard('admin')->user()->notifications->isNotEmpty())
                    <ul class="notification-list">
                        @foreach(Auth::guard('admin')->user()->notifications as $notification)
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media">
                                    <span class="avatar">
                                        <!-- <img alt="John Doe" src="{{asset('superAdmin')}}/assets/img/user.jpg" class="img-fluid"> -->
                                        <img alt="John Doe" src="{{asset('superAdmin')}}/assets/img/logo.png" class="img-fluid">
                                    </span>
                                    <!-- display unread notification -->

                                    <div class="media-body">

                                        <p class="noti-details"><span class="noti-title">New user registered: </span> <span class="noti-title">{{$notification->data['message']}}</span></p>
                                        <!-- <p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p> -->

                                        <p class="noti-time"><span class="notification-time">{{$notification->created_at->format('Y-m-d H:i:s')}}</span></p>
                                    </div>

                                </div>
                            </a>

                        </li>
                        @endforeach
                        <!-- <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">V</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
												<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li> -->
                        <!-- <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">L</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
												<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">G</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
												<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">V</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
												<p class="noti-time"><span class="notification-time">2 days ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li> -->
                    </ul>
                    @else
                    <p class="text-center">No notification found.</p>
                    @endif
                </div>
                <div class="topnav-dropdown-footer">
                    <a> All Notifications</a>
                </div>
            </div>

        </li>
        <li class="nav-item dropdown d-none d-sm-block">
        @if(Auth::guard('admin')->user()->notifications->isNotEmpty())
            <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">{{auth()->user()->unreadNotifications->count()}}</span></a>
        @endif
        </li>
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                <span class="user-img">
                    <img class="rounded-circle" src="{{asset('superAdmin')}}/assets/img/user.jpg" width="24" alt="Admin">
                    <span class="status online"></span>
                </span>

                <span>{{Auth::guard('admin')->user()->name }}</span>
            </a>
            <div class="dropdown-menu p-2">
                <!-- <a class="dropdown-item" href="">My Profile</a>
						<a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
						<a class="dropdown-item" href="settings.html">Settings</a> -->
                <a class="btn-sm btn-block btn btn-secondary text-white" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">Logout</a>
                <form method="get" action="{{route('admin.logout')}}" id="logoutForm">@csrf</form>
            </div>
        </li>
    </ul>
    
    <div class="dropdown mobile-user-menu float-right pt-2">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right p-2">
            <!-- <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a> -->
            <a class="btn-sm btn-block btn btn-secondary text-white" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">Logout</a>
            <form method="get" action="{{route('admin.logout')}}" id="logoutForm">@csrf</form>
        </div>
    </div>
</div>


<!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    $(document).ready(function() {
        $('#bellForm').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                url: '/your-route',
                type: 'POST',
                data: {
                    // Your data here
                    _token: '{{ csrf_token() }}', // CSRF token if necessary
                },
                success: function(response) {
                    console.log(response); // This should display your response in the console
                },
                error: function(xhr, status, error) {
                    console.log(error); // Log any errors
                }
            });

        })

    })
</script> -->