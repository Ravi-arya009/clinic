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
                <h3><a href="doctor-profile.html">{{ auth()->guard('doctor')->user()->name }}</a></h3>
                <span class="badge doctor-role-badge"><i class="fa-solid fa-circle"></i>Doctor</span>
            </div>
        </div>
    </div>
    <hr>
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                <li class="{{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('doctor.dashboard') }}">
                        <i class="fa-solid fa-shapes"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('doctor.patient.create') ? 'active' : '' }}">
                    <a href="{{ route('doctor.patient.create') }}">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Create Patient</span>
                    </a>
                </li>


                <li class="{{ request()->routeIs('doctor.patient.index', 'doctor.patient.show') ? 'active' : '' }}">
                    <a href="{{ route('doctor.patient.index') }}">
                        <i class="fa-solid fa-user-injured"></i>
                        <span>My Patients</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('doctor.appointments.index', 'doctor.appointment.show') ? 'active' : '' }}">
                    <a href="{{ route('doctor.appointments.index') }}">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>Upcoming Appointments</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('doctor.appointments.history') ? 'active' : '' }}">
                    <a href="{{ route('doctor.appointments.history') }}">
                        <i class="fa-regular fa-calendar"></i>
                        <span>Appointment History</span>
                    </a>
                </li>


                <li class="{{ request()->routeIs('doctor.time_slots.index') ? 'active' : '' }}">
                    <a href="{{ route('doctor.time_slots.index') }}">
                        <i class="fa-solid fa-calendar-day"></i>
                        <span>Time Slots</span>
                    </a>
                </li>



                {{-- <li class="{{ request()->routeIs('#') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa-duotone fa-solid fa-capsules"></i>
                        <span>Medicines</span>
                    </a>
                </li> --}}
            </ul>
        </nav>
    </div>
</div>
