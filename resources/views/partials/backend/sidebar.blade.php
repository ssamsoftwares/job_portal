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
                    <a href="{{ route('admin.dashboard') }}"
                        class="dropdown-toggle no-arrow {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>


                @role('superadmin')
                    <li class="dropdown">
                        <a href="{{ route('admin.employers') }}"
                            class="dropdown-toggle no-arrow {{ request()->is('admin/employers') ? 'active' : '' }}">
                            <span class="micon dw dw-house-1"></span><span class="mtext">Employer</span>
                        </a>
                    </li>

                    <li class="dropdown">
						<a href="{{route('admin.candidates')}}" class="dropdown-toggle no-arrow {{ request()->is('admin/candidate*') ? 'active' : '' }}">
							<span class="micon dw dw-house-1"></span><span class="mtext">Candidate</span>
						</a>
					</li>


                    <li class="dropdown {{ request()->is('admin/job*') ? 'show' : '' }}">
                        <a href="javascript:void(0);"
                            class="dropdown-toggle {{ request()->is('admin/job*') ? 'active' : '' }}">
                            <span class="micon dw dw-user"></span><span class="mtext">Jobs</span>
                        </a>
                        <ul class="submenu" style="display: {{ request()->is('admin/job*') ? 'block' : 'none' }}">
                            <li><a href="{{ route('admin.jobPost') }}"
                                    class="{{ request()->is('admin/job-list') ? 'active' : '' }}">Jobs List
                                </a></li>

                            <li><a class="{{ request()->is('admin/job-category*') ? 'active' : '' }}"
                                    href="{{ route('admin.jobCategory') }}">Job Category</a></li>

                            <li><a class="{{ request()->is('admin/job-role*') ? 'active' : '' }}"
                                    href="{{ route('admin.jobRole') }}">Job Role</a></li>
                        </ul>
                    </li>


                    <li class="dropdown {{ request()->is('admin/skill*') ? 'show' : '' }}">
                        <a href="javascript:void(0);"
                            class="dropdown-toggle {{ request()->is('admin/skill*') ? 'active' : '' }}">
                            <span class="micon dw dw-user"></span><span class="mtext">Attributes </span>
                        </a>

                        <ul class="submenu" style="display: {{ request()->is('admin/skill*') ? 'block' : 'none' }}">
                            <li><a href="{{ route('admin.skills') }}"
                                    class="{{ request()->is('admin/skill') ? 'active' : '' }}">Skills
                                </a></li>

                            <li><a class="{{ request()->is('admin/tag*') ? 'active' : '' }}"
                                    href="{{ route('admin.tags') }}">Tag List</a></li>

                            <li><a class="{{ request()->is('admin/industry-type*') ? 'active' : '' }}" href="{{route('admin.industryTypes')}}">Industry Type</a></li>

                            <li><a class="{{ request()->is('admin/profession*') ? 'active' : '' }}" href="{{route('admin.professions')}}">Profession</a></li>

                            <li><a class="{{ request()->is('admin/language*') ? 'active' : '' }}" href="{{route('admin.language')}}">Language</a></li>

                            <li><a class="{{ request()->is('admin/education*') ? 'active' : '' }}" href="{{route('admin.educations')}}">Education</a></li>

                            <li><a class="{{ request()->is('admin/experience*') ? 'active' : '' }}" href="{{route('admin.experiences')}}">Experience</a></li>

                            <li><a class="{{ request()->is('admin/organization-type*') ? 'active' : '' }}" href="{{route('admin.organizationTypes')}}">OrganizationType</a></li>

                            <li><a class="{{ request()->is('admin/salary-type*') ? 'active' : '' }}" href="{{route('admin.salaryTypes')}}">Salary Type</a></li>

                            <li><a class="{{ request()->is('admin/team-size*') ? 'active' : '' }}" href="{{route('admin.teamSize')}}">Team Size</a></li>


                        </ul>
                    </li>


                @endrole


                @role('employer')
                    <li class="dropdown">
                        <a href="{{ route('employer.settings') }}"
                            class="dropdown-toggle no-arrow {{ request()->is('employer/settings') ? 'active' : '' }}">
                            <span class="micon dw dw-house-1"></span><span class="mtext">Settings</span>
                        </a>
                    </li>
                @endrole



            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
