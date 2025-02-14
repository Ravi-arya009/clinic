<div class="profile-sidebar doctor-sidebar profile-sidebar-new">
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
            <a href="doctor-profile.html" class="booking-doc-img">
                <img src={{ asset('img/doctors-dashboard/doctor-profile-img.jpg') }} alt="User Image">
            </a>
            <div class="profile-det-info">
                <h3><a href="doctor-profile.html">{{ucwords(Auth::guard('patients')->user()->name)}}</a></h3>
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
                    <a href="{{route('patient.appointments.index')}}">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>Upcoming Appointments</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('patient.appointments.history') ? 'active' : '' }}">
                    <a href="{{route('patient.appointments.history')}}">
                        <i class="fa-regular fa-calendar"></i>
                        <span>Appointment History</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('patient.family.index') ? 'active' : '' }}">
                    <a href="{{route('patient.family.index')}}">
                        <i class="fa-solid fa-users"></i>
                        <span>Family Members</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('patient.invoices.index') ? 'active' : '' }}">
                    <a href="{{route('patient.invoices.index')}}">
                        <i class="fa-solid fa-file-lines"></i>
                        <span>Invoices</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('patient.perscription.index') ? 'active' : '' }}">
                    <a href="{{route('patient.perscription.index')}}">
                        <i class="fa-solid fa-file-contract"></i>
                        <span>Perscriptions</span>
                    </a>
                </li>

                {{-- send to clinic search page --}}
                <li class="{{ request()->routeIs('patient.clinics') ? 'active' : '' }}">
                    <a href="{{route('patient.clinics')}}">
                        <i class="fa-solid fa-house-chimney-medical"></i>
                        <span>Clinics</span>
                    </a>
                </li>
                {{-- send to doctor search page --}}
                <li class="{{ request()->routeIs('patient.doctors.index') ? 'active' : '' }}">
                    <a href="{{route('patient.doctors.index')}}">
                        <i class="fa-solid fa-user-doctor"></i>
                        <span>Doctors</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('patient.logout') ? 'active' : '' }}">
                    <a href="{{route('patient.logout')}}">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
