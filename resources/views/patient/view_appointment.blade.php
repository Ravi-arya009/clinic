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
                            {{-- <li>
                                <a href="javascript:void(0);" class="btn btn-sm btn-primary prime-btn  mb-2" data-bs-toggle="modal" data-bs-target="#end_session">Cancel Appointment</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="btn btn-sm btn-primary prime-btn" data-bs-toggle="modal" data-bs-target="#end_session">Reschedule Appointment</a>
                            </li> --}}
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
                    <span>{{ $appointment->appointment_type == 1 ? 'Online' : 'Walk-in' }}</span>
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
        @if ($appointment->status == 1)
            <div class="create-appointment-details">
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#view_prescription" class="btn btn-primary prime-btn float-end">View Prescription</a>
                <h5 class="head-text">Prescription</h5>
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
                                            <p class="ms-2">{{ $loop->index + 1 }}. {{ $appointmentLabTest->labTestMaster->name }}</p>
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
                    <span class="text-info text-center">This appointment is still pending.</span>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        $(document).on('click', '#downloadPdfBtn', function() {
            // Get the invoice content div
            const element = document.getElementById('prescription');

            // Define options for the PDF
            const options = {
                // margin: 10,
                filename: 'prescription.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            // Generate and download the PDF
            html2pdf().from(element).set(options).save();
        });

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
                url: "{{ route('patient.fetchAppointmentDetails') }}",
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
    </script>
@endpush
