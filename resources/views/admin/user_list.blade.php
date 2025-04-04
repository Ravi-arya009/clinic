@extends('global.layouts.app')

@section('title', 'User List')

@section('breadcrum-title', 'User List')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'User List')
@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
@endpush

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')

    <div class="dashboard-header">
        <h3>User List</h3>
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
                <th>City</th>
                <th>Contact</th>
                <th>
                    <select class="role-column-filter">
                        <option value="">All Roles</option>
                        @foreach (config('role') as $roleKey => $roleValue)
                            <option value="{{ $roleKey }}">{{ ucfirst($roleKey) }}</option>
                        @endforeach
                    </select>
                </th>
                <th>Action</th>
            </tr>
        </thead>

        @foreach ($clinicUsers as $clinicUser)
            <tr class="table-appointment-wrap">
                <td class="patinet-information">
                    <img src="{{ $clinicUser->user->profile_image ? asset('/storage/profile_images/' . $clinicUser->user->profile_image) : asset('/storage/profile_images/default-profile-picture.webp') }}" alt="Profile Image" style="width: 50px; height:50px">
                    <div class="patient-info">
                        <p>#Apt0001</p>
                        <h6>{{ $clinicUser->user->name }}</h6>
                    </div>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        <li>{{ isset($clinicUser->user->city->name) ? ucfirst($clinicUser->user->city->name) : 'N/A' }}</li>
                    </ul>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        <li><i class="fa-solid fa-phone"></i>{{ $clinicUser->user->phone }}</li>
                        <li><i class="fa-solid fa-brands fa-whatsapp"></i>{{ $clinicUser->user->whatsapp ?? 'N/A' }}</li>
                    </ul>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        <li>
                            <span class="badge badge-green status-badge">{{ ucfirst(array_search($clinicUser->role_id, config('role'))) }}</span>
                        </li>
                    </ul>
                </td>
                <td class="appointment-start">
                    <a href="{{ route('admin.user.show', ['userId' => $clinicUser->user_id]) }}" class="start-link">Edit</a>
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
            //turning off sorting for roles coolumn
            columnDefs: [{
                targets: 3,
                sortable: false
            }]
        });

        $('.role-column-filter').on('change', function() {
            table.column(3).search($(this).val()).draw();
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
