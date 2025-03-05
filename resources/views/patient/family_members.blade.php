@extends('patient.layouts.main')

@section('title', 'Invoices')

@section('breadcrum-title', 'Invoices')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Invoices')
@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
@endpush
@section('content')
    <x-page-header pageContentTitle="Invoices" :search="true" />

    <table class="my-datatable table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Relation</th>
                <th>Action</th>
            </tr>
        </thead>

        @foreach ($dependants as $dependant)
            <tr class="table-appointment-wrap">
                <td class="mail-info-patient">
                    <ul>
                        <li>{{ $dependant->name }}</li>
                    </ul>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        <li>{{ $dependant->phone }}</li>
                    </ul>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        <li>{{ config('relations.' . $dependant->relation) ?? 'N/A' }}</li>
                    </ul>
                </td>
                <td class="appointment-start">
                    <a href="#" class="start-link">View</a>
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
