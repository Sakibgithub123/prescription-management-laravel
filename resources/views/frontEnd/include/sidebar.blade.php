<div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="{{Route::is('get.home')? 'active' : ''}}">
                            <a href="{{route('get.home')}}"><i class="fa fa-home"></i> <span>Home</span></a>
                        </li>
                        
						<li class="{{Route::is('profile')? 'active' : ''}}">
                            <a href="{{route('profile')}}"><i class="fa fa-user-md"></i> <span>Profile</span></a>
                        </li>
                        <li class="{{Route::is('patientdetails')? 'active' : ''}}">
                            <a href="{{route('patientdetails')}}"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                        </li>
                        <li class="{{Route::is('prescription')? 'active' : ''}}">
                            <a href="{{route('prescription')}}"><i class="fa fa-calendar"></i> <span>Make Prescription</span></a>
                        </li>
                        <li class="{{Route::is('doctor.statistics')? 'active' : ''}}">
                            <!-- //prablm -->
                            <a href="{{route('doctor.statistics')}}"><i class="fa fa-dashboard"></i> <span>My Statistics</span></a>
                        </li>
                      
                        <li class="submenu">
							<a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> <span> Settings </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
                            <li> <a class="{{Route::is('userchangePassword.page')? 'active' : ''}}" href="{{route('userchangePassword.page')}}"><i class="fa fa-thermometer-full" aria-hidden="true"></i> <span>Change Password</span></a></li>
                           
                                <li><a href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i></i> <span>LogOut</span> </a></li>
                                
							</ul>
						</li>
					
                    </ul>
                </div>
            </div>
        </div>