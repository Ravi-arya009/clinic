@extends('patient.layouts.main')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'Appointments Details')

@section('breadcrum-title', 'Appointments Details')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Appointments Details')

@push('stylesheets')
    <link rel="stylesheet" href={{ asset('plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}>
@endpush

@section('content')
    <!-- Page Content -->
    <div class="dashboard-header">
        <div class="header-back">
            <h3>Appointment Details</h3>
        </div>
    </div>
    <div class="appointment-details-wrap">

        <!-- Appointment Detail Card -->
        <div class="appointment-wrap appointment-detail-card">
            <ul>
                <li>
                    <div class="patinet-information">
                        <a href="#">
                            <img src={{ asset('img/doctors-dashboard/doctor-profile-img.jpg') }} alt="User Image">
                        </a>
                        <div class="patient-info">
                            <h6><a href="#">{{$appointment->doctor->name}} </a></h6>
                            <div class="mail-info-patient">
                                <ul>
                                    <li><i class="fa-solid fa-envelope"></i>{{ optional($appointment->doctor)->email ?? 'N/A' }}</li>
                                    <li><i class="fa-solid fa-phone"></i>{{ optional($appointment->doctor)->phone ?? 'N/A' }}</li>
                                    <li><i class="fas fa-map-marker-alt"></i>-</li>
                                    {{-- make address dynamic --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="appointment-info">
                    <div class="mail-info-patient">
                        <ul>
                            <li><i class="fa-solid fa-calendar-days"></i>{{ date('d M Y, l', strtotime($appointment->appointment_date)) }}</li>
                            <li><i class="fa-solid fa-clock"></i>{{ date('h:i A', strtotime($appointment->timeSlot->slot_time)) }}</li>
                        </ul>
                    </div>
                </li>
                <li class="appointment-action">
                    <div class="detail-badge-info">
                        <span class="badge bg-green">Completed</span>
                    </div>
                    <div class="consult-fees">
                        <h6>Consultation Fees : $200</h6>
                    </div>
                    <ul>
                        <li>
                            <a href="#"><i class="fa-solid fa-comments"></i></a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="detail-card-bottom-info">
                <li>
                    <h6>Clinic</h6>
                    <span>{{$appointment->clinic->name}}</span>
                </li>
                <li>
                    <h6>Clinic Address</h6>
                    <span>{{$appointment->clinic->address}}</span>
                </li>
                <li class="detail-badge-info">
                    <a href="#view_prescription" data-bs-toggle="modal" class="btn btn-primary prime-btn me-3">Download Prescription</a>
                    <a href="#" class="btn reschedule-btn btn-primary-border">Reschedule Appointment</a>
                </li>
            </ul>
        </div>
        <!-- /Appointment Detail Card -->
    </div>
@endsection
@section('modal')
    <!-- Appointment End Modal -->
    <div class="modal fade info-modal" id="end_session">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="success-wrap">
                        <div class="success-info">
                            <div class="text-center">
                                <span class="icon-success bg-blue"><i class="fa-solid fa-calendar-check"></i></span>
                                <h3>Session Ended</h3>
                                <p>Your Appointment has been Ended</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-btn text-center">
                        <a href="#" class="btn btn-gray" data-bs-toggle="modal" data-bs-dismiss="modal">Go to Appointments</a>
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#view_prescription" class="btn btn-primary prime-btn">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Appointment End Modal -->

    <!--View Prescription -->
    <div class="modal fade custom-modals" id="view_prescription">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">View Details</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <div class="prescribe-download">
                        <h5>21 Mar 2024</h5>
                        <ul>
                            <li><a href="javascript:void(0);" class="print-link"><i class="fa-solid fa-print"></i></a></li>
                            <li><a href="#" class="btn btn-primary prime-btn">Download</a></li>
                        </ul>
                    </div>
                    <div class="view-prescribe-details">
                        <div class="hospital-addr">
                            <div class="invoice-logo">
                                <img src={{ asset('img/logo.png') }} alt="logo">
                            </div>
                            <h5>16, Wardlow, Buxton, Derbyshire, SK17 8RW. Phone : 01298 872268 </h5>
                            <p>Monday to Sunday - 09:30am to 12:00pm</p>
                        </div>

                        <!-- Invoice Item -->
                        <div class="invoice-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="invoice-info">
                                        <h6 class="customer-text">Dr Edalin Hendry</h6>
                                        <p>BDS, MDS - Oral & Maxillofacial Surgery</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="invoice-info2">
                                        <p><span>Date : </span>25 Jan 2024, 07:00</p>
                                        <p><span>Appointment Type : </span>Video</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="patient-id">
                                        <h6>Patient Details</h6>
                                        <div class="patient-det">
                                            <h6>Kelly Joseph</h6>
                                            <ul>
                                                <li>28Y / Male</li>
                                                <li>Blood : O+ve</li>
                                                <li>Patient / Consult ID : OP1245654 / C243546566 </li>
                                                <li>Type : Outpatient</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Invoice Item -->

                        <div class="appointment-notes">
                            <h3>Appointment Note</h3>
                        </div>
                        <div class="appoint-wrap">
                            <h5>Vitals</h5>
                            <ul>
                                <li><span>Pulse : </span> 64 Bpm</li>
                                <li><span>Systolic BP : </span>100mmHg</li>
                                <li><span>Diastolic : </span>60mmHg</li>
                                <li><span>Spo2 : </span>100%</li>
                                <li><span>BSA : </span>1.68</li>
                                <li><span>Height : </span>159 cm</li>
                                <li><span>Weight : </span>64 Kg</li>
                                <li><span>Patient Direct from : </span>Walk in / OPD</li>
                                <li><span>Body Mass Index : </span>25.16 BMI</li>
                                <li><span>Allergies : </span>Pain near left chest, Pelvic salinity</li>
                            </ul>
                        </div>
                        <div class="appoint-wrap">
                            <h5>Previous Medical History</h5>
                            <p>The patient has a history of type 2 diabetes mellitus diagnosed in 2018, well-controlled on metformin. Additionally, the patient underwent appendectomy in 2020 without postoperative complications.</p>
                        </div>
                        <div class="appoint-wrap">
                            <h5>Clinical Notes</h5>
                            <p>The patient presents with a 3-day history of worsening cough and fever, peaking at 38.5°C, noted for decreased appetite. Physical examination reveals bilateral wheezing and crackles on lung auscultation, suggestive of a respiratory infection.</p>
                        </div>
                        <div class="appoint-wrap">
                            <h5>Complaint</h5>
                            <p>An account of the present illness, which includes the circumstances surrounding the onset of recent health changes and the chronology of subsequent events that have led the patient to seek medi</p>
                        </div>
                        <div class="appoint-wrap">
                            <h5>Medications</h5>
                            <p>The patient has a history of type 2 diabetes mellitus diagnosed in 2018, well-controlled on metformin. Additionally, the patient underwent appendectomy in 2020 without postoperative complications.</p>
                        </div>
                        <div class="appoint-wrap">
                            <h5>Advice</h5>
                            <p>An account of the present illness, which includes the circumstances surrounding the onset of recent health changes and the chronology of subsequent events that have led the patient to seek medicine</p>
                        </div>
                        <div class="appoint-wrap">
                            <h5>Lab Tests</h5>
                            <p class="mb-0">1. Liver Function Tests (LFTs)</p>
                            <p>2. Hemoglobin A1c (HbA1c)</p>
                        </div>
                        <div class="appoint-wrap">
                            <h5>Follow Up</h5>
                            <p class="mb-0">After 3 Months in empty Stomach</p>
                            <p>Lab test for Glucose Level</p>
                        </div>


                        <!-- Invoice Item -->
                        <div class="invoice-item invoice-table-wrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive inv-table">
                                        <table class="invoice-table table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SNO</th>
                                                    <th>Medecine Name</th>
                                                    <th>Dosage</th>
                                                    <th>Frequency</th>
                                                    <th>Duration</th>
                                                    <th>Timings</th>
                                                    <th>Instruction</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Ecosprin 75MG [Asprin 75 MG Oral Tab]</td>
                                                    <td>75 mg <span>Oral Tab</span></td>
                                                    <td>1-0-0-1</td>
                                                    <td>1 month</td>
                                                    <td>Before Meal</td>
                                                    <td>Take in alternate das, with hot water</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Alexer 90MG Tab</td>
                                                    <td>90 mg <span>Oral Tab</span></td>
                                                    <td>1-0-0-1</td>
                                                    <td>1 month</td>
                                                    <td>Before Meal</td>
                                                    <td>Take in alternate das, with hot water</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Ramistar XL2.5</td>
                                                    <td>60 mg <span>Oral Tab</span></td>
                                                    <td>1-0-0-0</td>
                                                    <td>1 month</td>
                                                    <td>After Meal</td>
                                                    <td>Take in alternate das, with hot water</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Metscore</td>
                                                    <td>90 mg <span>Oral Tab</span></td>
                                                    <td>1-0-0-1</td>
                                                    <td>1 month</td>
                                                    <td>After Meal</td>
                                                    <td>Take in alternate das, with hot water</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Invoice Item -->

                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="scan-wrap">
                                    <h6>Scan to download report</h6>
                                    <img src={{ asset('img/scan.png') }} alt="scan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="prescriber-info">
                                    <h6>Dr. Edalin Hendry</h6>
                                    <p>Dept of Cardiology</p>
                                </div>
                            </div>
                        </div>

                        <ul class="nav inv-paginate justify-content-center">
                            <li>Page 01 of 02</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /View Prescription -->
@endsection

@push('scripts')
    <script src={{ asset('plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}></script>
@endpush
