@extends('super_admin.layouts.main')

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
                        <h6>Total Clinics</h6>
                        <h4>{{ $totalClinics }}</h4>
                    </div>
                    <div class="dashboard-widget-icon">
                        <span class="dash-icon-box"><i class="fa-solid fa-house-chimney-medical"></i></span>
                    </div>
                </div>
                <div class="dashboard-widget-box">
                    <div class="dashboard-content-info">
                        <h6>Total Doctors</h6>
                        <h4>{{ $totalDoctors }}</h4>
                    </div>
                    <div class="dashboard-widget-icon">
                        <span class="dash-icon-box"><i class="fa-solid fa-user-doctor"></i></span>
                    </div>
                </div>
                <div class="dashboard-widget-box">
                    <div class="dashboard-content-info">
                        <h6>Total Patients</h6>
                        <h4>{{ $totalPatients }}</h4>
                    </div>
                    <div class="dashboard-widget-icon">
                        <span class="dash-icon-box"><i class="fa-solid fa-user-injured"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 d-flex">
            <div class="dashboard-card w-100">
                <div class="dashboard-card-head">
                    <div class="header-title">
                        <h5>Recent Clinics</h5>
                    </div>
                </div>
                <div class="dashboard-card-body">
                    <div class="table-responsive">
                        <table class="table dashboard-table appoint-table">
                            <tbody>
                                @if (count($recentClinics) == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            No Clinics Found
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($recentClinics as $clinic)
                                    <tr>
                                        <td>
                                            <div class="patient-info-profile">
                                                <span class="table-avatar">
                                                    <i class="fa-solid fa-house-chimney-medical text-info fs-3"></i>
                                                </span>
                                                <div class="patient-name-info">
                                                    <h5>{{ $clinic->name }}</h5>
                                                    <span>{{ $clinic->city->name }}, {{ $clinic->area }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="appointment-date-created">
                                                <span class="badge table-badge"><i class="fa-solid fa-phone"></i></span>
                                                <div class="patient-name-info d-inline-block">
                                                    <span class="text-black">{{ $clinic->phone }}</span>
                                                </div>
                                            </div>
                                            <div class="appointment-date-created">
                                                <span class="badge table-badge"><i class="fa-solid fa-user"></i></span>
                                                <div class="patient-name-info d-inline-block">
                                                    <span class="text-black">{{ $clinic->contact_person_phone }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="apponiment-actions d-flex align-items-center">
                                                <a href="#" class="text-info-icon me-2"><i class="fa-solid fa-eye"></i></a>
                                                <a href="{{ route('super_admin.clinic.show', ['clinicId' => $clinic->id]) }}" class="text-success-icon"><i class="fa-solid fa-arrow-right"></i></a>
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
@endsection
