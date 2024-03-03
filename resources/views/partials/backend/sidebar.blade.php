<div class="left-side-bar">
		<div class="brand-logo">
			<a href="admin/dashboard">
				{{-- <img src="{{asset('assets/vendors/images/deskapp-logo.svg')}}" alt="" class="dark-logo">
				<img src="{{asset('assets/vendors/images/deskapp-logo-white.svg')}}" alt="" class="light-logo"> --}}
                <h5 class="text-light">SuperAdmin Panel</h5>
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>


		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="dropdown">
						<a href="{{route('admin.dashboard')}}" class="dropdown-toggle no-arrow {{ request()->is('admin/dashboard') ? 'active' : '' }}">
							<span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
						</a>
					</li>


                    @role('superadmin')
                    <li class="dropdown">
                        <a href="javascript:void(0);"
                            class="dropdown-toggle">

                            <span class="micon dw dw-align-left"></span><span class="mtext">Manage Role</span>
                        </a>
                        <ul class="submenu">

                                <li><a href="" class=""></a>Page1</li>
                                <li><a href="" class=""></a>Page2</li>

                        </ul>
                    </li>
                    @endrole


                    @role('employer')
                    <li class="dropdown">
						<a href="{{route('employer.settings')}}" class="dropdown-toggle no-arrow {{ request()->is('employer/settings') ? 'active' : '' }}">
							<span class="micon dw dw-house-1"></span><span class="mtext">Settings</span>
						</a>
					</li>

                    @endrole



				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>
