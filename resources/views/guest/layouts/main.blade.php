<!DOCTYPE html>
<html lang="zxx">

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
    <title>@yield('title', 'Doccure')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href={{ asset('img/favicon.png') }} type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}>

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href={{ asset('plugins/fontawesome/css/fontawesome.min.css') }}>
    <link rel="stylesheet" href={{ asset('plugins/fontawesome/css/all.min.css') }}>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href={{ asset('css/feather.css') }}>

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href={{ asset('css/owl.carousel.min.css') }}>

    <!-- Animation CSS -->
    <link rel="stylesheet" href={{ asset('css/aos.css') }}>

    <!-- injecting custom stylesheets before custom.css -->
    @stack('stylesheets')

    <!-- Main CSS -->
    <link rel="stylesheet" href={{ asset('css/custom.css') }}>

</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper home-one">

        <!--Navbar -->
        @include('guest.partials.navbar')

        <!--Content Goes Here -->
        @yield('content')

        <!--Footer -->
        @include('guest.partials.footer')

        <!-- Cursor -->
        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>
        <!-- /Cursor -->
    </div>
    <!-- /Main Wrapper -->

    <!-- ScrollToTop -->
    <div class="progress-wrap active-progress">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919px, 307.919px; stroke-dashoffset: 228.265px;"></path>
        </svg>
    </div>
    <!-- /ScrollToTop -->

    <!-- jQuery -->
    <script src={{ asset('js/jquery-3.7.1.min.js') }}></script>

    <!-- Bootstrap Bundle JS -->
    <script src={{ asset('js/bootstrap.bundle.min.js') }}></script>

    <!-- Feather Icon JS -->
    <script src={{ asset('js/feather.min.js') }}></script>

    <!-- Owl Carousel JS -->
    <script src={{ asset('js/owl.carousel.min.js') }}></script>

    <!-- Slick JS -->
    <script src={{ asset('js/slick.js') }}></script>

    <!-- Animation JS -->
    <script src={{ asset('js/aos.js') }}></script>

    <!-- BacktoTop JS -->
    <script src={{ asset('js/backToTop.js') }}></script>

    <!-- select JS -->
    <script src={{ asset('plugins/select2/js/select2.min.js') }}></script>

    <!-- injecting custom scripts before script.js -->
    @stack('scripts')

    <!-- Custom JS -->
    <script src={{ asset('js/script.js') }}></script>

</body>

</html>
