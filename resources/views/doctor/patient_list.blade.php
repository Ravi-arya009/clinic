@php
    $pageTitle = 'Patient List';
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
                <th>Name</th>
                <th>Location</th>
                <th>Contact Person</th>
                <th>Action</th>
            </tr>
        </thead>

        @foreach ($patients as $patient)
            <tr class="table-appointment-wrap">
                <td class="patinet-information">
                    @if ($patient->profile_image == null)
                        <img src="{{ asset('img/bg/ring-1.png') }}" alt="User Image">
                    @else
                        <img src="{{ asset('storage/profile_images/' . $patient->profile_image) }}" alt="User Image">
                    @endif
                    <div class="patient-info">
                        {{-- <p>#Apt0001</p> --}}
                        <h6>{{ $patient->name }}</h6>
                    </div>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        <li>{{ isset($patient->address) ? ucfirst($patient->address) : 'N/A' }}</li>
                        <li>{{ isset($patient->city) ? ucfirst($patient->city['name']) : 'N/A' }}</li>
                    </ul>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        <li><i class="fa-solid fa-phone"></i>{{ $patient->phone }}</li>
                        <li><i class="fa-solid fa-brands fa-whatsapp"></i>{{ $patient->whatsapp ?? 'N/A' }}</li>
                    </ul>
                </td>
                <td class="appointment-start">
                    <a href="{{ route('doctor.patient.show', ['patientId' => $patient->id]) }}" class="start-link">Edit</a>
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
            dom: 'rt<"bottom d-flex justify-content-end pt-4"p>',
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
