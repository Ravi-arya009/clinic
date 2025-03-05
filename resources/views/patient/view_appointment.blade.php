{{-- {{ dd($appointment) }} --}}
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
    <x-page-header pageContentTitle="Appointment Details" />
    <div class="appointment-details-wrap">
        <h4 class="fw-bold mb-3">
            Booking Details
        </h4>
        <!-- Appointment Detail Card -->
        <div class="appointment-wrap appointment-detail-card">
            <ul>
                <li>
                    <div class="patinet-information">
                        <a href="#">
                            @if ($appointment->doctor->profile_image == null)
                                <img src="{{ asset('img/bg/ring-1.png') }}" alt="User Image">
                            @else
                                <img src="{{ asset('storage/profile_images/' . $appointment->doctor->profile_image) }}" alt="User Image">
                            @endif

                        </a>
                        <div class="patient-info">
                            <h6><a href="#">Doctor Name: {{ $appointment->doctor->name }} </a></h6>
                            <div class="mail-info-patient">
                                <ul>
                                    <li><i class="fa-solid fa-phone"></i>{{ $appointment->doctor->phone ?? 'N/A' }}</li>
                                    <li><i class="fa-solid fa-brands fa-whatsapp"></i>{{ $appointment->doctor->whatsapp ?? 'N/A' }}</li>
                                    <li><i class="fa-solid fa-envelope"></i>{{ $appointment->doctor->email ?? 'N/A' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="patinet-information">
                        <div class="patient-info">
                            <h6><a href="#">Clinic Name: {{ $appointment->clinic->name }} </a></h6>
                            <div class="mail-info-patient">
                                <ul>
                                    <li><i class="fa-solid fa-phone"></i>{{ $appointment->clinic->phone ?? 'N/A' }}</li>
                                    <li><i class="fa-solid fa-brands fa-whatsapp"></i>{{ $appointment->clinic->whatsapp ?? 'N/A' }}</li>
                                    <li><i class="fa-solid fa-envelope"></i>{{ $appointment->clinic->email ?? 'N/A' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="patinet-information">
                        <ul>
                            <li>
                                <div class="patient-info">
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
                                </div>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="btn btn-sm btn-primary prime-btn  mb-2" data-bs-toggle="modal" data-bs-target="#end_session">Cancel Appointment</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="btn btn-sm btn-primary prime-btn" data-bs-toggle="modal" data-bs-target="#end_session">Reschedule Appointment</a>
                            </li>
                        </ul>
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
                    <span>Online</span>
                </li>
                <li>
                    <h6>Payment Method</h6>
                    <span>Online</span>
                </li>
                <li>
                    <h6>No of Visits</h6>
                    <span>0</span>
                </li>
                <li>
                    <div class="start-btn">
                        <a href="#" class="btn btn-secondary">History</a>
                    </div>
                </li>
            </ul>
        </div>
        <!-- /Appointment Detail Card -->
        <h4 class="fw-bold mb-3">Patient Information</h4>
        @if ($appointment->dependant_id != null)
            <div class="appointment-wrap appointment-detail-card">
                <ul>
                    <li class="appointment-info">
                        <div class="mail-info-patient">
                            <ul>
                                <li><span class="fw-bold">Name:</span> {{ $appointment->dependant->name }}</li>
                                <li><span class="fw-bold">Age:</span> {{ $appointment->dependant->dob ?? 'N/A' }}</li>
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
        @if ($appointment->status == 1)
            <div class="create-appointment-details">
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#view_prescription" class="btn btn-primary prime-btn float-end">View Prescription</a>
                <h5 class="head-text">Perscription</h5>
                <div class="create-details-card">
                    <div class="create-details-card-body">
                        <div class="start-appointment-set mb-3">
                            <div class="form-bg-title">
                                <h5>Clinical Notes</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-dark ms-2">
                                        {{ $appointment->appointmentDetails->notes }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="start-appointment-set mb-3">
                            <div class="form-bg-title">
                                <h5>Medications</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table-hover table-responsive table-dark w-100 mx-2">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th>Name</th>
                                                <th>Dosage</th>
                                                <th>Duration</th>
                                                <th>Instructions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark">
                                            @foreach ($appointment->medications as $medication)
                                                <tr class="table-appointment-wrap">
                                                    <td>{{ $medication->medicine->name }}</td>
                                                    <td>{{ $medication->dosage }}</td>
                                                    <td>{{ $medication->duration }}</td>
                                                    <td>{{ $medication->instructions }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="start-appointment-set mb-3">
                            <div class="form-bg-title">
                                <h5>Laboratory Tests</h5>
                            </div>
                            <div class="row meditation-row">
                                @foreach ($appointment->labTests as $appointmentLabTest)
                                    <div class="col-md-12" id="lab-test-row">
                                        <div class="d-flex flex-wrap medication-wrap align-items-center">
                                            <p class="ms-2">{{ $loop->index + 1 }}. {{ $appointmentLabTest->id }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="start-appointment-set mb-3">
                            <div class="form-bg-title">
                                <h5>Advice</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-dark ms-2">
                                        {{ $appointment->appointmentDetails->advice }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <x-Alert />
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
                    <span id="prescription">
                        @include('global.prescription')

                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- /View Prescription -->
@endsection

@push('scripts')
    <script src={{ asset('plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}></script>

    <script>
        $(document).ready(function() {
            $('#downloadPdfBtn').click(function() {
                var modalContent = $('#view_prescription .modal-body').html();

                $.ajax({
                    url: '{{ route('prescription.download') }}',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        html_content: modalContent,
                        appointment: "{{ json_encode($appointment) }}",
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(data) {
                        console.log(data);
                        var url = window.URL.createObjectURL(new Blob([data]));
                        var a = document.createElement('a');
                        a.href = url;
                        a.download = 'prescription.pdf';
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error downloading PDF:', error);
                    }
                });
            });
        });
    </script>
@endpush
