<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The responsive professional Doccure template offers many features, like scheduling appointments with  top doctors, clinics, and hospitals via voice, video call & chat.">
    <meta name="keywords" content="practo clone, doccure, doctor appointment, Practo clone html template, doctor booking template">
    <meta name="author" content="Practo Clone HTML Template - Doctor Booking Template">
    <meta property="og:url" content="https://doccure.dreamstechnologies.com/html/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Doctors Appointment HTML Website Templates | Doccure">
    <meta property="og:description" content="The responsive professional Doccure template offers many features, like scheduling appointments with  top doctors, clinics, and hospitals via voice, video call & chat.">
    <meta property="og:image" content={{ asset('img/preview-banner.jpg') }}>
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="https://doccure.dreamstechnologies.com/html/">
    <meta property="twitter:url" content="https://doccure.dreamstechnologies.com/html/">
    <meta name="twitter:title" content="Doctors Appointment HTML Website Templates | Doccure">
    <meta name="twitter:description" content="The responsive professional Doccure template offers many features, like scheduling appointments with  top doctors, clinics, and hospitals via voice, video call & chat.">
    <meta name="twitter:image" content={{ asset('img/preview-banner.jpg') }}>
    <title>Doccure</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href={{ asset('img/favicon.png') }} type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}>

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href={{ asset('plugins/fontawesome/css/fontawesome.min.css') }}>
    <link rel="stylesheet" href={{ asset('plugins/fontawesome/css/all.min.css') }}>

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href={{ asset('css/feather.css') }}>

    <!-- Main CSS -->
    <link rel="stylesheet" href={{ asset('css/custom.css') }}>

</head>

<body class="login-body">

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        @include('receptionist.partials.header')

        <!-- Page Content -->
        <div class="content top-space">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-8 offset-md-2">

                        <!-- Login Tab Content -->
                        <div class="account-content">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-7 col-lg-6 login-left">
                                    <img src={{ asset('img/login-banner.png') }} class="img-fluid" alt="Doccure Login">
                                </div>
                                <div class="col-md-12 col-lg-6 login-right">
                                    <div class="login-header">
                                        <h3>Login <span>Doccure</span></h3>
                                    </div>
                                    <form action="{{ route('receptionist.authenticate') }}" method="POST">
                                        @csrf
                                        <div class="mb-3 form-focus">
                                            <input type="text" class="form-control floating" id="phone" name="phone" required>
                                            <label class="focus-label">Phone Number</label>
                                        </div>
                                        <div class="mb-3 form-focus">
                                            <input type="password" class="form-control floating" id="password" name="password" required>
                                            <label class="focus-label">Password</label>
                                        </div>
                                        <div class="text-end">
                                            <a class="forgot-link" href="forgot-password.html">Forgot Password ?</a>
                                        </div>
                                        <button class="btn btn-primary w-100 btn-lg login-btn" type="submit">Login</button>
                                        @if ($errors->any())
                                            <div class="login-or">
                                                <span class="or-line"></span>
                                            </div>
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if (session('success'))
                                            <div class="login-or">
                                                <span class="or-line"></span>
                                            </div>
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        <div class="text-center dont-have">Don’t have an account? <a href="{{ route('patient.register') }}">Register</a></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Login Tab Content -->

                    </div>
                </div>

            </div>

        </div>
        <!-- /Page Content -->



        <!-- Cursor -->
        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>
        <!-- /Cursor -->

        <!-- Footer -->
        <footer class="footer footer-one">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="footer-widget footer-about">
                                <div class="footer-logo">
                                    <a href="index.html"><img src={{ asset('img/logo.png') }} alt="logo"></a>
                                </div>
                                <div class="footer-about-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="footer-widget footer-menu">
                                        <h2 class="footer-title">For Patients</h2>
                                        <ul>
                                            <li><a href="search.html">Search for Doctors</a></li>
                                            <li><a href="login.html">Login</a></li>
                                            <li><a href="register.html">Register</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4">
                                    <div class="footer-widget footer-menu">
                                        <h2 class="footer-title">For Doctors</h2>
                                        <ul>
                                            <li><a href="appointments.html">Appointments</a></li>
                                            <li><a href="chat.html">Chat</a></li>
                                            <li><a href="login.html">Login</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4">
                                    <div class="footer-widget footer-contact">
                                        <h2 class="footer-title">Contact Us</h2>
                                        <div class="footer-contact-info">
                                            <div class="footer-address">
                                                <p><i class="feather-map-pin"></i> 3556 Beech Street, USA</p>
                                            </div>
                                            <div class="footer-address">
                                                <p><i class="feather-phone-call"></i> +1 315 369 5943</p>
                                            </div>
                                            <div class="footer-address mb-0">
                                                <p><i class="feather-mail"></i> doccure@example.com</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-7">
                            <div class="footer-widget">
                                <h2 class="footer-title">Join Our Newsletter</h2>
                                <div class="subscribe-form">
                                    <form action="#">
                                        <input type="email" class="form-control" placeholder="Enter Email">
                                        <button type="submit" class="btn">Submit</button>
                                    </form>
                                </div>
                                <div class="social-icon">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fab fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fab fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <!-- Copyright -->
                    <div class="copyright">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="copyright-text">
                                    <p class="mb-0"> Copyright © 2024 <a href="https://themeforest.net/user/dreamstechnologies/portfolio" target="_blank">Dreamstechnologies.</a> All Rights Reserved</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">

                                <!-- Copyright Menu -->
                                <div class="copyright-menu">
                                    <ul class="policy-menu">
                                        <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                        <li><a href="terms-condition.html">Terms and Conditions</a></li>
                                    </ul>
                                </div>
                                <!-- /Copyright Menu -->

                            </div>
                        </div>
                    </div>
                    <!-- /Copyright -->
                </div>
            </div>
        </footer>
        <!-- /Footer -->
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src={{ asset('js/jquery-3.7.1.min.js') }}></script>

    <!-- Bootstrap Bundle JS -->
    <script src={{ asset('js/bootstrap.bundle.min.js') }}></script>

    <!-- Feather Icon JS -->
    <script src={{ asset('js/feather.min.js') }}></script>

    <!-- Custom JS -->
    <script src={{ asset('js/script.js') }}></script>

</body>

</html>
