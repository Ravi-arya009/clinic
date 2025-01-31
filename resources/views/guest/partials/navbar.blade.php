<header class="header header-custom header-fixed header-one home-head-one">
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
                <a href="{{ route('index') }}" class="navbar-brand logo">
                    <img src={{ asset('img/logo-01.svg') }} class="img-fluid" alt="Logo">
                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="index.html" class="menu-logo">
                        <img src={{ asset('img/logo-01.svg') }} class="img-fluid" alt="Logo">
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                <ul class="main-nav">
                    <li class="active">
                        <a href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);">About Us</a>
                    </li>
                    <li class="">
                        <a href="#our-clinics">Clinics</a>
                    </li>
                    <li class="">
                        <a href="#our-doctors">Doctors</a>
                    </li>
                </ul>
            </div>
            @if (auth()->guard('patients')->check())
                <ul class="nav header-navbar-rht">
                    <li class="register-btn">
                        <a href="#" class="btn btn-primary log-btn"><span class="px-3">Hi, {{ ucfirst(auth()->guard('patients')->user()->name) }}</span></a>
                    </li>
                </ul>
            @else
                <ul class="nav header-navbar-rht">
                    <li class="register-btn">
                        <a href="{{ route('patient.register') }}" class="btn reg-btn"><i class="feather-user"></i>Register</a>
                    </li>
                    <li class="register-btn">
                        <a href="{{ route('patient.login') }}" class="btn btn-primary log-btn"><i class="feather-lock"></i>Login</a>
                    </li>
                </ul>
            @endif

        </nav>
    </div>
</header>
