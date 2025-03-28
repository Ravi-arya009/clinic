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

        @include('super_admin.partials.header')

        <!-- Page Content -->
        <div class="login-content-info">
            <div class="container">
                <!-- Email -->
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="account-content">
                            <div class="login-shapes">
                                <div class="shape-img-left">
                                    <img src={{ asset('img/shape-01.png') }} alt="shape-image">
                                </div>
                                <div class="shape-img-right">
                                    <img src={{ asset('img/shape-02.png') }} alt="shape-image">
                                </div>
                            </div>
                            <div class="account-info">
                                <div class="login-title text-center">
                                    <h3>Super Admin Login</h3>
                                    <p>Enter your credentials to continue.</p>
                                </div>
                                <form action="{{ route('super_admin.login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control floating" id="phone" name="phone" placeholder="Enter your mobile number" required>
                                    </div>
                                    <div class="mb-3">
                                        <div class="pass-group">
                                            <input type="password" class="form-control pass-input" id="password" name="password" placeholder="Enter your password" required>
                                            <span class="feather-eye-off toggle-password"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn w-100" type="submit">Sign in</button>
                                    </div>
                                </form>
                                <x-Alert />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Email -->
            </div>
        </div>

        <!-- /Page Content -->

        <!-- Cursor -->
        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>
        <!-- /Cursor -->
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

    <x-sweetAlert />

</body>

</html>
