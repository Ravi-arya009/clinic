@php
    $pageTitle = 'Appointments Details';
@endphp
@extends('global.layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'Appointments Details')

@section('breadcrum-title', 'Appointments Details')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Appointments Details')

@push('stylesheets')
    <link rel="stylesheet" href={{ asset('plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}>
@endpush

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <!-- Page Content -->
    <x-page-header :pageContentTitle="$pageTitle" />
    <div class="appointment-details-wrap">
        <h4 class="fw-bold mb-3">
            Booking Details
        </h4>
        <!-- Appointment Detail Card -->
        <div class="appointment-wrap appointment-detail-card">
            <ul>
                <li>
                    <div class="patinet-information">
                        <a href="{{ route('doctor.patient.show', ['patientId' => $appointment->patient->id]) }}">
                            @if ($appointment->patient->profile_image == null)
                                <img src="{{ asset('img/bg/ring-1.png') }}" alt="User Image">
                            @else
                                <img src="{{ asset('storage/profile_images/' . $appointment->patient->profile_image) }}" alt="User Image">
                            @endif

                        </a>
                        <div class="patient-info text-black">
                            <span class="fw-bold">Contact Person:</span> {{ ucwords($appointment->patient->name) }}
                            <div class="mail-info-patient">
                                <ul>
                                    <li><i class="fa-solid fa-phone"></i>{{ $appointment->patient->phone ?? 'N/A' }}</li>
                                    <li><i class="fa-solid fa-brands fa-whatsapp"></i>{{ $appointment->patient->phone ?? 'N/A' }}</li>
                                    <li><i class="fa-solid fa-envelope"></i>{{ optional($appointment->patient)->email ?? 'N/A' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="appointment-info">
                    <div class="mail-info-patient">
                        <ul>
                            <li><span class="fw-bold">State:</span> {{ $appointment->patient->state->name ?? 'N/A' }}</li>
                            <li><span class="fw-bold">City:</span> {{ $appointment->patient->city->name ?? 'N/A' }}</li>
                            <li><span class="fw-bold">Address:</span> {{ $appointment->patient->address ?? 'N/A' }}</li>
                        </ul>
                    </div>
                </li>

                {{-- change status according to the appointment  status --}}
                <li class="appointment-action">
                    <div class="detail-badge-info">
                        @switch($appointment->status)
                            @case(0)
                                <span class="badge bg-yellow">Pending</span>
                            @break

                            @case(1)
                                <span class="badge bg-green">Completed</span>
                            @break

                            @default
                                <span class="badge bg-yellow">Pending</span>
                        @endswitch
                        @if ($appointment->status == 0)
                        @elseif ($appointment->status == 1)
                        @endif
                    </div>
                </li>
            </ul>
            <ul class="detail-card-bottom-info">
                <li>
                    <h6>Appointment Date & Time</h6>
                    <span>{{ date('d M Y', strtotime($appointment->appointment_date)) }} - {{ date('h:i A', strtotime($appointment->timeSlot->slot_time)) }}</span>
                </li>
                <li>
                    <h6>Booking Type</h6>
                    <span>{{ $appointment->booking_type == 1 ? 'Online' : 'Walk-in' }}</span>
                </li>
                <li>
                    <h6>Payment Method</h6>
                    @switch($appointment->payment_method)
                        @case(0)
                            <span>Pending</span>
                        @break

                        @case(1)
                            <span>Online</span>
                        @break

                        @case(2)
                            <span>Cash</span>
                        @break

                        @case(3)
                            <span>Part Payment</span>
                        @break
                    @endswitch
                </li>
                <li>
                    <h6>No of Visits</h6>
                    <span>{{ $appointmentCount }}</span>
                </li>
                <li>
                    <div class="start-btn">
                        <button class="btn btn-primary prime-btn custom-components" type="button" data-bs-toggle="modal" data-bs-target=".appointment-history-modal" data-bs-original-title="" title="">History</button>
                    </div>
                </li>
            </ul>
        </div>
        <!-- /Appointment Detail Card -->
        {{-- dependants information --}}
        <h4 class="fw-bold mb-3">Patient Information</h4>
        @if ($appointment->dependant_id != null)
            <div class="appointment-wrap appointment-detail-card">
                <ul>
                    <li class="appointment-info">
                        <div class="mail-info-patient">
                            <ul>
                                <li><span class="fw-bold">Name:</span> {{ $appointment->dependant->name }}</li>
                                <li><span class="fw-bold">Age:</span>
                                    @if ($appointment->dependant->dob)
                                        {{ \Carbon\Carbon::parse($appointment->dependant->dob)->age }}
                                    @else
                                        N/A
                                    @endif
                                </li>
                                <li><span class="fw-bold">Gender:</span> {{ $appointment->dependant->gender == 1 ? 'Male' : ($appointment->dependant->gender == 2 ? 'Female' : 'N/A') }}</li>
                            </ul>
                        </div>
                    </li>

                    <li class="appointment-info">
                        <div class="mail-info-patient">
                            <ul>
                                <li><span class="fw-bold">Phone:</span> {{ $appointment->dependant->phone ?? 'N/A' }}</li>
                                <li><span class="fw-bold">WhatsApp:</span> {{ $appointment->dependant->whatsapp ?? 'N/A' }}</li>
                                <li><span class="fw-bold">Email:</span> {{ $appointment->dependant->email ?? 'N/A' }}</li>
                            </ul>
                        </div>
                    </li>

                    <li class="appointment-info">
                        <div class="mail-info-patient">
                            <ul>
                                <li><span class="fw-bold">Relation:</span> {{ config('relations.' . $appointment->dependant->relation) ?? 'N/A' }}</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        @else
            <div class="appointment-wrap appointment-detail-card">
                <ul>
                    <li class="appointment-info">
                        <div class="mail-info-patient">
                            <ul>
                                <li><span class="fw-bold">Name:</span> {{ $appointment->patient->name }}</li>
                                <li><span class="fw-bold">Age:</span> {{ $appointment->patient->dob ?? 'N/A' }}</li>
                                <li><span class="fw-bold">Gender:</span> {{ $appointment->patient->gender == 1 ? 'Male' : ($appointment->patient->gender == 2 ? 'Female' : 'N/A') }}</li>
                            </ul>
                        </div>
                    </li>

                    <li class="appointment-info">
                        <div class="mail-info-patient">
                            <ul>
                                <li><span class="fw-bold">Phone:</span> {{ $appointment->patient->phone ?? 'N/A' }}</li>
                                <li><span class="fw-bold">WhatsApp:</span> {{ $appointment->patient->whatsapp ?? 'N/A' }}</li>
                                <li><span class="fw-bold">Email:</span> {{ $appointment->patient->email ?? 'N/A' }}</li>
                            </ul>
                        </div>
                    </li>

                    <li class="appointment-info">
                        <div class="mail-info-patient">
                            <ul>
                                <li><span class="fw-bold">Relation:</span> {{ 'Self' }}</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        @endif
        <!-- /Appointment Detail Card -->
        @if ($appointment->status != 0)
            <div class="create-appointment-details">
                <h5 class="head-text">Perscription</h5>
                <div class="create-details-card">
                    <div class="create-details-card-body">
                        <input type="hidden" value="{{ $appointment->id }}" name="appointment_id">
                        <div class="start-appointment-set">
                            <div class="form-bg-title">
                                <h5>Clinical Notes</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-block input-block-new">
                                        <textarea class="form-control" rows="3" name="notes">{{ $appointment->appointmentDetails->notes ?? old('notes') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="start-appointment-set">
                            <div class="form-bg-title">
                                <h5>Medications</h5>
                            </div>
                            <div class="row meditation-row">
                                @if ($appointment->medications->isEmpty())
                                    <div class="col-md-12" id="medicine-row">
                                        <div class="d-flex flex-wrap medication-wrap align-items-center">
                                            <div class="input-block input-block-new">
                                                <label class="form-label">Name</label>
                                                <select id="medicine_select2" class="form-control select2_dropdown" name="medicine_id[]">
                                                    <option selected>Select</option>
                                                    @foreach ($medicines as $medicine)
                                                        <option value="{{ $medicine->id }}" {{ in_array($medicine->id, old('medicine_id', [])) ? 'selected' : '' }}>
                                                            {{ $medicine->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="input-block input-block-new">
                                                <label class="form-label">Dosage</label>
                                                <input type="text" class="form-control" name="dosage[]"">
                                            </div>
                                            <div class="input-block input-block-new">
                                                <label class="form-label">Duration</label>
                                                <input type="text" class="form-control" placeholder="1-0-0" name="duration[]">
                                            </div>
                                            <div class="input-block input-block-new">
                                                <label class="form-label">Instruction</label>
                                                <input type="text" class="form-control" name="instructions[]">
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($appointment->medications as $medication)
                                        <div class="col-md-12" id="medicine-row">
                                            <div class="d-flex flex-wrap medication-wrap align-items-center">
                                                <div class="input-block input-block-new">
                                                    <label class="form-label">Name</label>
                                                    <select id="medicine_select2" class="form-control select2_dropdown" name="medicine_id[]">
                                                        @foreach ($medicines as $medicine)
                                                            <option value="{{ $medicine->id }}" {{ $medicine->id == $medication->medicine_id ? 'selected' : '' }}>
                                                                {{ $medicine->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="input-block input-block-new">
                                                    <label class="form-label">Dosage</label>
                                                    <input type="text" class="form-control" name="dosage[]" value="{{ old('dosage.' . $loop->index, $medication->dosage) }}">
                                                </div>
                                                <div class="input-block input-block-new">
                                                    <label class="form-label">Duration</label>
                                                    <input type="text" class="form-control" placeholder="1-0-0" name="duration[]" value="{{ old('duration.' . $loop->index, $medication->duration) }}">
                                                </div>
                                                <div class="input-block input-block-new">
                                                    <label class="form-label">Instruction</label>
                                                    <input type="text" class="form-control" name="instructions[]" value="{{ old('instructions.' . $loop->index, $medication->instructions) }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="start-appointment-set">
                            <div class="form-bg-title">
                                <h5>Laboratory Tests</h5>
                            </div>
                            <div class="row meditation-row">
                                @if ($appointment->labTests->isEmpty())
                                    <div class="col-md-12" id="lab-test-row">
                                        <div class="d-flex flex-wrap medication-wrap align-items-center">
                                            <div class="input-block input-block-new">
                                                <label class="form-label">Name</label>
                                                <select id="lab_test_select2" class="form-control select2_dropdown" name="lab_test_id[]">
                                                    <option selected>Select</option>
                                                    @foreach ($laboratoryTests as $test)
                                                        <option value="{{ $test->id }}" {{ in_array($test->id, old('lab_test_id', [])) ? 'selected' : '' }}>
                                                            {{ $test->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($appointment->labTests as $appointmentLabTest)
                                        <div class="col-md-12" id="lab-test-row">
                                            <div class="d-flex flex-wrap medication-wrap align-items-center">
                                                <div class="input-block input-block-new">
                                                    <label class="form-label">Name</label>
                                                    <select id="lab_test_select2" class="form-control select2_dropdown" name="lab_test_id[]">
                                                        <option selected>Select</option>
                                                        @foreach ($laboratoryTests as $laboratoryTest)
                                                            <option value="{{ $laboratoryTest->id }}" {{ $laboratoryTest->id == $appointmentLabTest->lab_test_id ? 'selected' : '' }}>
                                                                {{ $laboratoryTest->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="start-appointment-set">
                            <div class="form-bg-title">
                                <h5>Advice</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-block input-block-new">
                                        <textarea class="form-control" rows="3" name="advice">{{ $appointment->appointmentDetails->advice ?? old('advice') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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


    <!-- appointment history modal -->
    <div class="modal fade appointment-history-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel1">Previous Appointments</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                </div>
                <div class="modal-body">
                    <table class="table-hover my-datatable table-responsive w-100">
                        <thead>
                            <tr>
                                <th>Date / Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="appointment-history-body">
                            @foreach ($historicalAppointments as $historicalAppointment)
                                <tr class="table-appointment-wrap">
                                    <td class="mail-info-patient py-3 px-4">
                                        <ul>
                                            <li><i class="fa-solid fa-calendar"></i>{{ date('d M Y, l', strtotime($historicalAppointment->appointment_date)) }} {{ date('h:i A', strtotime($historicalAppointment->timeSlot->slot_time)) }}</li>
                                        </ul>
                                    </td>
                                    <td class="appointment-start py-3">
                                        <button type="button" data-appointment-id="{{ $historicalAppointment->id }}" class="start-link view-appointment-history btn btn-link p-0 border-0" style="background: none;"><i class="fa-solid fa-eye"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- appointment history modal -->

    <!-- view appointment history modal -->
    <div class="modal fade view-appointment-history-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel2">Appointment Details</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
                </div>
                <div class="modal-body" id="view-appointment-history-modal-body">
                    appointment history will come here.
                </div>
                <div class="modal-footer">
                    <button class="appointment_history_back_button btn btn-primary prime-btn" type="button"><i class="fa-solid fa-arrow-left"></i> Back</button>
                </div>
            </div>
        </div>
    </div>
    <!-- view appointment history modal -->
@endsection

@push('scripts')
    <script src={{ asset('plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}></script>
    <script>
        $(function() {
            $(".appointment_history_back_button").on('click', function() {
                $(".view-appointment-history-modal").modal('hide');
                $('.modal-backdrop').remove();
                setTimeout(function() {
                    $(".appointment-history-modal").modal('show');
                }, 200);
            });
            $(".view-appointment-history").on('click', function() {
                $(".appointment-history-modal").modal('hide');
                $('.modal-backdrop').remove();

                setTimeout(function() {
                    $(".view-appointment-history-modal").modal('show');
                }, 200);
                var appointment_id = $(this).data('appointment-id');

                $.ajax({
                    url: "{{ route('admin.fetchAppointmentDetails') }}",
                    type: "POST",
                    data: {
                        appointment_id: appointment_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#view-appointment-history-modal-body').html(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush
