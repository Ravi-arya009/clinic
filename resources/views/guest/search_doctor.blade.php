<!DOCTYPE html>
<html lang="en">


<head>

	<meta charset="utf-8">
	<title>Doccure</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="The responsive professional Doccure template offers many features, like scheduling appointments with  top doctors, clinics, and hospitals via voice, video call & chat.">
	<meta name="keywords" content="practo clone, doccure, doctor appointment, Practo clone html template, doctor booking template">
	<meta name="author" content="Practo Clone HTML Template - Doctor Booking Template">
	<meta property="og:url" content="https://doccure.dreamstechnologies.com/html/">
	<meta property="og:type" content="website">
	<meta property="og:title" content="Doctors Appointment HTML Website Templates | Doccure">
	<meta property="og:description" content="The responsive professional Doccure template offers many features, like scheduling appointments with  top doctors, clinics, and hospitals via voice, video call & chat.">
	<meta property="og:image" content={{asset('img/preview-banner.jpg')}}>
	<meta name="twitter:card" content="summary_large_image">
	<meta property="twitter:domain" content="https://doccure.dreamstechnologies.com/html/">
	<meta property="twitter:url" content="https://doccure.dreamstechnologies.com/html/">
	<meta name="twitter:title" content="Doctors Appointment HTML Website Templates | Doccure">
	<meta name="twitter:description" content="The responsive professional Doccure template offers many features, like scheduling appointments with  top doctors, clinics, and hospitals via voice, video call & chat.">
	<meta name="twitter:image" content={{asset('img/preview-banner.jpg')}}>

	<!-- Favicons -->
	<link href={{asset('img/favicon.png')}} rel="icon">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href={{asset('css/bootstrap.min.css')}}>

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href={{asset('plugins/fontawesome/css/fontawesome.min.css')}}>
	<link rel="stylesheet" href={{asset('plugins/fontawesome/css/all.min.css')}}>

	<!-- Feathericon CSS -->
	<link rel="stylesheet" href={{asset('css/feather.css')}}>

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href={{asset('css/bootstrap-datetimepicker.min.css')}}>

	<!-- Select2 CSS -->
	<link rel="stylesheet" href={{asset('plugins/select2/css/select2.min.css')}}>

	<!-- Fancybox CSS -->
	<link rel="stylesheet" href={{asset('plugins/fancybox/jquery.fancybox.min.css')}}>

	<!-- Main CSS -->
	<link rel="stylesheet" href={{asset('css/custom.css')}}>

</head>


