{{-- {{dd($bookingData)}} --}}
@extends('guest.layouts.main')
@section('title', 'Doccure')

@section('content')
    <div class="doctor-content">
        <div class="container">
            <!-- Payment -->
            <div class="row">
                <div class="col-md-12">
                    <div class="back-link">
                        <a href="{{ route('doctor.profile', $bookingData->doctor_id) }}"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="paitent-header">
                        <h4 class="paitent-title">Patient's Information</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <!-- Checkout Form -->
                            <form action="{{ route('appointment.store') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ json_encode($bookingData) }}" name="bookingData">
                                <!-- Personal Information -->
                                <div class="info-widget">
                                    <h4 class="card-title">Personal Information</h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3 card-label">
                                                <label class="mb-2">Name</label>
                                                <input type="text" class="form-control" name="name" id="name" value="{{ $loggedInUser ? $loggedInUser->name : old('name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3 card-label">
                                                <label class="mb-2">Phone</label>
                                                <input type="phone" class="form-control" name="phone" id="phone" value="{{ $loggedInUser ? $loggedInUser->phone : old('phone') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3 card-label">
                                                <label class="mb-2">Email</label>
                                                <input class="form-control" type="email" id="email" name="email" value="{{ $loggedInUser ? $loggedInUser->email ?? old('email') : old('email') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Personal Information -->

                                <!--Password -->
                                @if (!$loggedInUser)
                                    <div class="info-widget">
                                        <h4 class="card-title">Password</h4>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3 card-label">
                                                    <label class="mb-2">Create Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="mb-3 card-label">
                                                    <label class="mb-2">Confirm Password</label>
                                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <!-- /Password -->

                                <div class="payment-widget">
                                    <h4 class="card-title">Payment Method</h4>

                                    <!-- Credit Card Payment -->
                                    <div class="payment-list">
                                        <div class="d-inline-block mb-3 me-3">
                                            <label class="payment-radio">
                                                <input type="radio" name="payment_method" value="1" required>
                                                <span class="checkmark"></span> Pay online
                                            </label>
                                        </div>
                                        <div class="d-inline-block mb-3 me-3">
                                            <label class="payment-radio">
                                                <input type="radio" name="payment_method" value="2">
                                                <span class="checkmark"></span> Pay later at the clinic
                                            </label>
                                        </div>
                                        <div class="d-inline-block mb-3">
                                            <label class="payment-radio">
                                                <input type="radio" name="payment_method" value="3">
                                                <span class="checkmark"></span> Part payment
                                            </label>
                                        </div>
                                    </div>
                                    <!-- /Credit Card Payment -->

                                    <!-- Terms Accept -->
                                    <div class="terms-accept mt-2">
                                        <div class="custom-checkbox">
                                            <input type="checkbox" id="terms_accept" required>
                                            <label for="terms_accept">I have read and accept <a href="terms-condition.html">Terms &amp; Conditions</a></label>
                                        </div>
                                    </div>
                                    <!-- /Terms Accept -->

                                    <!-- Submit Section -->
                                    <div class="submit-section mt-4 float-end">
                                        <button type="submit" class="btn btn-primary prime-btn px-3 py-2">Confirm and Pay</button>
                                    </div>
                                    <!-- /Submit Section -->
                                </div>

                                {{-- <input type="hidden" name="doctor_id" value="{{ $doctor_id }}">
                                <input type="hidden" name="slot_id" value="{{ $slot_id }}">
                                <input type="hidden" name="appointment_date" value="{{ $appointment_date }}"> --}}
                            </form>
                            <!-- /Checkout Form -->
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="booking-header">
                        <h4 class="booking-title">Booking Summary</h4>
                    </div>
                    <div class="card booking-card">
                        <div class="card-body booking-card-body">
                            <div class="booking-doctor-details">
                                <div class="booking-doctor-left">
                                    <div class="booking-doctor-img">
                                        <a href="doctor-profile.html">
                                            <img src={{ asset('img/doctors/doctor-02.jpg') }} alt="John Doe">
                                        </a>
                                    </div>
                                    <div class="booking-doctor-info">
                                        <h4><a href="doctor-profile.html">{{ $bookingData->doctor_name }}</a></h4>
                                        <p>{{ $bookingData->doctor_qualification }}, {{ $bookingData->doctor_speciality }}</p>
                                    </div>
                                </div>
                                <div class="booking-doctor-right">
                                    <p>
                                        <i class="fas fa-circle-check"></i>
                                        <a href="{{ route('doctor.profile', $bookingData->doctor_id) }}">Edit</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card booking-card">
                        <div class="card-body booking-card-body booking-list-body">
                            <div class="booking-list">
                                <div class="booking-date-list">
                                    <ul>
                                        <li>Booking Date: <span>{{ date('l, d M Y', strtotime($bookingData->appointment_date)) }}</span></li>
                                        <li>Booking Time: <span>{{ date('h:i A', strtotime($bookingData->appointment_time)) }}</span></li>
                                    </ul>
                                </div>
                                <div class="booking-doctor-right">
                                    <p>
                                        <a href="{{ route('doctor.profile', $bookingData->doctor_id) }}">Edit</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card booking-card">
                        <div class="card-body booking-card-body booking-list-body">
                            <div class="booking-list">
                                <div class="booking-date-list consultation-date-list">
                                    <ul>
                                        <li>Consultation Fee: <span>₹ {{ $bookingData->consultaion_fee }}</span></li>
                                        <li>Booking Fee: <span>₹ 0.00</span></li>
                                        <li>Tax: <span>₹ 0.00</span></li>
                                        <li><span class="total-amount"></span>Total <span>₹ {{ $bookingData->consultaion_fee }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="booking-btn proceed-btn">
                        <a href="booking-success-one.html" class="btn btn-primary prime-btn">
                            Proceed to Pay $163.00
                        </a>
                    </div> --}}
                </div>
            </div>
            <!-- /Payment -->
        </div>
    </div>


    <!-- Cursor -->
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
    <!-- /Cursor -->
@endsection
