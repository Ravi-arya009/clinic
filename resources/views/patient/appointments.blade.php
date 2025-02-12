@extends('patient.layouts.main')

@section('title', 'Appointments')

@section('breadcrum-title', 'Appointments')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Appointments')
@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
@endpush
@section('content')

    <div class="dashboard-header">
        <h3>Appointments</h3>
        <ul class="header-list-btns">
            <li>
                <div class="input-block dash-search-input">
                    <input type="text" class="form-control customSearch" placeholder="Search">
                    <span class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <i class="fa-solid fa-xmark hide" style="cursor: pointer;"></i>
                    </span>
                </div>
            </li>
        </ul>
    </div>

    <table class="my-datatable table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Appointment Date</th>
                <th>Contact</th>
                <th>Patient</th>
                <th>Action</th>
            </tr>
        </thead>

        @foreach ($appointments as $appointment)
            <tr class="table-appointment-wrap">
                <td class="patinet-information">
                    <img src="{{ asset('img/doctors-dashboard/profile-0' . rand(1, 8) . '.jpg') }}" alt="User Image">
                    <div class="patient-info">
                        <h6>{{ ucwords($appointment->doctor->name) }}</h6>
                        <p>{{ ucwords($appointment->clinic->name) }}</p>

                    </div>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        <li><i class="fa-solid fa-calendar"></i>{{ date('d M Y, l', strtotime($appointment->appointment_date)) }}</li>
                        <li><i class="fa-solid fa-clock"></i>{{ date('h:i A', strtotime($appointment->timeSlot->slot_time)) }}</li>
                    </ul>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        <li><i class="fa-solid fa-user-doctor"></i>{{ optional($appointment->doctor)->phone ?? 'N/A' }}</li>
                        <li><i class="fa-solid fa-house-chimney-medical"></i>{{ optional($appointment->doctor)->phone ?? 'N/A' }}</li>
                    </ul>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        <li>{{ optional($appointment->patient)->name ?? 'N/A' }}</li>
                        <li><i class="fa-solid fa-phone"></i>{{ $appointment->patient->phone }}</li>
                    </ul>
                </td>
                <td class="appointment-start">
                    <a href="{{route('patient.appointment.show',['appointmentId' => $appointment->id])}}" class="start-link">View</a>
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
