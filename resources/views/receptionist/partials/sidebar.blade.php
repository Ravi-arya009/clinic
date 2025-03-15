<div class="profile-sidebar doctor-sidebar profile-sidebar-new">
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
            <a href="doctor-profile.html" class="booking-doc-img">
                <img src={{ asset('img/doctors-dashboard/doctor-profile-img.jpg') }} alt="User Image">
            </a>
            <div class="profile-det-info">
                <h3><a href="doctor-profile.html">{{ auth()->guard('receptionist')->user()->name }}</a></h3>
                <span class="badge doctor-role-badge"><i class="fa-solid fa-circle"></i>Receptionist</span>
            </div>
        </div>
    </div>
    <hr>
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                <li class="{{ request()->routeIs('receptionist.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('receptionist.dashboard') }}">
                        <i class="fa-solid fa-shapes"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
