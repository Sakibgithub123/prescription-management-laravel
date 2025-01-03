<div class="header">
    <div class="header-left">
        <a href="{{route('get.home')}}" class="logo">
            <img src="{{asset('superAdmin')}}/assets/img/logo.png" width="35" height="35" alt=""> <span>MediCareOPS</span>
        </a>
        <!-- Preclinic -->
    </div>
    <a id="toggle_btn" class="pt-2" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
    <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars pt-2"></i></a>
    <ul class="nav user-menu float-right sm:pt-2">
        <li class="nav-item dropdown d-none d-sm-block">
            <a onclick="event.preventDefault(); document.getElementById('bellForm').submit()" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">{{Auth::user()->unreadNotifications()->count()}}</span></a>
            <form method="post" action="{{route('notifications.markAsRead')}}" id="bellForm">@csrf</form>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span>Notifications</span>
                </div>
                <div class="drop-scroll">
                    @if(Auth::user()->notifications->isNotEmpty())
                    <ul class="notification-list">
                        @foreach(Auth::user()->notifications as $notification)
                        <li class="notification-message">
                            <a>
                                <div class="media">
                                    <span class="avatar">
                                        <img alt="John Doe" src="{{asset('superAdmin')}}/assets/img/logo.png" class="img-fluid">
                                        <!-- <img alt="John Doe" src="{{asset('superAdmin')}}/assets/img/user.jpg" class="img-fluid"> -->
                                    </span>
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">{{Auth::user()->name}}</span> : <span class="noti-title">{{$notification->data['message']}}</span></p>
                                        <p class="noti-time"><span class="notification-time">{{$notification->created_at->format('Y-m-d H:i:s')}}</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
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
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                <span class="user-img">
                    <!-- <img class="rounded-circle" src="{{asset('superAdmin')}}/assets/img/user.jpg" width="24" alt="Doctor">
                    <span class="status online"></span> -->
                    @if(!Auth::user()->profile_image)
                    <img class="rounded-circle" src="{{asset('superAdmin')}}/assets/img/user.jpg" width="24" alt="img">
                    <span class="status offline"></span>
                    @else
                    <img class="rounded-circle" src="{{asset('storage/images/'.Auth::user()->profile_image)}}" width="24" alt="img">
                    <span class="status online"></span>
                    @endif
                </span>
                <span>{{Auth::user()->name}}</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('profile')}}">My Profile</a>
                <a class="dropdown-item" href="{{route('profile-edit')}}">Edit Profile</a>
                <!-- <a class="dropdown-item" href="settings.html">Settings</a> -->
                <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logoutFormUser').submit()">Logout</a>
                <form method="get" action="{{route('logout')}}" id="logoutFormUser">@csrf</form>
            </div>
        </li>
    </ul>
    <div class="dropdown mobile-user-menu float-right pt-2">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('profile')}}">My Profile</a>
            <a class="dropdown-item" href="{{route('profile-edit')}}">Edit Profile</a>
            <!-- <a class="dropdown-item" href="settings.html">Settings</a> -->
            <a class="dropdown-item" href="" onclick="event.preventDefault; document.getElementById('logoutFormUser').submit()">Logout</a>
            <form action="{{route('logout')}}" id="logoutFormUser" method="get">@csrf</form>
        </div>
    </div>
</div>