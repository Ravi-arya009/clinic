@php
    $pageTitle = 'Appointments';
@endphp
@extends('doctor.layouts.main')
@section('title', $pageTitle)
@section('breadcrum-title', $pageTitle)
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', $pageTitle)

@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
@endpush

@section('content')

    <x-page-header :pageContentTitle="$pageTitle" :search="true" />

    <table class="my-datatable table-hover">
        <thead>
            <tr>
                <th>Contact Person</th>
                <th>Booked For</th>
                <th>Appointment type</th>
                <th>Patient</th>
                <th>Date / Time</th>
                <th>Action</th>
            </tr>
        </thead>

        @foreach ($appointments as $appointment)
            <tr class="table-appointment-wrap">
                <td class="patinet-information">
                    <img src="{{ asset('img/doctors-dashboard/profile-0' . rand(1, 8) . '.jpg') }}" alt="User Image">
                    <div class="patient-info">
                        <h6>{{ ucwords($appointment->patient->name) }}</h6>
                        <ul>
                            <li><i class="fa-solid fa-phone"></i>{{ $appointment->patient->phone }}</li>
                        </ul>
                    </div>

                </td>
                <td class="mail-info-patient">
                    <ul>
                        @if ($appointment->dependant_id)
                            <li><span class="badge badge-info table-badge">Family</span></li>
                        @else
                            <li><span class="badge badge-green table-badge">Self</span></li>
                        @endif
                    </ul>
                </td>
                 <td class="mail-info-patient">
                    <ul>
                        @if ($appointment->appointment_type == 1)
                            <li><span class="badge badge-info table-badge">Online</span></li>
                        @else
                            <li><span class="badge badge-green table-badge">Walk-in</span></li>
                        @endif
                    </ul>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        @if ($appointment->dependant_id)
                            <li>{{ optional($appointment->dependant)->name ?? 'N/A' }}</li>
                            <li><i class="fa-solid fa-phone"></i>{{ optional($appointment->patient)->phone ?? 'N/A' }}</li>
                        @else
                            <li>{{ optional($appointment->patient)->name ?? 'N/A' }}</li>
                            <li><i class="fa-solid fa-phone"></i>{{ optional($appointment->patient)->phone ?? 'N/A' }}</li>
                        @endif
                    </ul>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        <li><i class="fa-solid fa-calendar"></i>{{ date('d M Y, l', strtotime($appointment->appointment_date)) }}</li>
                        <li><i class="fa-solid fa-clock"></i>{{ date('h:i A', strtotime($appointment->timeSlot->slot_time)) }}</li>
                    </ul>
                </td>
                <td class="appointment-start">
                    <a href="{{ route('doctor.appointment.show', ['appointmentId' => $appointment->id]) }}" class="start-link">View</a>
                </td>
            </tr>
        @endforeach
    </table>

@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script>
        var table = $('.my-datatable').DataTable({
            lengthChange: false,
            searching: true,
            dom: 'rt<"bottom"ip>',
            dom: 'rt<"bottom d-flex justify-content-end pt-4"p>'
        });

        $('.customSearch').on('keyup', function() {
            $('#clinic-table').DataTable().search($(this).val()).draw();
        });

        $('.customSearch').on('input', function() {
            if ($(this).val().trim() !== '') {
                $('.fa-magnifying-glass').addClass('hide');
                $('.fa-xmark').removeClass('hide');
                table.search(this.value).draw();
            } else {
                $('.fa-magnifying-glass').removeClass('hide');
                $('.fa-xmark').addClass('hide');
                table.search('').draw();
            }
        });

        $('.fa-xmark').on('click', function() {
            $('.customSearch').val('');
            table.search('').draw();
            $('.fa-magnifying-glass').removeClass('hide');
            $(this).addClass('hide');
        });
    </script>
@endpush
