@extends('doctor.layouts.main')

@section('title', 'Patient List')

@section('breadcrum-title', 'Patient List')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Patient List')
@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
@endpush
@section('content')

    <div class="dashboard-header">
        <h3>Patient List</h3>
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
                <th>Location</th>
                <th>Contact Person</th>
                <th>Action</th>
            </tr>
        </thead>

        @foreach ($patients as $patient)
        {{-- {{dd($patient)}} --}}
            <tr class="table-appointment-wrap">
                <td class="patinet-information">
                    <img src="{{ asset('img/doctors-dashboard/profile-0' . rand(1, 8) . '.jpg') }}" alt="User Image">
                    <div class="patient-info">
                        <p>#Apt0001</p>
                        <h6>{{ $patient->name }}</h6>
                    </div>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        <li>{{ isset($patient->area) ? ucfirst($patient->area) : 'N/A' }}</li>
                        <li>{{ isset($patient->city->name) ? ucfirst($patient->city->name) : 'N/A' }}</li>
                    </ul>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        <li><i class="fa-solid fa-phone"></i>{{ $patient->phone }}</li>
                        <li><i class="fa-solid fa-brands fa-whatsapp"></i>{{ $patient->whatsapp ?? 'N/A' }}</li>
                    </ul>
                </td>
                <td class="appointment-start">
                    <a href="{{ route('doctor.patient.show', ['patientId' => $patient->id])}}" class="start-link">Edit</a>
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
