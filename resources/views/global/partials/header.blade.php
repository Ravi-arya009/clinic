<header class="header header-custom header-fixed header-one">
    <div class="container">
        <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <!-- Brand Logo -->
                <a href="{{ route($userRolePrefix . '.dashboard') }}" class="navbar-brand logo">
                    <img src={{ asset('img/logo.png') }} class="img-fluid" alt="Logo">
                </a>
                <!-- /Brand Logo -->
            </div>
            @if (isset($loggedInUser))
                <ul class="nav header-navbar-rht">
                    <!-- Notifications -->
                    <li class="nav-item dropdown noti-nav me-3 pe-0">
                        <a href="#" class="dropdown-toggle nav-link p-0" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-bell"></i> <span class="badge">5</span>
                        </a>
                        <div class="dropdown-menu notifications dropdown-menu-end ">
                            <div class="topnav-dropdown-header">
                                <span class="notification-title">Notifications</span>
                            </div>
                            <div class="noti-content">
                                <ul class="notification-list">
                                    <li class="notification-message">
                                        <a href="#">
                                            <div class="notify-block d-flex">
                                                <span class="avatar">
                                                    <img class="avatar-img" alt="Ruby perin" src={{ asset('img/clients/client-01.jpg') }}>
                                                </span>
                                                <div class="media-body">
                                                    <h6>Travis Tremble <span class="notification-time">18.30 PM</span></h6>
                                                    <p class="noti-details">Sent a amount of $210 for his Appointment <span class="noti-title">Dr.Ruby perin </span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="notification-message">
                                        <a href="#">
                                            <div class="notify-block d-flex">
                                                <span class="avatar">
                                                    <img class="avatar-img" alt="Hendry Watt" src={{ asset('img/clients/client-02.jpg') }}>
                                                </span>
                                                <div class="media-body">
                                                    <h6>Travis Tremble <span class="notification-time">12 Min Ago</span></h6>
                                                    <p class="noti-details"> has booked her appointment to <span class="noti-title">Dr. Hendry Watt</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="notification-message">
                                        <a href="#">
                                            <div class="notify-block d-flex">
                                                <div class="avatar">
                                                    <img class="avatar-img" alt="Maria Dyen" src={{ asset('img/clients/client-03.jpg') }}>
                                                </div>
                                                <div class="media-body">
                                                    <h6>Travis Tremble <span class="notification-time">6 Min Ago</span></h6>
                                                    <p class="noti-details"> Sent a amount $210 for his Appointment <span class="noti-title">Dr.Maria Dyen</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="notification-message">
                                        <a href="#">
                                            <div class="notify-block d-flex">
                                                <div class="avatar avatar-sm">
                                                    <img class="avatar-img" alt="client-image" src={{ asset('img/clients/client-04.jpg') }}>
                                                </div>
                                                <div class="media-body">
                                                    <h6>Travis Tremble <span class="notification-time">8.30 AM</span></h6>
                                                    <p class="noti-details"> Send a message to his doctor</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- /Notifications -->
                    <!-- User Menu -->
                    <li class="nav-item dropdown has-arrow logged-item">
                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <span class="user-img">
                                @if (isset($loggedInUser->profile_image))
                                    <img class="rounded-circle" src="{{ asset('storage/profile_images/' . $loggedInUser->profile_image) }}" alt="Profile Picture">
                                @else
                                    <img class="rounded-circle" src={{ asset('storage/profile_images/default-profile-picture.webp') }} width="31" alt="User Image">
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    @if (isset($loggedInUser->profile_image))
                                        <img src="{{ asset('storage/profile_images/' . $loggedInUser->profile_image) }}" alt="User Image" class="avatar-img rounded-circle">
                                    @else
                                        <img src={{ asset('storage/profile_images/default-profile-picture.webp') }} alt="User Image" class="avatar-img rounded-circle">
                                    @endif
                                </div>
                                <div class="user-text">
                                    <h6>{{ $loggedInUser->name }}</h6>
                                    <p class="text-success mb-0">{{ $userRole }}</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route($userRolePrefix . '.dashboard') }}">Dashboard</a>
                            <a class="dropdown-item" href="{{ route($userRolePrefix . '.profile.show') }}">Profile Settings</a>
                            <a class="dropdown-item" href="{{ route($userRolePrefix . '.logout') }}">Logout</a>
                        </div>
                    </li>
                    <!-- /User Menu -->
                </ul>
            @endif
        </nav>
    </div>
</header>
