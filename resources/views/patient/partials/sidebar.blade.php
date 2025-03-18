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
                <h3><a href="doctor-profile.html">{{ ucwords(Auth::guard('patients')->user()->name) }}</a></h3>
                <span class="badge doctor-role-badge"><i class="fa-solid fa-circle"></i>Patient</span>
            </div>
        </div>
    </div>
    <hr>
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                <li class="{{ request()->routeIs('patient.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('patient.dashboard') }}">
                        <i class="fa-solid fa-shapes"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('patient.appointments.index') ? 'active' : '' }}">
                    <a href="{{ route('patient.appointments.index') }}">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>Upcoming Appointments</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('patient.appointments.history') ? 'active' : '' }}">
                    <a href="{{ route('patient.appointments.history') }}">
                        <i class="fa-regular fa-calendar"></i>
                        <span>Appointment History</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('patient.family.index') ? 'active' : '' }}">
                    <a href="{{ route('patient.family.index') }}">
                        <i class="fa-solid fa-users"></i>
                        <span>Family Members</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('patient.invoices.index') ? 'active' : '' }}">
                    <a href="{{ route('patient.invoices.index') }}">
                        <i class="fa-solid fa-file-lines"></i>
                        <span>Invoices</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('patient.perscription.index') ? 'active' : '' }}">
                    <a href="{{ route('patient.perscription.index') }}">
                        <i class="fa-solid fa-file-contract"></i>
                        <span>Perscriptions</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('patient.logout') ? 'active' : '' }}">
                    <a href="{{ route('patient.logout') }}">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
