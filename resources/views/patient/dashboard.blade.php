@extends('patient.layouts.main')

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
                        <h6>Family members</h6>
                        <h4>{{$familyMemberCount ?? 0}}</h4>
                    </div>
                    <div class="dashboard-widget-icon">
                        <span class="dash-icon-box"><i class="fa-solid fa-user"></i></span>
                    </div>
                </div>
                <div class="dashboard-widget-box">
                    <div class="dashboard-content-info">
                        <h6>Total Appointments</h6>
                        <h4>{{$totalDoctorAppointmentCount ?? 0}}</h4>
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
                                                    @if ($appointment->patient->profile_image == null)
                                                        <img src="{{ asset('img/bg/ring-1.png') }}" alt="User Image">
                                                    @else
                                                        <img src="{{ asset('storage/profile_images/' . $appointment->patient->profile_image) }}" alt="User Image">
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
                                                <a href="{{route('patient.appointment.show', ['appointmentId'=>$appointment->id])}}" class="text-success-icon"><i class="fa-solid fa-arrow-right"></i></a>
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
    </div>
    </div>
@endsection
