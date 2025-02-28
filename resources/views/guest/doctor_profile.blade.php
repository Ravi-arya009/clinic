@extends('guest.layouts.main')
@section('title', 'Doctor Profile')

@section('content')
    <div class="content">
        <div class="container mt-5">
            <!-- Doctor Widget -->
            <div class="card doc-profile-card">
                <div class="card-body">
                    <div class="doctor-widget doctor-profile-two">
                        <div class="doc-info-left">
                            <div class="doctor-img">
                                <img src="{{ $doctor->profile_image ? asset('img/doctors/' . $doctor->profile_image) : asset('img/default-profile-picture.webp') }}" alt="Doctor Image" class="img-fluid">
                            </div>
                            <div class="doc-info-cont">
                                <h4 class="doc-name">
                                    {{ $doctor->name }}
                                    <img src={{ asset('img/icons/badge-check.svg') }} alt="Img">
                                    <span class="badge doctor-role-badge"><i class="fa-solid fa-circle"></i>{{ isset($doctor->speciality) ? $doctor->speciality->name : '-' }}</span>
                                </h4>
                                <p>Qualification : {{ isset($doctor->qualification->name) ? $doctor->qualification->name : '-' }}</p>
                                <p>Gender : {{ $doctor->gender == 1 ? 'Male' : 'Female' }}</p>
                                <p>
                                <div class="rating">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <span>(5.0)</span>
                                    <a href="#review" class="d-inline-block average-rating text-info">29 Reviews</a>
                                </div>
                                </p>
                            </div>

                            <div class="doc-info-right">
                                <ul class="doctors-activities">
                                    <li>
                                        <div class="hospital-info">
                                            <span class="list-icon"><i class="fa-solid fa-location-dot"></i></i></span>
                                            <p>{{ $doctor->address }}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="hospital-info">
                                            <span class="list-icon"><i class="fa-solid fa-envelope"></i></span>
                                            <p>{{ $doctor->email }}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="doc-profile-card-bottom">
                        <ul>
                            <li>
                                <span class="bg-blue"><img src={{ asset('img/icons/calendar3.svg') }} alt="Img"></span>
                                Nearly 200+ Appointment Booked
                            </li>
                            <li>
                                <span class="bg-dark-blue"><img src={{ asset('img/icons/bullseye.svg') }} alt="Img"></span>
                                In Practice for {{ $doctor->doctorProfile->experience }} Years
                            </li>
                        </ul>
                        <div class="bottom-book-btn">
                            <p class="pe-2"><span><i class="far fa-money-bill-alt pe-2"></i>Consultation Fee : ₹{{ $doctor->doctorProfile->consultation_fee }} </span></p>
                            <div class="clinic-booking">
                                <a class="apt-btn" id="book-appointment-btn" href="#">Book Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Doctor Widget -->

            <div class="row">
                <div class="col-md-8">
                    <div class="doctors-detailed-info">
                        <div class="doc-information-main">
                            <div class="doc-information-details bio-detail" id="doc_bio">
                                <div class="detail-title">
                                    <h4>Doctor Bio</h4>
                                </div>
                                <div class="doc-review-card">
                                    <p>"{{ $doctor->doctorProfile->bio }}"</p>
                                </div>

                            </div>

                            <div class="doc-information-details" id="clinic">
                                <div class="detail-title">
                                    <h4>Clinics & Locations</h4>
                                </div>
                                <div class="clinic-loc">
                                    <div class="row align-items-center">
                                        <div class="col-lg-2">
                                            <div class="clinic-info">
                                                <img src={{ asset('img/clinic/clinic-11.jpg') }} alt="Img" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="clinic-info">
                                                <div class="detail-clinic ms-3">
                                                    <h5>{{ $doctor->clinic->name }}</h5>
                                                    <p class="mt-2"><span class="fw-bold text-info">Phone:</span> {{ $doctor->clinic->phone }}</p>
                                                    <p class="mt-2"><span class="fw-bold text-info">WhatsApp:</span> {{ $doctor->clinic->whatsapp }}</p>
                                                    <p class="mt-2"><span class="fw-bold text-info">Email:</span> {{ $doctor->clinic->email }}</p>
                                                    <p class="mt-2"><span class="fw-bold text-info">Address:</span> {{ $doctor->clinic->address }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="contact-map d-flex">
                                                <iframe src="https://www.google.com/maps?q={{ $doctor->clinic->address }}&output=embed" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                                </iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="doc-information-details" id="review">
                                <div class="detail-title">
                                    <h4>Reviews (29)</h4>
                                </div>
                                <div class="doc-review-card">
                                    <div class="user-info-review">
                                        <div class="reviewer-img">
                                            <a href="#" class="avatar-img"><img src={{ asset('img/clients/client-13.jpg') }} alt="Img"></a>
                                            <div class="review-star">
                                                <a href="#">kadajsalamander</a>
                                                <div class="rating">
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <span>5.0 | 2 days ago</span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="thumb-icon"><i class="fa-regular fa-thumbs-up"></i>Yes,Recommend for Appointment</span>
                                    </div>
                                    <p>Thank you for this informative article! I've had a couple of hit-and-miss experiences with
                                        freelancers in the past, and I realize now that I wasn't vetting them properly. Your checklist
                                        for choosing the right freelancer is going to be my go-to from now on
                                    </p>
                                    <a href="#" class="reply d-flex align-items-center"><i class="fa-solid fa-reply me-2"></i>Reply</a>
                                </div>
                                <div class="doc-review-card">
                                    <div class="user-info-review">
                                        <div class="reviewer-img">
                                            <a href="#" class="avatar-img"><img src={{ asset('img/clients/client-14.jpg') }} alt="Img"></a>
                                            <div class="review-star">
                                                <a href="#">Dane jose</a>
                                                <div class="rating">
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <span>5.0 | 1 Months ago</span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="thumb-icon"><i class="fa-regular fa-thumbs-up"></i>Yes,Recommend for Appointment</span>
                                    </div>
                                    <p>As a freelancer myself, I find this article spot on! It's important for clients to
                                        understand what to look for in a freelancer and how to foster a good working relationship.
                                        The point about mutual respect
                                        and clear communication is key in my experience. Well done
                                    </p>
                                    <a href="#" class="reply d-flex align-items-center"><i class="fa-solid fa-reply me-2"></i>Reply</a>
                                </div>
                                <div class="doc-review-card mb-0">
                                    <div class="user-info-review">
                                        <div class="reviewer-img">
                                            <a href="#" class="avatar-img"><img src={{ asset('img/clients/client-15.jpg') }} alt="Img"></a>
                                            <div class="review-star">
                                                <a href="#">Dane jose</a>
                                                <div class="rating">
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <span>5.0 | 15 days ago</span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="thumb-icon"><i class="fa-regular fa-thumbs-up"></i>Yes,Recommend for Appointment</span>
                                    </div>
                                    <p>Great article! I've bookmarked it for future reference. I'd love to read more about managing long-term relationships with freelancers, if you have any tips on that.
                                    </p>
                                    <a href="#" class="reply d-flex align-items-center"><i class="fa-solid fa-reply me-2"></i>Reply</a>
                                    <div class="replied-info">
                                        <div class="user-info-review">
                                            <div class="reviewer-img">
                                                <a href="#" class="avatar-img"><img src={{ asset('img/clients/client-16.jpg') }} alt="Img"></a>
                                                <div class="review-star">
                                                    <a href="#">Robert Hollenbeck</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p>Thank you for your comment and I will try to make a another post on that topic.
                                        </p>
                                        <a href="#" class="reply d-flex align-items-center"><i class="fa-solid fa-reply me-2"></i>Reply</a>
                                    </div>
                                    <!-- Pagination -->
                                    <div class="pagination dashboard-pagination">
                                        <ul>
                                            <li>
                                                <a href="#" class="page-link prev-link"><i class="fa-solid fa-chevron-left me-2"></i>Prev</a>
                                            </li>
                                            <li>
                                                <a href="#" class="page-link active">1</a>
                                            </li>
                                            <li>
                                                <a href="#" class="page-link">2</a>
                                            </li>
                                            <li>
                                                <a href="#" class="page-link">3</a>
                                            </li>
                                            <li>
                                                <a href="#" class="page-link">4</a>
                                            </li>
                                            <li>
                                                <a href="#" class="page-link">5</a>
                                            </li>
                                            <li>
                                                <a href="#" class="page-link">6</a>
                                            </li>
                                            <li>
                                                <a href="#" class="page-link next-link">Next<i class="fa-solid fa-chevron-right ms-2"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /Pagination -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card booking-card">
                        <div class="card-header">
                            <h4 class="card-title">Available Slots</h4>
                        </div>
                        <div class="card-body time-slot-card-body">
                            <div class="booking-date-slider">
                                <ul class="date-slider slick">
                                    @if (!empty($doctor->slotsByDate))
                                        @foreach ($doctor->slotsByDate as $date => $timeSlot)
                                            <li id="date-{{ $loop->iteration }}" class="{{ $loop->first ? 'active' : '' }}">
                                                <h4>{{ date('M d', strtotime($date)) }}</h4>
                                                <p>{{ $timeSlot->dayName }}</p>
                                            </li>
                                        @endforeach
                                    @else
                                        <p>No time slots available.</p>
                                    @endif
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col">
                                    @php
                                        $currentDate = date('Y-m-d');
                                        $currentTime = date('H:i:s');
                                    @endphp

                                    @foreach ($doctor->slotsByDate as $date => $timeSlots)
                                        <div class="time-slot time-slot-blk" id="slot-for-day-{{ $loop->iteration }}">
                                            <div class="time-slot-list">
                                                <ul>
                                                    @foreach ($timeSlots as $slot)
                                                        <li>
                                                            <a class="timing"
                                                                href="{{ route('appointment.create', [
                                                                    'clinic_id' => $doctor->clinics->first()->clinic_id,
                                                                    'doctor_id' => $doctor->id,
                                                                    'doctor_name' => $doctor->name,
                                                                    'doctor_address' => $doctor->address,
                                                                    'doctor_qualification' => isset($doctor->qualification->name) ? $doctor->qualification->name : '-',
                                                                    'doctor_speciality' => isset($doctor->speciality->name) ? $doctor->speciality->name : '-',
                                                                    'slot_id' => $slot->id,
                                                                    'appointment_date' => $date,
                                                                    'appointment_time' => $slot->slot_time,
                                                                    'consultation_fee' => $doctor->doctorProfile->consultation_fee,
                                                                ]) }}">
                                                                <span>{{ date('h:i A', strtotime($slot->slot_time)) }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="overlay"></div>

@endsection
