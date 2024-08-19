<style>
     a{
        font-weight: bold;
    }
    a i, span{
        color: #003366;

    }
</style>


<div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll bg-primary ">
                <div id="sidebar-menu" class="sidebar-menu ">
                    <ul class="text-white">
                        <li class="menu-title font-weight-bold text-white h5 text-center border-bottom">Admin Dashboard</li>
                        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }} text-white">
                            <a  href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="submenu">
							<a  href="#"><i class="fa fa-hospital-o" aria-hidden="true"></i> <span > Clinic Details </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a class="{{ request()->routeIs('clinic.form') ? 'active' : '' }}" href="{{route('clinic.form')}}"><i class="fa fa-location-arrow" aria-hidden="true"></i><span>Add Clinic Details</span> </a></li>
							</ul>
						</li>
                        <li class="submenu">
							<a href="#"><i class="fa fa-calendar"></i> <span> Manage Prescription </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a class="{{ Route::is('Medicine.Form') ? 'active' : '' }}" href="{{route('Medicine.Form')}}"><i class="fa fa-plus-square" aria-hidden="true"></i> <span>Add Medicine</span> </a></li>
								<li><a class="{{ Route::is('Complaints.Form') ? 'active' : '' }}" href="{{route('Complaints.Form')}}"><i class="fa fa-building-o" aria-hidden="true"></i><span>Add Complaints</span> </a></li>
                                <li><a class="{{ Route::is('Investigations.Form') ? 'active' : '' }}" href="{{route('Investigations.Form')}}"><i class="fa fa-bug" aria-hidden="true"></i><span>Add Investigations</span> </a></li>
                                <li><a class="{{ Route::is('test.Form') ? 'active' : '' }}" href="{{route('test.Form')}}"><i class="fa fa-hand-o-right" aria-hidden="true"></i><span>Add Test</span> </a></li>
                                <li><a class="{{ Route::is('diagnose.Form') ? 'active' : '' }}" href="{{route('diagnose.Form')}}"><i class="fa fa-heartbeat" aria-hidden="true"></i><span>Add Diagnose</span> </a></li>
							</ul>
						</li>
						<li class="{{ Route::is('doctor.list') ? 'active' : '' }}">
                            <a  href="{{route('doctor.list')}}"><i class="fa fa-user-md"></i> <span>Doctor's List</span></a>
                        </li>
                        <li class="{{ Route::is('patient.list') ? 'active' : '' }}">
                            <a  href="{{route('patient.list')}}"><i class="fa fa-wheelchair"></i> <span>Patient's List</span></a>
                        </li>
                        <li class="submenu">
							<a href="#"><i class="fa fa-flag-o"></i> <span> Notice </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a class="{{ Route::is('notice.page') ? 'active' : '' }}" href="{{route('notice.page')}}"><i class="fa fa-envelope-o" aria-hidden="true"></i><span>Add Notice </span></a></li>
							</ul>
						</li>
                        <li class="submenu">
							<a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> <span> Settings </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a class="{{ Route::is('admin.change.password') ? 'active' : '' }}" href="{{route('admin.change.password')}}"><i class="fa fa-thermometer-full" aria-hidden="true"></i> <span>Change Password</span> </a></li>
                                <li><a class="{{ Route::is('admin.logout') ? 'active' : '' }}" href="{{route('admin.logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></a></li>
							</ul>
						</li>
                    
                    </ul>
                </div>
            </div>
        </div>