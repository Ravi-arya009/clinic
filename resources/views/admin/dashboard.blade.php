{{-- {{dd($user->profile_image)}} --}}

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
                        <h6>Total Users</h6>
                        <h4>{{ $totalUserCount }}</h4>
                    </div>
                    <div class="dashboard-widget-icon">
                        <span class="dash-icon-box"><i class="fa-solid fa-user"></i></span>
                    </div>
                </div>
                <div class="dashboard-widget-box">
                    <div class="dashboard-content-info">
                        <h6>Total Doctors</h6>
                        <h4>{{ $totalDoctorCount }}</h4>
                    </div>
                    <div class="dashboard-widget-icon">
                        <span class="dash-icon-box"><i class="fa-solid fa-user-doctor"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 d-flex">
            <div class="dashboard-card w-100">
                <div class="dashboard-card-head">
                    <div class="header-title">
                        <h5>Recent Appointments</h5>
                    </div>
                </div>
                <div class="dashboard-card-body">
                    <div class="table-responsive">
                        <table class="table dashboard-table appoint-table">
                            <tbody>
                                {{-- {{dd($upcomingAppointments)}} --}}
                                @foreach ($upcomingAppointments as $appointment)
                                    <tr>
                                        <td>
                                            <div class="patient-info-profile">
                                                <a href="appointments.html" class="table-avatar">
                                                    @if (isset($appointment->patient->profile_image))
                                                        <img src="{{ asset('storage/profile_images/' . $appointment->patient->profile_image) }}" alt="Profile Picture">
                                                    @else
                                                        <img src="{{ asset('img/default-profile-picture.webp') }}" alt="Default Profile Picture">
                                                    @endif
                                                </a>
                                                <div class="patient-name-info">
                                                    <h5><a href="appointments.html">{{ $appointment->patient->name }}</a></h5>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="appointment-date-created">
                                                <h6>{{ date('d M Y', strtotime($appointment->appointment_date)) }}, {{ date('h:i A', strtotime($appointment->timeSlot->slot_time)) }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="apponiment-actions d-flex align-items-center">
                                                <a href="#" class="text-info-icon me-2"><i class="fa-solid fa-eye"></i></a>
                                                <a href="{{ route('admin.appointment.show', ['appointmentId' => $appointment->id]) }}" class="text-success-icon"><i class="fa-solid fa-arrow-right"></i></a>
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
        {{-- <div class="col-xl-5 d-flex">
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
        </div> --}}
    </div>
    </div>
@endsection
