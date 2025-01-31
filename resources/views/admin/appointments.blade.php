{{-- {{dump($appointments)}} --}}
@extends('admin.layouts.main')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'Appointments')

@section('breadcrum-title', 'Appointments')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Appointments')

@push('scripts')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href={{ asset('plugins/daterangepicker/daterangepicker.css') }}>
@endpush

@section('content')
    <div class="dashboard-header">
        <h3>Appointments</h3>
        <ul class="header-list-btns">
            <li>
                <div class="input-block dash-search-input">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                </div>
            </li>
            <li>
                <div class="view-icons">
                    <a href="appointments.html" class="active"><i class="fa-solid fa-list"></i></a>
                </div>
            </li>
            <li>
                <div class="view-icons">
                    <a href="doctor-appointments-grid.html"><i class="fa-solid fa-th"></i></a>
                </div>
            </li>
            <li>
                <div class="view-icons">
                    <a href="#"><i class="fa-solid fa-calendar-check"></i></a>
                </div>
            </li>
        </ul>
    </div>
    <div class="appointment-tab-head">
        <div class="appointment-tabs">
            <ul class="nav nav-pills inner-tab " id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-upcoming-tab" data-bs-toggle="pill" data-bs-target="#pills-upcoming" type="button" role="tab" aria-controls="pills-upcoming" aria-selected="false">Upcoming<span>21</span></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-cancel-tab" data-bs-toggle="pill" data-bs-target="#pills-cancel" type="button" role="tab" aria-controls="pills-cancel" aria-selected="true">Cancelled<span>16</span></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-complete-tab" data-bs-toggle="pill" data-bs-target="#pills-complete" type="button" role="tab" aria-controls="pills-complete" aria-selected="true">Completed<span>214</span></button>
                </li>
            </ul>
        </div>
        <div class="filter-head">
            <div class="position-relative daterange-wraper me-2">
                <div class="input-groupicon calender-input">
                    <input type="text" class="form-control  date-range bookingrange" placeholder="From Date - To Date ">
                </div>
                <i class="fa-solid fa-calendar-days"></i>
            </div>
            <div class="form-sorts dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" id="table-filter"><i class="fa-solid fa-filter me-2"></i>Filter By</a>
                <div class="filter-dropdown-menu">
                    <div class="filter-set-view">
                        <div class="accordion" id="accordionExample">
                            <div class="filter-set-content">
                                <div class="filter-set-content-head">
                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Name<i class="fa-solid fa-chevron-right"></i></a>
                                </div>
                                <div class="filter-set-contents accordion-collapse collapse show" id="collapseTwo" data-bs-parent="#accordionExample">
                                    <ul>
                                        <li>
                                            <div class="input-block dash-search-input w-100">
                                                <input type="text" class="form-control" placeholder="Search">
                                                <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-set-content">
                                <div class="filter-set-content-head">
                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Appointment Type<i class="fa-solid fa-chevron-right"></i></a>
                                </div>
                                <div class="filter-set-contents accordion-collapse collapse show" id="collapseOne" data-bs-parent="#accordionExample">
                                    <ul>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">All Type</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">Video Call</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">Audio Call</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">Chat</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">Direct Visit</span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-set-content">
                                <div class="filter-set-content-head">
                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Visit Type<i class="fa-solid fa-chevron-right"></i></a>
                                </div>
                                <div class="filter-set-contents accordion-collapse collapse show" id="collapseThree" data-bs-parent="#accordionExample">
                                    <ul>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">All Visit</span>
                                                </label>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">General</span>
                                                </label>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">Consultation</span>
                                                </label>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">Follow-up</span>
                                                </label>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">Direct Visit</span>
                                                </label>
                                            </div>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="filter-reset-btns">
                            <a href="appointments.html" class="btn btn-light">Reset</a>
                            <a href="appointments.html" class="btn btn-primary">Filter Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-content appointment-tab-content">
        <div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel" aria-labelledby="pills-upcoming-tab">
            @foreach ($appointments as $appointment)
                <!-- Appointment List -->
                <div class="appointment-wrap">
                    <ul>
                        <li>
                            <div class="patinet-information">
                                <a href="doctor-upcoming-appointment.html">
                                    <img src={{ asset('img/doctors-dashboard/profile-01.jpg') }} alt="User Image">
                                </a>
                                <div class="patient-info">
                                    {{-- <p>#Apt0001</p> --}}
                                    <h6><a href="doctor-upcoming-appointment.html">{{ucwords($appointment->patient->name)}}</a></h6>
                                </div>
                            </div>
                        </li>
                        <li class="appointment-info">
                            <p><i class="fa-solid fa-calendar-days"></i>{{ date('d M Y, l', strtotime($appointment->appointment_date)) }}</p>
                            <p><i class="fa-solid fa-clock"></i>{{$appointment->timeSlot->slot_time}}</p>
                        </li>
                        <li class="mail-info-patient">
                            <ul>
                                <li><i class="fa-solid fa-envelope"></i>{{ optional($appointment->patient)->email ?? 'N/A' }}</li>
                                <li><i class="fa-solid fa-phone"></i>{{$appointment->patient->phone}}</li>
                            </ul>
                        </li>
                        <li class="appointment-action">
                            <ul>
                                <li>
                                    <a href="doctor-upcoming-appointment.html"><i class="fa-solid fa-eye"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-comments"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-xmark"></i></a>
                                </li>
                            </ul>
                        </li>
                        <li class="appointment-start">
                            <a href="doctor-appointment-start.html" class="start-link">Start Now</a>
                        </li>
                    </ul>
                </div>
                <!-- /Appointment List -->
            @endforeach


            <!-- Pagination -->
            <div class="pagination dashboard-pagination">
                <ul>
                    <li>
                        <a href="#" class="page-link"><i class="fa-solid fa-chevron-left"></i></a>
                    </li>
                    <li>
                        <a href="#" class="page-link">1</a>
                    </li>
                    <li>
                        <a href="#" class="page-link active">2</a>
                    </li>
                    <li>
                        <a href="#" class="page-link">3</a>
                    </li>
                    <li>
                        <a href="#" class="page-link">4</a>
                    </li>
                    <li>
                        <a href="#" class="page-link">...</a>
                    </li>
                    <li>
                        <a href="#" class="page-link"><i class="fa-solid fa-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
            <!-- /Pagination -->

        </div>
        <div class="tab-pane fade" id="pills-cancel" role="tabpanel" aria-labelledby="pills-cancel-tab">
            <!-- Appointment List -->
            <div class="appointment-wrap">
                <ul>
                    <li>
                        <div class="patinet-information">
                            <a href="doctor-cancelled-appointment.html">
                                <img src={{ asset('img/doctors-dashboard/profile-01.jpg') }} alt="User Image">
                            </a>
                            <div class="patient-info">
                                <p>#Apt0001</p>
                                <h6><a href="doctor-cancelled-appointment.html">Adrian</a></h6>
                            </div>
                        </div>
                    </li>
                    <li class="appointment-info">
                        <p><i class="fa-solid fa-clock"></i>11 Nov 2024 10.45 AM</p>
                        <ul class="d-flex apponitment-types">
                            <li>General Visit</li>
                            <li>Video Call</li>
                        </ul>

                    </li>
                    <li class="appointment-detail-btn">
                        <a href="doctor-cancelled-appointment.html" class="start-link">View Details</a>
                    </li>
                </ul>
            </div>
            <!-- /Appointment List -->
            <!-- Pagination -->
            <div class="pagination dashboard-pagination">
                <ul>
                    <li>
                        <a href="#" class="page-link"><i class="fa-solid fa-chevron-left"></i></a>
                    </li>
                    <li>
                        <a href="#" class="page-link">1</a>
                    </li>
                    <li>
                        <a href="#" class="page-link active">2</a>
                    </li>
                    <li>
                        <a href="#" class="page-link">3</a>
                    </li>
                    <li>
                        <a href="#" class="page-link">4</a>
                    </li>
                    <li>
                        <a href="#" class="page-link">...</a>
                    </li>
                    <li>
                        <a href="#" class="page-link"><i class="fa-solid fa-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
            <!-- /Pagination -->
        </div>
        <div class="tab-pane fade" id="pills-complete" role="tabpanel" aria-labelledby="pills-complete-tab">
            <!-- Appointment List -->
            <div class="appointment-wrap">
                <ul>
                    <li>
                        <div class="patinet-information">
                            <a href="doctor-completed-appointment.html">
                                <img src={{ asset('img/doctors-dashboard/profile-01.jpg') }} alt="User Image">
                            </a>
                            <div class="patient-info">
                                <p>#Apt0001</p>
                                <h6><a href="doctor-completed-appointment.html">Adrian</a></h6>
                            </div>
                        </div>
                    </li>
                    <li class="appointment-info">
                        <p><i class="fa-solid fa-clock"></i>11 Nov 2024 10.45 AM</p>
                        <ul class="d-flex apponitment-types">
                            <li>General Visit</li>
                            <li>Video Call</li>
                        </ul>

                    </li>
                    <li class="appointment-detail-btn">
                        <a href="doctor-completed-appointment.html" class="start-link">View Details</a>
                    </li>
                </ul>
            </div>
            <!-- /Appointment List -->

            <!-- Pagination -->
            <div class="pagination dashboard-pagination">
                <ul>
                    <li>
                        <a href="#" class="page-link"><i class="fa-solid fa-chevron-left"></i></a>
                    </li>
                    <li>
                        <a href="#" class="page-link">1</a>
                    </li>
                    <li>
                        <a href="#" class="page-link active">2</a>
                    </li>
                    <li>
                        <a href="#" class="page-link">3</a>
                    </li>
                    <li>
                        <a href="#" class="page-link">4</a>
                    </li>
                    <li>
                        <a href="#" class="page-link">...</a>
                    </li>
                    <li>
                        <a href="#" class="page-link"><i class="fa-solid fa-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
            <!-- /Pagination -->
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src={{ asset('js/bootstrap-datetimepicker.min.js') }}></script>
    <script src={{ asset('plugins/daterangepicker/daterangepicker.js') }}></script>
@endpush
