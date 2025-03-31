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
                <h3><a href="doctor-profile.html">{{ auth()->guard('staff')->user()->name }}</a></h3>
                <span class="badge doctor-role-badge"><i class="fa-solid fa-circle"></i>Staff</span>
            </div>
        </div>
    </div>
    <hr>
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                <li class="{{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('staff.dashboard') }}">
                        <i class="fa-solid fa-shapes"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('staff.appointments.index', 'staff.appointment.show') ? 'active' : '' }}">
                    <a href="{{ route('staff.appointments.index') }}">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>Upcoming Appointments</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('staff.appointments.history') ? 'active' : '' }}">
                    <a href="{{ route('staff.appointments.history') }}">
                        <i class="fa-regular fa-calendar"></i>
                        <span>Appointment History</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