<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        @include('guest.partials.navbar')

        <!-- Page Content -->
        <div class="content">
            <div class="container mt-5">

                <div class="row">
                    <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">

                        <!-- Search Filter -->
                        <div class="card search-filter">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Search Filter</h4>
                            </div>
                            <div class="card-body">
                                <div class="filter-widget">
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" placeholder="Select Date">
                                    </div>
                                </div>
                                <div class="filter-widget">
                                    <h4>Gender</h4>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="gender_type" checked>
                                            <span class="checkmark"></span> Male Doctor
                                        </label>
                                    </div>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="gender_type">
                                            <span class="checkmark"></span> Female Doctor
                                        </label>
                                    </div>
                                </div>
                                <div class="filter-widget">
                                    <h4>Select Specialist</h4>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="select_specialist" checked>
                                            <span class="checkmark"></span> Urology
                                        </label>
                                    </div>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="select_specialist" checked>
                                            <span class="checkmark"></span> Neurology
                                        </label>
                                    </div>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="select_specialist">
                                            <span class="checkmark"></span> Dentist
                                        </label>
                                    </div>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="select_specialist">
                                            <span class="checkmark"></span> Orthopedic
                                        </label>
                                    </div>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="select_specialist">
                                            <span class="checkmark"></span> Cardiologist
                                        </label>
                                    </div>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="select_specialist">
                                            <span class="checkmark"></span> Cardiologist
                                        </label>
                                    </div>
                                </div>
                                <div class="btn-search">
                                    <button type="button" class="btn w-100">Search</button>
                                </div>
                            </div>
                        </div>
                        <!-- /Search Filter -->

                    </div>

                    <div class="col-md-12 col-lg-8 col-xl-9">

                        @foreach ($doctors as $doctor)
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left">
                                            <div class="doctor-img">
                                                <a href="doctor-profile.html">
                                                    <img src={{ asset("img/doctors/doctor-thumb-".str_pad(rand(1, 21), 2, '0', STR_PAD_LEFT).".jpg") }} class="img-fluid" alt="User Image">
                                                </a>
                                            </div>
                                            <div class="doc-info-cont">
                                                <h4 class="doc-name"><a href="doctor-profile.html">{{$doctor->name}}</a></h4>
                                                <p class="doc-speciality">MDS - Periodontology and Oral Implantology, BDS
                                                </p>
                                                <h5 class="doc-department"><img src={{ asset('img/specialities/specialities-05.png') }} class="img-fluid" alt="Speciality">Dentist</h5>
                                                <div class="rating">
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span class="d-inline-block average-rating">(17)</span>
                                                </div>
                                                <div class="clinic-details">
                                                    <p class="doc-location"><i class="fas fa-map-marker-alt"></i> Florida,
                                                        USA</p>
                                                    <ul class="clinic-gallery">
                                                        <li>
                                                            <a href={{ asset('img/features/feature-01.jpg') }} data-fancybox="gallery">
                                                                <img src={{ asset('img/features/feature-01.jpg') }} alt="Feature">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href={{ asset('img/features/feature-02.jpg') }} data-fancybox="gallery">
                                                                <img src={{ asset('img/features/feature-02.jpg') }} alt="Feature">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href={{ asset('img/features/feature-03.jpg') }} data-fancybox="gallery">
                                                                <img src={{ asset('img/features/feature-03.jpg') }} alt="Feature">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href={{ asset('img/features/feature-04.jpg') }} data-fancybox="gallery">
                                                                <img src={{ asset('img/features/feature-04.jpg') }} alt="Feature">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="clinic-services">
                                                    <span>Dental Fillings</span>
                                                    <span> Whitneing</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-info-right">
                                            <div class="clini-infos">
                                                <ul>
                                                    <li><i class="far fa-thumbs-up"></i> 98%</li>
                                                    <li><i class="far fa-comment"></i> 17 Feedback</li>
                                                    <li><i class="fas fa-map-marker-alt"></i> Florida, USA</li>
                                                    <li><i class="far fa-money-bill-alt"></i> $300 - $1000 <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="Lorem Ipsum"></i> </li>
                                                </ul>
                                            </div>
                                            <div class="clinic-booking">
                                                <a class="view-pro-btn" href="{{route('doctor.profile',$doctor->id)}}">View Profile</a>
                                                <a class="apt-btn" href="booking.html">Book Appointment</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="load-more text-center">
                            <a class="btn btn-primary btn-sm prime-btn" href="javascript:void(0);">Load More</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- /Page Content -->

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

    <!-- Bootstrap Core JS -->
    <script src={{ asset('js/bootstrap.bundle.min.js') }}></script>

    <!-- Sticky Sidebar JS -->
    <script src={{ asset('plugins/theia-sticky-sidebar/ResizeSensor.js') }}></script>
    <script src={{ asset('plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}></script>

    <!-- Select2 JS -->
    <script src={{ asset('plugins/select2/js/select2.min.js') }}></script>

    <!-- Datetimepicker JS -->
    <script src={{ asset('js/moment.min.js') }}></script>
    <script src={{ asset('js/bootstrap-datetimepicker.min.js') }}></script>

    <!-- Fancybox JS -->
    <script src={{ asset('plugins/fancybox/jquery.fancybox.min.js') }}></script>

    <!-- Custom JS -->
    <script src={{ asset('js/script.js') }}></script>

</body>

</html>
