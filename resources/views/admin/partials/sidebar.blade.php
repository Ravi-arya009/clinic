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
                <h3><a href="doctor-profile.html">{{ auth()->guard('admin')->user()->name }}</a></h3>
                <span class="badge doctor-role-badge"><i class="fa-solid fa-circle"></i>Admin</span>
            </div>
        </div>
    </div>
    <hr>
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa-solid fa-shapes"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.user.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.create') }}">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Create User</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.user.index', 'admin.user.show') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.index') }}">
                        <i class="fa-solid fa-users"></i>
                        <span>User List</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.time_slots.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.time_slots.index') }}">
                        <i class="fa-solid fa-calendar-day"></i>
                        <span>Available Timings</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.appointments.index', 'admin.appointment.show') ? 'active' : '' }}">
                    <a href="{{ route('admin.appointments.index') }}">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>Appointments</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.medicines.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.medicines.index') }}">
                        <i class="fa-duotone fa-solid fa-capsules"></i>
                        <span>Medicines</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
