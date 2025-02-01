@extends('super_admin.layouts.main')

@section('title', 'Clinic List')

@section('breadcrum-title', 'Clinic List')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Clinic List')

@section('content')

    <div class="dashboard-header">
        <h3>Clinic List</h3>
        <ul class="header-list-btns">
            <li>
                <div class="input-block dash-search-input">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                </div>
            </li>
        </ul>
    </div>
    <div class="appointment-tab-head">
        <div class="appointment-tabs">
            <ul class="nav nav-pills inner-tab " id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-upcoming-tab" data-bs-toggle="pill" data-bs-target="#pills-upcoming" type="button" role="tab" aria-controls="pills-upcoming" aria-selected="false">Active<span>{{ $clinicCount }}</span></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-cancel-tab" data-bs-toggle="pill" data-bs-target="#pills-cancel" type="button" role="tab" aria-controls="pills-cancel" aria-selected="true">Inactive<span>0</span></button>
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
            <!-- Clinic List -->
            @foreach ($clinics as $clinic)
                <div class="appointment-wrap">
                    <ul>
                        <li>
                            <div class="patinet-information">
                                <a href="doctor-upcoming-appointment.html">
                                    <img src="{{ asset('img/bg/ring-1.png') }}" alt="User Image">
                                </a>
                                <div class="patient-info">
                                    <h6><a href="doctor-upcoming-appointment.html">{{ $clinic->name }}</a></h6>
                                </div>
                            </div>
                        </li>
                        <li class="appointment-info">
                            <p class="fw-bold">Contact Person</p>
                            <p>{{ isset($clinic) ? ucfirst($clinic->contact_person) : 'N/A'}}</p>
                        </li>
                        <li class="mail-info-patient">
                            <ul>
                                <li><i class="fa-solid fa-envelope"></i>adran@example.com</li>
                                <li><i class="fa-solid fa-phone"></i>{{ $clinic->contact_person_phone ?? 'N/A' }}</li>
                            </ul>
                        </li>
                        <li class="appointment-action">
                            <ul>
                                <li>
                                    <a href="{{ route('clinic.landing', ['clinicSlug' => $clinic->slug]) }}" target="_blank"><i class="fa-solid fa-globe"></i></a>
                                </li>
                            </ul>
                        </li>
                        <li class="appointment-start">
                            <a href="{{ route('super_admin.clinic.show', ['clinicId' => $clinic->id]) }}" class="start-link">Edit</a>
                        </li>

                        <li class="appointment-start">
                            <a href="{{ route('admin.dashboard', ['clinicSlug' => $clinic->slug]) }}" class="text-info" target="_blank">Visit Admin</a>
                        </li>
                    </ul>
                </div>
            @endforeach
            <!-- /Clinic List -->
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


        {{-- this tab left for future use --}}
        <div class="tab-pane fade" id="pills-cancel" role="tabpanel" aria-labelledby="pills-cancel-tab">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Note!</strong> Left for Future use.
            </div>
        </div>
    </div>

@endsection
