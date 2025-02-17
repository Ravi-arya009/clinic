@extends('admin.layouts.main')

@section('title', 'Dashboard')

@section('breadcrum-title', 'Dashboard')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-xl-4 d-flex">
            <div class="dashboard-box-col w-100">
                <div class="dashboard-widget-box">
                    <div class="dashboard-content-info">
                        <h6>Total Patient</h6>
                        <h4>978</h4>
                        <span class="text-success"><i class="fa-solid fa-arrow-up"></i>15% From Last Week</span>
                    </div>
                    <div class="dashboard-widget-icon">
                        <span class="dash-icon-box"><i class="fa-solid fa-user-injured"></i></span>
                    </div>
                </div>
                <div class="dashboard-widget-box">
                    <div class="dashboard-content-info">
                        <h6>Patients Today</h6>
                        <h4>80</h4>
                        <span class="text-danger"><i class="fa-solid fa-arrow-up"></i>15% From Yesterday</span>
                    </div>
                    <div class="dashboard-widget-icon">
                        <span class="dash-icon-box"><i class="fa-solid fa-user-clock"></i></span>
                    </div>
                </div>
                <div class="dashboard-widget-box">
                    <div class="dashboard-content-info">
                        <h6>Appointments Today</h6>
                        <h4>50</h4>
                        <span class="text-success"><i class="fa-solid fa-arrow-up"></i>20% From Yesterday</span>
                    </div>
                    <div class="dashboard-widget-icon">
                        <span class="dash-icon-box"><i class="fa-solid fa-calendar-days"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 d-flex">
            <div class="dashboard-card w-100">
                <div class="dashboard-card-head">
                    <div class="header-title">
                        <h5>Appointment</h5>
                    </div>
                </div>
                <div class="dashboard-card-body">
                    <div class="table-responsive">
                        <table class="table dashboard-table appoint-table">
                            <tbody>
                                @foreach ($upcomingAppointments as $appointment)
                                    <tr>
                                        <td>
                                            <div class="patient-info-profile">
                                                <a href="appointments.html" class="table-avatar">
                                                    <img src="{{ asset('img/doctors-dashboard/profile-0' . rand(1, 8) . '.jpg') }}" alt="Img">
                                                </a>
                                                <div class="patient-name-info">
                                                    <span>#Apt0001</span>
                                                    <h5><a href="appointments.html">{{ $appointment->patient->name }}</a></h5>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="appointment-date-created">
                                                <h6>{{ date('d M Y', strtotime($appointment->appointment_date)) }}, {{ date('h:i A', strtotime($appointment->timeSlot->slot_time)) }}</h6>
                                                <span class="badge table-badge">General</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="apponiment-actions d-flex align-items-center">
                                                <a href="#" class="text-success-icon me-2"><i class="fa-solid fa-check"></i></a>
                                                <a href="#" class="text-danger-icon"><i class="fa-solid fa-xmark"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-5 d-flex">
            <div class="dashboard-chart-col w-100">
                <div class="dashboard-card w-100">
                    <div class="dashboard-card-head">
                        <div class="header-title">
                            <h5>Recent Patients</h5>
                        </div>
                        <div class="card-view-link">
                            <a href="my-patients.html">View All</a>
                        </div>
                    </div>
                    <div class="dashboard-card-body">
                        <div class="d-flex recent-patient-grid-boxes">
                            @foreach ($upcomingAppointments as $appointment)
                                @if ($loop->index >= 2)
                                @break
                            @endif

                            <div class="recent-patient-grid">
                                <a href="patient-details.html" class="patient-img">
                                    <img src="{{ asset('img/doctors-dashboard/profile-0' . rand(1, 8) . '.jpg') }}" alt="Img">
                                </a>
                                <h5><a href="patient-details.html">{{ $appointment->patient->name }}</a></h5>
                                <span>Patient ID : P0001</span>
                                <div class="date-info">
                                    <p>Last Appointment {{ date('d M Y', strtotime($appointment->appointment_date)) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-7 d-flex">
        <div class="dashboard-main-col w-100">
            <div class="upcoming-appointment-card">
                <div class="title-card">
                    <h5>Upcoming Appointment</h5>
                </div>
                <div class="upcoming-patient-info">
                    <div class="info-details">
                        <span class="img-avatar"><img src="assets/img/doctors-dashboard/profile-01.jpg" alt="Img"></span>
                        <div class="name-info">
                            <span>#Apt0001</span>
                            <h6>Adrian Marshall</h6>
                        </div>

                    </div>
                    <div class="date-details">
                        <span>General visit</span>
                        <h6>Today, 10:45 AM</h6>
                    </div>
                    <div class="circle-bg">
                        <img src="assets/img/bg/dashboard-circle-bg.png" alt="Img">
                    </div>
                </div>
                <div class="appointment-card-footer">
                    <h5><i class="fa-solid fa-video"></i>Video Appointment</h5>
                    <div class="btn-appointments">
                        <a href="chat-doctor.html" class="btn">Chat Now</a>
                        <a href="doctor-appointment-start.html" class="btn">Start Appointment</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
