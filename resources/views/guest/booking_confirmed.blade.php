@extends('guest.layouts.main')
@section('title', 'Doccure')

@section('content')
    <div class="doctor-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="success-content">
                        <div class="success-icon">
                            <i class="fas fa-circle-check"></i>
                        </div>
                        <h4>Your Appointment Booked Succesfully</h4>
                    </div>
                    <div class="card booking-card">
                        <div class="card-body booking-card-body booking-list-body">
                            <div class="booking-doctor-left booking-success-info">
                                <div class="booking-doctor-img">
                                    <a href="javascript:void(0);">
                                        <img src={{ asset('img/doctors/doctor-02.jpg') }} alt="John Doe" class="img-fluid">
                                    </a>
                                </div>
                                <div class="booking-doctor-info">
                                    <h4><a href="javascript:void(0);">{{ $bookingData->doctor_name }}</a></h4>
                                    <p>{{ $bookingData->doctor_qualification }}, {{ $bookingData->doctor_speciality }}</p>
                                    <div class="booking-doctor-location">
                                        <p><i class="feather-map-pin"></i> {{ $bookingData->doctor_address }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-list">
                                <div class="booking-date-list consultation-date-list">
                                    <ul>
                                        <li>Booking Date: <span>{{ $date = date('D, d M Y', strtotime($bookingData->appointment_date)) }}</span></li>
                                        <li>Booking Time: <span>{{ $time = date('h.iA', strtotime($bookingData->appointment_time)) }}</span></li>
                                        <li>Consultaion Fee: <span>₹ {{ $bookingData->consultation_fee }}.00</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="success-btn">
                        <a href="javascript:void(0);" class="btn btn-primary prime-btn">
                            View Appointment
                        </a>
                    </div>
                    <div class="success-dashboard-link">
                        <a href="{{ route('index') }}">
                            <i class="fa-solid fa-arrow-left-long"></i> Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cursor -->
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
    <!-- /Cursor -->
@endsection
