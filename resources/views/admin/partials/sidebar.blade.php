<div class="profile-sidebar doctor-sidebar profile-sidebar-new">
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
            <a href="doctor-profile.html" class="booking-doc-img">
                <img src={{ asset('img/doctors-dashboard/doctor-profile-img.jpg') }} alt="User Image">
            </a>
            <div class="profile-det-info">
                <h3><a href="doctor-profile.html">Suraj Kumar</a></h3>
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

                <li class="{{ request()->routeIs('admin.user.index','admin.user.show') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.index') }}">
                        <i class="fa-solid fa-users"></i>
                        <span>User List</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.user.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.create') }}">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Create User</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.available_timings') ? 'active' : '' }}">
                    <a href="{{ route('admin.available_timings') }}">
                        <i class="fa-solid fa-calendar-day"></i>
                        <span>Available Timings</span>
                    </a>
                </li>

                <li>
                    <a href="doctor-request.html">
                        <i class="fa-solid fa-calendar-check"></i>
                        <span>Requests</span>
                        <small class="unread-msg">2</small>
                    </a>
                </li>
                <li>
                    <a href="appointments.html">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="available-timings.html">
                        <i class="fa-solid fa-calendar-day"></i>
                        <span>Available Timings</span>
                    </a>
                </li>

                <li>
                    <a href="doctor-specialities.html">
                        <i class="fa-solid fa-clock"></i>
                        <span>Specialties & Services</span>
                    </a>
                </li>
                <li>
                    <a href="reviews.html">
                        <i class="fas fa-star"></i>
                        <span>Reviews</span>
                    </a>
                </li>
                <li>
                    <a href="accounts.html">
                        <i class="fa-solid fa-file-contract"></i>
                        <span>Accounts</span>
                    </a>
                </li>
                <li>
                    <a href="invoices.html">
                        <i class="fa-solid fa-file-lines"></i>
                        <span>Invoices</span>
                    </a>
                </li>
                <li>
                    <a href="doctor-payment.html">
                        <i class="fa-solid fa-money-bill-1"></i>
                        <span>Payout Settings</span>
                    </a>
                </li>
                <li>
                    <a href="chat-doctor.html">
                        <i class="fa-solid fa-comments"></i>
                        <span>Message</span>
                        <small class="unread-msg">7</small>
                    </a>
                </li>
                <li>
                    <a href="doctor-profile-settings.html">
                        <i class="fa-solid fa-user-pen"></i>
                        <span>Profile Settings</span>
                    </a>
                </li>
                <li>
                    <a href="social-media.html">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Social Media</span>
                    </a>
                </li>
                <li>
                    <a href="doctor-change-password.html">
                        <i class="fa-solid fa-key"></i>
                        <span>Change Password</span>
                    </a>
                </li>
                <li>
                    <a href="login.html">
                        <i class="fa-solid fa-calendar-check"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
