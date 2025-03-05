<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Doccure - Healthcare Made Simple')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Doccure provides a seamless healthcare experience with features to schedule appointments with top specialists, access virtual consultations, and manage your medical records all in one place.">
    <meta name="keywords" content="doctor appointment, medical booking, telemedicine, healthcare platform, find doctors, online consultation, medical records, patient portal, specialist consultation">
    <meta name="author" content="Doccure Healthcare Solutions">
    <meta property="og:url" content="https://doccure.dreamstechnologies.com/html/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Doccure - Your Complete Healthcare Solution">
    <meta property="og:description" content="Connect with leading healthcare providers, schedule appointments, access telemedicine services, and manage your medical records through Doccure's comprehensive healthcare platform.">
    <meta property="og:image" content={{ asset('img/preview-banner.jpg') }}>
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="https://doccure.dreamstechnologies.com/html/">
    <meta property="twitter:url" content="https://doccure.dreamstechnologies.com/html/">
    <meta name="twitter:title" content="Doccure - Modern Healthcare at Your Fingertips">
    <meta name="twitter:description" content="Experience healthcare reimagined with Doccure's innovative platform offering appointment scheduling, video consultations, prescription management, and personalized care from top medical professionals.">
    <meta name="twitter:image" content={{ asset('img/preview-banner.jpg') }}>

    <link href={{ asset('img/favicon.png') }} rel="icon"> <!-- Favicons -->
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}> <!-- Bootstrap CSS -->
    <link rel="stylesheet" href={{ asset('plugins/fontawesome/css/fontawesome.min.css') }}> <!-- Fontawesome CSS -->
    <link rel="stylesheet" href={{ asset('plugins/fontawesome/css/all.min.css') }}> <!-- Fontawesome CSS -->
    <link rel="stylesheet" href={{ asset('css/feather.css') }}> <!-- Feathericon CSS -->
    @stack('stylesheets') <!-- Inject stylesheets -->
    <link rel="stylesheet" href={{ asset('css/custom.css') }}> <!-- Main CSS -->
</head>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        @include('super_admin.partials.header') <!-- Including Header -->
        <!-- Breadcrumb -->
        <div class="breadcrumb-bar-two">
            <div class="container">
                <div class="row align-items-center inner-banner">
                    <div class="col-md-12 col-12 text-center">
                        <h2 class="breadcrumb-title">@yield('breadcrum-title', 'Admin')</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">@yield('breadcrum-link-one', 'Home')</a></li>
                                <li class="breadcrumb-item" aria-current="page">@yield('breadcrum-link-two', 'Home')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->
        <!-- Page Content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-xl-3 theiaStickySidebar">
                        @include('super_admin.partials.sidebar') <!-- Including Sidebar -->
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        {{-- always start the content section with a row --}}
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        @include('super_admin.partials.footer') <!-- Including Footer -->
    </div>
    <!-- /Main Wrapper -->

    @yield('modal') <!-- Inject Modals -->

    <script src={{ asset('js/jquery-3.7.1.min.js') }}></script> <!-- jQuery -->
    <script src={{ asset('js/bootstrap.bundle.min.js') }}></script> <!-- Bootstrap Core JS -->
    <script src={{ asset('plugins/theia-sticky-sidebar/ResizeSensor.js') }}></script> <!-- Sticky Sidebar JS -->
    <script src={{ asset('plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}></script> <!-- Sticky Sidebar JS -->
    @stack('scripts') <!-- Inject Scripts -->
    <script src={{ asset('js/script.js') }}></script> <!-- Custom JS -->
</body>

</html>
