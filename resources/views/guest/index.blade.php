@extends('guest.layouts.main')
@section('title', 'Doccure')

@section('content')
    <!-- Home Banner -->
    <section class="section section-search">
        <div class="container-fluid">
            <div class="banner-wrapper">
                <div class="banner-header text-center aos" data-aos="fade-up">
                    <h1>Search Doctor, Make an Appointment</h1>
                    <p>Discover the best doctors, clinic & hospital the city nearest to you.</p>
                </div>
                <!-- Search -->
                <div class="search-box">
                    <form action="{{ route('search.all') }}" method="GET">
                        <div class="mb-3 search-location aos" data-aos="fade-up">
                            <select class="form-control" name="city" id="select-city">
                                <option value="" selected>Select</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" @if (isset($clinic) && $clinic->city == $city->id) selected @endif>{{ $city->name }}</option>
                                @endforeach
                            </select>
                            <span class="form-text">Based on your Location</span>
                        </div>
                        <div class="mb-3 search-info aos" data-aos="fade-up">
                            <input type="text" id="search" class="form-control" name="search_string" placeholder="Search Doctors, Clinics, Hospitals, Diseases Etc">
                            <span id="search-span-text" class="form-text">Ex : Dental or Sugar Check up etc</span>
                            <div id="search-results" class="search-results">
                                <div class="result-section" id="clinics-section">
                                    <h3 class="px-2 pt-2 bg-info text-white">Clinics</h3>
                                    <div class="result-items" id="clinics-results">
                                        <!-- Clinics will be appended here -->
                                    </div>
                                </div>
                                <div class="result-section" id="doctors-section">
                                    <h3 class="px-2 pt-2 bg-info text-white">Doctors</h3>
                                    <div class="result-items" id="doctors-results">
                                        <!-- Doctors will be appended here -->
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary search-btn mt-0 aos" data-aos="fade-up"><i class="fas fa-search"></i> <span>Search</span></button>
                    </form>
                </div>
                <!-- /Search -->
            </div>
        </div>
    </section>
    <!-- /Home Banner -->

    <!-- Specialities Section -->
    <section class="specialities-section-one">
        <div class="container">
            <div class="service-sec-one">
                <div class="row row-cols-7 row-cols-xxl-7 row-cols-xl-4 row-cols-lg-4 rows-cols-md-6 justify-content-center">
                    <div class="col-12 d-flex col-xxl col-lg-3 col-sm-6">
                        <a href="javascript:void(0);" class="serv-wrap blue-bg flex-fill">
                            <span>
                                <img src={{ asset('img/icons/service-01.svg') }} alt="heart-image">
                            </span>
                            <h4>Book Appointment</h4>
                        </a>
                    </div>
                    <div class="col-12 d-flex col-xxl col-lg-3 col-sm-6">
                        <a href="javascript:void(0);" class="serv-wrap green-bg flex-fill">
                            <span>
                                <img src={{ asset('img/icons/service-02.svg') }} alt="heart-image">
                            </span>
                            <h4>Lab Testing Services</h4>
                        </a>
                    </div>
                    <div class="col-12 d-flex col-xxl col-lg-3 col-sm-6">
                        <a href="javascript:void(0);" class="serv-wrap info-bg flex-fill">
                            <span>
                                <img src={{ asset('img/icons/service-03.svg') }} alt="heart-image">
                            </span>
                            <h4>Medicines & Supplies</h4>
                        </a>
                    </div>
                    <div class="col-12 d-flex col-xxl col-lg-3 col-sm-6">
                        <a href="javascript:void(0);" class="serv-wrap red-bg flex-fill">
                            <span>
                                <img src={{ asset('img/icons/service-04.svg') }} alt="heart-image">
                            </span>
                            <h4>Hospitals / Clinics</h4>
                        </a>
                    </div>
                    <div class="col-12 d-flex col-xxl col-lg-3 col-sm-6">
                        <a href="javascript:void(0);" class="serv-wrap success-bg flex-fill">
                            <span>
                                <img src={{ asset('img/icons/service-05.svg') }} alt="heart-image">
                            </span>
                            <h4>Health Care Services</h4>
                        </a>
                    </div>
                    <div class="col-12 d-flex col-xxl col-lg-3 col-sm-6">
                        <a href="javascript:void(0);" class="serv-wrap pink-bg flex-fill">
                            <span>
                                <img src={{ asset('img/icons/service-06.svg') }} alt="heart-image">
                            </span>
                            <h4>Talk to Doctor’s</h4>
                        </a>
                    </div>
                    <div class="col-12 d-flex col-xxl col-lg-3 col-sm-6">
                        <a href="javascript:void(0);" class="serv-wrap danger-bg flex-fill">
                            <span>
                                <img src={{ asset('img/icons/service-07.svg') }} alt="heart-image">
                            </span>
                            <h4>Home Care Services</h4>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-7 aos" data-aos="fade-up">
                    <div class="section-header-one section-header-slider">
                        <h2 class="section-title">Specialities</h2>
                    </div>
                </div>
                <div class="col-md-6 col-5  aos" data-aos="fade-up">
                    <div class="owl-nav slide-nav-1 text-end nav-control"></div>
                </div>
            </div>
            <div class="owl-carousel specialities-slider-one owl-theme aos" data-aos="fade-up">
                @foreach ($specialities as $speciality)
                    <div class="item">
                        <div class="specialities-item">
                            <div class="specialities-img">
                                <span><img src={{ asset('img/specialities/' . $speciality->image) }} alt="heart-image"></span>
                            </div>
                            <p>{{ $speciality->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="specialities-btn aos" data-aos="fade-up">
                <a href="search.html" class="btn">
                    See All Specialities
                </a>
            </div>
        </div>
    </section>
    <!-- /Specialities Section -->

    <!-- Best Clinic Section -->
    <section class="our-doctors-section doctors-section specialities-section-one my-dark-background" id="our-clinics">
        <div class="container">
            <div class="row">
                <div class="col-md-6 aos" data-aos="fade-up">
                    <div class="section-heading">
                        <h2>Book Our Best Clinic</h2>
                        <p>Meet our experts & book online</p>
                    </div>
                </div>
                <div class="col-md-6 text-end aos" data-aos="fade-up">
                    <div class="owl-nav slide-nav-2 slide-nav-clinic text-end nav-control"></div>
                </div>
            </div>
            <div class="owl-carousel our-clinics owl-theme aos" data-aos="fade-up">
                @foreach ($clinics as $clinic)
                    <div class="item">
                        <div class="our-doctors-card">
                            <div class="doctors-header">
                                {{-- <img src={{ asset('img/doctors/doctor-' . str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT) . '.jpg') }} alt="Ruby Perrin" class="img-fluid"> --}}
                                @if ($clinic->logo == null)
                                    <img src="{{ asset('img/bg/ring-2.png') }}" alt="Clinic Logo" class="img-fluid">
                                @else
                                    <img src="{{ asset('storage/clinic_logos/' . $clinic->logo) }}" alt="Clinic Logo" class="img-fluid">
                                @endif

                            </div>
                            <div class="doctors-body">
                                <a href="{{ route('clinic.profile', $clinic->id) }}">
                                    <h4>{{ $clinic->name }}</h4>
                                </a>
                                <p class="pt-2">
                                    <span class="badge badge-primary doc-badge speciality-badge px-2 py-1">{{ isset($clinic->speciality) ? $clinic->speciality->name : '-' }}</span>
                                </p>
                                <div class="location d-flex">
                                    <p><i class="fas fa-map-marker-alt"></i> {{ $clinic->area }}, {{ $clinic->city->name }}</p>
                                </div>
                                <div class="rating my-border pt-2">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <span class="d-inline-block average-ratings">{{ rand(31, 49) / 10 }}</span>
                                    <span class="d-inline-block my-review-text ps-1">({{ rand(11, 39) }} reviews)</span>
                                </div>

                                <div class="row row-sm pt-2">
                                    <div class="col-6">
                                        <a href="{{ route('clinic.profile', $clinic->id) }}" class="btn view-btn" tabindex="0">View Profile</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('clinic.profile', $clinic->id) }}" class="btn book-btn" tabindex="0">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="specialities-btn aos pt-3" data-aos="fade-up">
                <a href="{{ route('search.clinic') }}" class="btn">
                    See All Clinics
                </a>
            </div>
        </div>
    </section>
    <!-- /Best Clinic Section -->

    <!-- Best Doctor Section -->
    <section class="our-doctors-section specialities-section-one" id="our-doctors">
        <div class="container">
            <div class="row">
                <div class="col-md-6 aos" data-aos="fade-up">
                    <div class="section-heading">
                        <h2>Book Our Best Doctor</h2>
                        <p>Meet our experts & book online</p>
                    </div>
                </div>
                <div class="col-md-6 text-end aos" data-aos="fade-up">
                    <div class="owl-nav slide-nav-2 slide-nav-doctor text-end nav-control"></div>
                </div>
            </div>
            <div class="owl-carousel our-doctors owl-theme aos" data-aos="fade-up">
                @foreach ($doctors as $doctor)
                    <div class="item">
                        <div class="our-doctors-card">
                            <div class="doctors-header">
                                <img src="{{ $doctor->profile_image ? asset('/storage/profile_images/' . $doctor->profile_image) : asset('img/default-profile-picture.webp') }}" alt="Profile Image" class="img-fluid">
                                <div class="img-overlay">
                                    <span>₹{{ $doctor->consultation_fee }}</span>
                                </div>
                            </div>
                            <div class="doctors-body">
                                <a href="{{ route('doctor.profile', $doctor->id) }}">
                                    <h4>{{ $doctor->name }}</h4>
                                </a>
                                <p class="pt-2">
                                    <span class="badge badge-primary doc-badge speciality-badge px-2 py-1">{{ isset($doctor->speciality) ? $doctor->speciality->name : '-' }}</span>
                                </p>

                                <div class="location d-flex">
                                    <p><i class="fas fa-map-marker-alt"></i> {{ $doctor->city->name }}</p>
                                </div>
                                <div class="rating my-border pt-2">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <span class="d-inline-block average-ratings">{{ rand(31, 49) / 10 }}</span>
                                    <span class="d-inline-block my-review-text ps-1">({{ rand(11, 39) }} reviews)</span>
                                </div>

                                <div class="row row-sm pt-2">
                                    <div class="col-6">
                                        <a href="{{ route('doctor.profile', $doctor->id) }}" class="btn view-btn" tabindex="0">View Profile</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('doctor.profile', $doctor->id) }}" class="btn book-btn" tabindex="0">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="specialities-btn aos pt-3" data-aos="fade-up">
                <a href="{{ route('search.doctor') }}" class="btn">
                    See All Doctors
                </a>
            </div>
        </div>
    </section>
    <!-- /Best Doctor Section -->

    <!-- Work Section -->
    <section class="work-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 work-img-info aos" data-aos="fade-up">
                    <div class="work-img">
                        <img src={{ asset('img/work-img.png') }} class="img-fluid" alt="doctor-image">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 work-details">
                    <div class="section-header-one aos" data-aos="fade-up">
                        <h5>How it Works</h5>
                        <h2 class="section-title">4 easy steps to get your solution</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 aos" data-aos="fade-up">
                            <div class="work-info">
                                <div class="work-icon">
                                    <span><img src={{ asset('img/icons/work-01.svg') }} alt="search-doctor-icon"></span>
                                </div>
                                <div class="work-content">
                                    <h5>Search Doctor</h5>
                                    <p>Search for a doctor based on specialization, location, or availability. </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 aos" data-aos="fade-up">
                            <div class="work-info">
                                <div class="work-icon">
                                    <span><img src={{ asset('img/icons/work-02.svg') }} alt="doctor-profile-icon"></span>
                                </div>
                                <div class="work-content">
                                    <h5>Check Doctor Profile</h5>
                                    <p>Explore detailed doctor profiles on our platform to make informed healthcare decisions.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 aos" data-aos="fade-up">
                            <div class="work-info">
                                <div class="work-icon">
                                    <span><img src={{ asset('img/icons/work-03.svg') }} alt="calendar-icon"></span>
                                </div>
                                <div class="work-content">
                                    <h5>Schedule Appointment</h5>
                                    <p>After choose your preferred doctor, select a convenient time slot, & confirm your appointment.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 aos" data-aos="fade-up">
                            <div class="work-info">
                                <div class="work-icon">
                                    <span><img src={{ asset('img/icons/work-04.svg') }} alt="solution-icon"></span>
                                </div>
                                <div class="work-content">
                                    <h5>Get Your Solution</h5>
                                    <p>Discuss your health concerns with the doctor and receive personalized advice & solution.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Work Section -->

    <!-- Articles Section -->
    <section class="articles-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 aos" data-aos="fade-up">
                    <div class="section-header-one text-center">
                        <h2 class="section-title">Latest Articles</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 d-flex aos" data-aos="fade-up">
                    <div class="articles-grid w-100">
                        <div class="articles-info">
                            <div class="articles-left">
                                <a href="blog-details.html">
                                    <div class="articles-img">
                                        <img src={{ asset('img/blog/blog-11.jpg') }} class="img-fluid" alt="John Doe">
                                    </div>
                                </a>
                            </div>
                            <div class="articles-right">
                                <div class="articles-content">
                                    <ul class="articles-list nav">
                                        <li>
                                            <i class="feather-user"></i> John Doe
                                        </li>
                                        <li>
                                            <i class="feather-calendar"></i> 13 Aug, 2023
                                        </li>
                                    </ul>
                                    <h4>
                                        <a href="blog-details.html">Navigating Telehealth: A Guide to Virtual Healthcare Visits</a>
                                    </h4>
                                    <p>Explore the benefits & challenges of virtual healthcare appointments, along with tips for making good health.</p>
                                    <a href="blog-details.html" class="btn">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 d-flex aos" data-aos="fade-up">
                    <div class="articles-grid w-100">
                        <div class="articles-info">
                            <div class="articles-left">
                                <a href="blog-details.html">
                                    <div class="articles-img">
                                        <img src={{ asset('img/blog/blog-24.jpg') }} class="img-fluid" alt="Darren Elder">
                                    </div>
                                </a>
                            </div>
                            <div class="articles-right">
                                <div class="articles-content">
                                    <ul class="articles-list nav">
                                        <li>
                                            <i class="feather-user"></i> Darren Elder
                                        </li>
                                        <li>
                                            <i class="feather-calendar"></i> 10 Sep, 2023
                                        </li>
                                    </ul>
                                    <h4>
                                        <a href="blog-details.html">Work-Life Harmony: Balancing Career and Personal Wellness</a>
                                    </h4>
                                    <p>Uncover strategies to achieve a harmonious balance between professional commitments and personal well-being.</p>
                                    <a href="blog-details.html" class="btn">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 d-flex aos" data-aos="fade-up">
                    <div class="articles-grid w-100">
                        <div class="articles-info">
                            <div class="articles-left">
                                <a href="blog-details.html">
                                    <div class="articles-img">
                                        <img src={{ asset('img/blog/blog-25.jpg') }} class="img-fluid" alt="Ruby Perrin">
                                    </div>
                                </a>
                            </div>
                            <div class="articles-right">
                                <div class="articles-content">
                                    <ul class="articles-list nav">
                                        <li>
                                            <i class="feather-user"></i> Ruby Perrin
                                        </li>
                                        <li>
                                            <i class="feather-calendar"></i> 30 Oct, 2023
                                        </li>
                                    </ul>
                                    <h4>
                                        <a href="blog-details.html">Sleep Solutions: Unveiling the Secrets to a Restful Night</a>
                                    </h4>
                                    <p>Explore importance of quality sleep & learn tips to improve your sleep, ensuring you wake up refreshed & ready to face the day.</p>
                                    <a href="blog-details.html" class="btn">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 d-flex aos" data-aos="fade-up">
                    <div class="articles-grid w-100">
                        <div class="articles-info">
                            <div class="articles-left">
                                <a href="blog-details.html">
                                    <div class="articles-img">
                                        <img src={{ asset('img/blog/blog-12.jpg') }} class="img-fluid" alt="Sofia Brient">
                                    </div>
                                </a>
                            </div>
                            <div class="articles-right">
                                <div class="articles-content">
                                    <ul class="articles-list nav">
                                        <li>
                                            <i class="feather-user"></i> Sofia Brient
                                        </li>
                                        <li>
                                            <i class="feather-calendar"></i> 08 Nov, 2023
                                        </li>
                                    </ul>
                                    <h4>
                                        <a href="blog-details.html">Mental Wellness in a Digital Age: Strategies for a Healthy Mind Online</a>
                                    </h4>
                                    <p>Delve into the impact of digital life on mental health & discover practical strategies to maintain mental well-being.</p>
                                    <a href="blog-details.html" class="btn">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Articles Section -->

    <!-- Download App Section -->
    <section class="app-section pt-0">
        <div class="container">
            <div class="app-bg">
                <div class="row align-items-end">
                    <div class="col-lg-6 col-md-12">
                        <div class="app-content">
                            <div class="app-header aos" data-aos="fade-up">
                                <h5>Working for Your Better Health.</h5>
                                <h2>Download the Doccure App today!</h2>
                            </div>
                            <div class="app-scan aos" data-aos="fade-up">
                                <p>Scan the QR code to get the app now</p>
                                <img src={{ asset('img/scan-img.png') }} alt="scan-image">
                            </div>
                            <div class="google-imgs aos" data-aos="fade-up">
                                <a href="javascript:void(0);"><img src={{ asset('img/icons/google-play-icon.svg') }} alt="img"></a>
                                <a href="javascript:void(0);"><img src={{ asset('img/icons/app-store-icon.svg') }} alt="img"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 aos" data-aos="fade-up">
                        <div class="mobile-img">
                            <img src={{ asset('img/mobile-img.png') }} class="img-fluid" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Download App Section -->

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header-one aos" data-aos="fade-up">
                        <h5>Get Your Answer</h5>
                        <h2 class="section-title">Frequently Asked Questions</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 aos" data-aos="fade-up">
                    <div class="faq-img">
                        <img src={{ asset('img/faq-img.png') }} class="img-fluid" alt="img">
                        <div class="faq-patients-count">
                            <div class="faq-smile-img">
                                <img src={{ asset('img/icons/smiling-icon.svg') }} alt="icon">
                            </div>
                            <div class="faq-patients-content">
                                <h4><span class="count-digit">95</span>k+</h4>
                                <p>Happy Patients</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="faq-info aos" data-aos="fade-up">
                        <div class="accordion" id="faq-details">

                            <!-- FAQ Item -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <a href="javascript:void(0);" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        How do I book an appointment with a doctor?
                                    </a>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faq-details">
                                    <div class="accordion-body">
                                        <div class="accordion-content">
                                            <p>Yes, simply visit our website and log in or create an account. Search for a doctor based on specialization, location, or availability & confirm your booking.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /FAQ Item -->

                            <!-- FAQ Item -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <a href="javascript:void(0);" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Can I request a specific doctor when booking my appointment?
                                    </a>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faq-details">
                                    <div class="accordion-body">
                                        <div class="accordion-content">
                                            <p>Yes, you can usually request a specific doctor when booking your appointment, though availability may vary based on their schedule.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /FAQ Item -->

                            <!-- FAQ Item -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <a href="javascript:void(0);" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        What should I do if I need to cancel or reschedule my appointment?
                                    </a>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faq-details">
                                    <div class="accordion-body">
                                        <div class="accordion-content">
                                            <p>If you need to cancel or reschedule your appointment, contact the doctor as soon as possible to inform them and to reschedule for another available time slot.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /FAQ Item -->

                            <!-- FAQ Item -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <a href="javascript:void(0);" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        What if I'm running late for my appointment?
                                    </a>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faq-details">
                                    <div class="accordion-body">
                                        <div class="accordion-content">
                                            <p>If you know you will be late, it's courteous to call the doctor's office and inform them. Depending on their policy and schedule, they may be able to accommodate you or reschedule your appointment.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /FAQ Item -->

                            <!-- FAQ Item -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <a href="javascript:void(0);" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Can I book appointments for family members or dependants?
                                    </a>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faq-details">
                                    <div class="accordion-body">
                                        <div class="accordion-content">
                                            <p>Yes, in many cases, you can book appointments for family members or dependants. However, you may need to provide their personal information and consent to do so.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /FAQ Item -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /FAQ Section -->

    <!-- Testimonial Section -->
    <section class="testimonial-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="testimonial-slider slick">
                        <div class="testimonial-grid">
                            <div class="testimonial-info">
                                <div class="testimonial-img">
                                    <img src={{ asset('img/clients/client-01.jpg') }} class="img-fluid" alt="John Doe">
                                </div>
                                <div class="testimonial-content">
                                    <div class="section-header-one section-header section-inner-header testimonial-header">
                                        <h5>Testimonials</h5>
                                        <h2 class="section-title">What Our Client Says</h2>
                                    </div>
                                    <div class="testimonial-details">
                                        <p>Doccure exceeded my expectations in healthcare. The seamless booking process, coupled with the expertise of the doctors, made my experience exceptional. Their commitment to quality care and convenience truly sets them apart. I highly recommend Doccure
                                            for anyone seeking reliable and accessible healthcare services.</p>
                                        <h6><span class="d-block">John Doe</span> New York</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-grid">
                            <div class="testimonial-info">
                                <div class="testimonial-img">
                                    <img src={{ asset('img/clients/client-03.jpg') }} class="img-fluid" alt="Amanda Warren">
                                </div>
                                <div class="testimonial-content">
                                    <div class="section-header section-inner-header testimonial-header">
                                        <h5>Testimonials</h5>
                                        <h2>What Our Client Says</h2>
                                    </div>
                                    <div class="testimonial-details">
                                        <p>As a busy professional, I don't have time to wait on hold or play phone tag to schedule doctor appointments. Thanks to Doccure, booking appointments has never been easier! The user-friendly interface allows me to quickly find available appointment slots
                                            that fit my schedule and book them with just a few clicks. It's a game-changer for anyone looking to streamline their healthcare management.</p>
                                        <h6><span class="d-block">Andrew Denner</span> Nevada</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-grid">
                            <div class="testimonial-info">
                                <div class="testimonial-img">
                                    <img src={{ asset('img/clients/client-11.jpg') }} class="img-fluid" alt="Betty Carlson">
                                </div>
                                <div class="testimonial-content">
                                    <div class="section-header section-inner-header testimonial-header">
                                        <h5>Testimonials</h5>
                                        <h2>What Our Client Says</h2>
                                    </div>
                                    <div class="testimonial-details">
                                        <p>As a parent, coordinating doctor appointments for my family can be overwhelming. Doccure has simplified the process and made scheduling appointments a breeze! I love being able to see all available appointment times in one place and book appointments
                                            for multiple family members with ease. Plus, the automatic reminders ensure we never miss an appointment. I highly recommend Doccure to other busy parents!</p>
                                        <h6><span class="d-block">Niya Patel</span> New York</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Testimonial Section -->

    <!-- Partners Section -->
    <section class="partners-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header-one text-center aos" data-aos="fade-up">
                        <h2 class="section-title">Our Partners</h2>
                    </div>
                </div>
            </div>
            <div class="partners-info aos" data-aos="fade-up">
                <ul class="owl-carousel partners-slider d-flex">
                    <li>
                        <a href="javascript:void(0);">
                            <img class="img-fluid" src={{ asset('img/partners/partners-1.svg') }} alt="partners">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <img class="img-fluid" src={{ asset('img/partners/partners-2.svg') }} alt="partners">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <img class="img-fluid" src={{ asset('img/partners/partners-3.svg') }} alt="partners">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <img class="img-fluid" src={{ asset('img/partners/partners-4.svg') }} alt="partners">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <img class="img-fluid" src={{ asset('img/partners/partners-5.svg') }} alt="partners">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <img class="img-fluid" src={{ asset('img/partners/partners-6.svg') }} alt="partners">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <img class="img-fluid" src={{ asset('img/partners/partners-1.svg') }} alt="partners">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <img class="img-fluid" src={{ asset('img/partners/partners-2.svg') }} alt="partners">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <img class="img-fluid" src={{ asset('img/partners/partners-3.svg') }} alt="partners">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <img class="img-fluid" src={{ asset('img/partners/partners-4.svg') }} alt="partners">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <img class="img-fluid" src={{ asset('img/partners/partners-5.svg') }} alt="partners">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <img class="img-fluid" src={{ asset('img/partners/partners-6.svg') }} alt="partners">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- /Partners Section -->
@endsection
