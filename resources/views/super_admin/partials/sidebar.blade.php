<div class="profile-sidebar doctor-sidebar profile-sidebar-new">
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
            <a href="doctor-profile.html" class="booking-doc-img">
                @if (isset($loggedInUser->profile_image))
                    <img src="{{ asset('storage/profile_images/' . $loggedInUser->profile_image) }}" alt="Profile Picture">
                @else
                    <img src={{ asset('storage/profile_images/default-profile-picture.webp') }} alt="User Image">
                @endif
            </a>
            <div class="profile-det-info">
                <h3><a href="doctor-profile.html">{{ auth()->guard('super_admin')->user()->name }}</a></h3>
                <span class="badge doctor-role-badge"><i class="fa-solid fa-circle"></i>Super Admin</span>
            </div>
        </div>
    </div>
    <hr>
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                <li class="{{ request()->routeIs('super_admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('super_admin.dashboard') }}">
                        <i class="fa-solid fa-shapes"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('super_admin.clinic.create') ? 'active' : '' }}">
                    <a href="{{ route('super_admin.clinic.create') }}">
                        <i class="fa-solid fa-house-chimney-medical"></i>
                        <span>Create Clinic</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs(['super_admin.clinic.index', 'super_admin.clinic.show']) ? 'active' : '' }}">
                    <a href="{{ route('super_admin.clinic.index') }}">
                        <i class="fa-solid fa-list"></i>
                        <span>Clinic List</span>
                    </a>
                </li>

                <hr>

                <li class="{{ request()->routeIs('super_admin.state.index') ? 'active' : '' }}">
                    <a href="{{ route('super_admin.state.index') }}">
                        <i class="fa-solid fa-mountain-city"></i>
                        <span>States</span>
                    </a>
                </li>

                <li class="">
                    <a href="#">
                        <i class="fa-solid fa-city"></i>
                        <span>Cities</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('super_admin.speciality.index') ? 'active' : '' }}">
                    <a href="{{ route('super_admin.speciality.index') }}">
                        <i class="fa-solid fa-mountain-city"></i>
                        <span>Speciality</span>
                    </a>
                </li>

                <hr>

                <li>
                    <a href="{{ route('super_admin.logout') }}">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</div>
