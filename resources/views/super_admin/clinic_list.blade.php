@extends('global.layouts.app')

@section('title', 'Clinic List')

@section('breadcrum-title', 'Clinic List')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Clinic List')

@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
@endpush

@section('sidebar')
    @include('super_admin.partials.sidebar')
@endsection

@section('content')

    <div class="dashboard-header">
        <h3>Clinic List</h3>
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
        <thead class="my-table-hover">
            <tr>
                <th>Name</th>
                <th>
                    Location
                </th>
                <th>Contact Person</th>
                <th>Actions</th>
            </tr>
        </thead>
        @foreach ($clinics as $clinic)
            <tr class="table-appointment-wrap">
                <td class="patinet-information">
                    @if ($clinic->logo == null)
                        <img src="{{ asset('img/bg/ring-2.png') }}" alt="User Image">
                    @else
                        <img src="{{ asset('storage/clinic_logos/' . $clinic->logo) }}" alt="User Image">
                    @endif

                    <div class="patient-info">
                        <h6>{{ $clinic->name }}</h6>
                    </div>
                </td>

                <td class="mail-info-patient">
                    <ul>
                        <li>{{ isset($clinic) ? ucfirst($clinic->area) : 'N/A' }}</li>
                        <li>{{ isset($clinic) ? ucfirst($clinic->city->name) : 'N/A' }}</li>
                    </ul>
                </td>

                <td class="mail-info-patient">
                    <ul>
                        <li><i class="fa fa-user"></i>{{ isset($clinic) ? ucfirst($clinic->contact_person) : 'N/A' }}</li>
                        <li><i class="fa fa-phone"></i>{{ $clinic->contact_person_phone ?? 'N/A' }}</li>
                    </ul>
                </td>
                <td class="appointment-start">
                    <a href="{{ route('clinic.landing', ['clinicSlug' => $clinic->slug]) }}" target="_blank" title="quick View"><i class="fa-solid fa-eye"></i></a>
                    <a class="ps-3" href="{{ route('super_admin.clinic.show', ['clinicId' => $clinic->id]) }}" class="start-link">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
    <hr>
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
