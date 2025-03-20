@php
    $pageTitle = 'Dashboard';
@endphp
@extends('doctor.layouts.main')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', $pageTitle)
@section('breadcrum-title', $pageTitle)
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', $pageTitle)
@push('stylesheets')
    <style>
        .table_btn_prime {
            color: white !important;
            text-decoration: none !important;
        }

        .table_btn_prime:hover {
            color: #0E82FD !important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-xl-4 d-flex">
            <div class="dashboard-box-col w-100">
                <div class="dashboard-widget-box">
                    <div class="dashboard-content-info">
                        <h6>Total Patients</h6>
                        <h4>{{ $totalPatientCount }}</h4>
                    </div>
                    <div class="dashboard-widget-icon">
                        <span class="dash-icon-box"><i class="fa-solid fa-user"></i></span>
                    </div>
                </div>
                <div class="dashboard-widget-box">
                    <div class="dashboard-content-info">
                        <h6>Total Appointments</h6>
                        <h4>{{ $totalDoctorAppointmentCount }}</h4>
                    </div>
                    <div class="dashboard-widget-icon">
                        <span class="dash-icon-box"><i class="fa-solid fa-user-doctor"></i></span>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary prime-btn mx-auto" id="addNewPatient">New Appointment</button>
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
                                                <a href="{{ route('doctor.appointment.show', ['appointmentId' => $appointment->id]) }}" class="text-success-icon"><i class="fa-solid fa-arrow-right"></i></a>
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

@section('modal')
    <div class="modal fade custom-modal custom-modal-two modal-xl" id="dependants_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Family Members</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span><i class="fa-solid fa-x"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="my-datatable table-hover w-100" id="dependant-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Relation</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="table-appointment-wrap">
                                <td class="mail-info-patient">
                                    <ul>
                                        <li>Dependant Name</li>
                                    </ul>
                                </td>
                                <td class="mail-info-patient">
                                    <ul>
                                        <li>Dependant Phone</li>
                                    </ul>
                                </td>
                                <td class="mail-info-patient">
                                    <ul>
                                        <li>Relation</li>
                                    </ul>
                                </td>
                                <td class="appointment-start">
                                    <button class="btn btn-primary prime-btn" type="button">Booking for Self</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-set-button mt-3">
                        <a id="add_family_member_button" href="#" data-patientId="" class="btn btn-warning me-3" data-bs-toggle="modal" data-bs-target="#add_dependent">Add Family Member</a>
                        <a id="booking_for_self" href="#" class="btn btn-primary prime-btn">Booking for Self</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- booking for modal --}}
    <div class="modal fade info-modal" id="booking_for_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="success-wrap">
                        <div class="success-info">
                            <div class="text-center">
                                <span class="icon-success bg-my-blue"><i class="fa-solid fa-exclamation"></i></span>
                                <h3>Booking for</h3>
                                <p>Patient is already register. For whom this appoinment is for?</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-btn text-center">
                        <a id="booking_for_self_modal_button" href="#" class="btn btn-primary prime-btn px-5">Self</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_dependent" class="btn btn-primary prime-btn px-5" id="booking_for_someone_else_modal_button" data-patientId="">Someone Else</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- add dependant modal --}}
    <div class="modal fade custom-modals" id="add_dependent">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form id="add_dependant_form" action="#" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add Dependant</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="add-dependent">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-wrap">
                                        <label class="col-form-label">Name</label>
                                        <input type="text" class="form-control" name="dependant_name" id="dependant_name" value="{{ old('dependant_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-wrap">
                                        <label class="col-form-label">Phone</label>
                                        <input type="text" class="form-control" name="dependant_phone" id="dependant_phone" value="{{ old('dependant_phone') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-wrap">
                                        <label class="col-form-label">WhatsApp</label>
                                        <input type="text" class="form-control" name="dependant_whatsapp" id="dependant_whatsapp" value="{{ old('dependant_whatsapp') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-wrap">
                                        <label class="col-form-label">Email</label>
                                        <input type="text" class="form-control" name="dependant_email" id="dependant_email" value="{{ old('dependant_email') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-wrap">
                                        <label class="col-form-label">Date Of Birth</label>
                                        <div class="form-icon">
                                            <input type="date" id="dependant_dob" name="dependant_dob" class="form-control" value="{{ old('dependant_dob') }}">
                                            <span class="icon"><i class="fa-regular fa-calendar-days"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-wrap">
                                        <label class="col-form-label">Select Gender</label>
                                        <select name="dependant_gender" id="dependant_gender" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1" {{ old('dependant_gender') }}>Male</option>
                                            <option value="2" {{ old('dependant_gender') }}>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-wrap">
                                        <label class="col-form-label">Select Relation</label>
                                        <select name="dependant_relation" id="dependant_relation" class="form-control">
                                            <option value="">Select</option>
                                            @foreach (config('relations') as $key => $relation)
                                                <option value="{{ $key }}" {{ old('dependant_relation') == $key ? 'selected' : '' }}>{{ $relation }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="modal-btn text-end">
                            <a href="#" class="btn btn-gray" data-bs-toggle="modal" data-bs-dismiss="modal">Cancel</a>
                            <button class="btn btn-primary prime-btn">Save Changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {

            $('#add_dependant_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                var patientId = $("#booking_for_someone_else_modal_button").attr('data-patientId');
                if (patientId == null || patientId == '') {
                    var patientId = $("#add_family_member_button").attr('data-patientId');
                }
                console.log(patientId);
                formData.append('patientId', patientId)
                $.ajax({
                    url: "{{ route('ajax.addDependant') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            let dependantBaseUrl = "{{ route('createWalkInAppointment', ['patientId' => 1, 'dependantId' => 1]) }}";
                            let dependantUrl = dependantBaseUrl.replace("/1/1", "/" + patientId + "/" + response.dependant.id);
                            window.location.href = dependantUrl;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr, status, error);

                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        // Create a formatted list of validation errors
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();
                        $.each(errors, function(key, value) {
                            errorMessage += `• ${value[0]}<br>`;
                            var inputField = $('#' + key);
                            inputField.addClass('is-invalid');
                            inputField.after('<div class="invalid-feedback">' + value[0] + '</div>');
                        });
                    }
                });
            });

            $("#addNewPatient").on('click', function() {
                Swal.fire({
                    title: "Adding New Patient",
                    inputLabel: 'Enter phone number',
                    input: 'text',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return "Phone number is required!";
                        }
                        const phoneRegex = /^(\+91|91)?\d{10}$/;
                        if (!phoneRegex.test(value)) {
                            return "Invalid phone number.";
                        }
                    }
                }).then((result) => {
                    $.ajax({
                        url: "{{ route('patientPhoneNumberCheck') }}",
                        type: "GET",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            phone: result.value
                        },
                        success: function(response) {
                            console.log(response);
                            if (response == 0) {
                                window.location.href = "{{ route('doctor.patient.create') }}?phone=" + result.value;
                            }
                            switch (response.dependants) {
                                case 0:

                                    var patientId = response.patientId;
                                    var baseUrl = "{{ route('createWalkInAppointment', ['patientId' => 1]) }}";
                                    var newUrl = baseUrl.replace("/1", "/" + patientId);
                                    $("#booking_for_self_modal_button").attr("href", newUrl);
                                    $("#booking_for_someone_else_modal_button").attr('data-patientId', patientId);
                                    $("#booking_for_modal").modal('show');

                                    break;

                                case 1:
                                    var patientId = response.patientId;
                                    var baseUrl = "{{ route('createWalkInAppointment', ['patientId' => 1]) }}";
                                    var newUrl = baseUrl.replace("/1", "/" + patientId);
                                    $("#booking_for_self").attr("href", newUrl);
                                    $("#add_family_member_button").attr('data-patientId', patientId);

                                    $('#dependant-table tbody').empty();
                                    $.each(response.data, function(index, value) {
                                        let dependantBaseUrl = "{{ route('createWalkInAppointment', ['patientId' => 1, 'dependantId' => 1]) }}";
                                        let dependantUrl = dependantBaseUrl.replace("/1/1", "/" + patientId + "/" + value.id);

                                        var row = $('<tr class="table-appointment-wrap">');
                                        row.append('<td class="mail-info-patient"><ul><li>' + value.name + '</li></ul></td>');
                                        row.append('<td class="mail-info-patient"><ul><li>' + value.phone + '</li></ul></td>');
                                        row.append('<td class="mail-info-patient"><ul><li>' + value.relation + '</li></ul></td>');
                                        row.append('<td class="appointment-start"><a href="' + dependantUrl + '" class="btn prime-btn table_btn_prime">Book</a></td>');
                                        $('#dependant-table tbody').append(row);
                                    });
                                    $("#dependants_modal").modal('show');
                                    break;

                                default:
                                    break;
                            }
                        }
                    });
                });
            });
        });
    </script>
@endpush
