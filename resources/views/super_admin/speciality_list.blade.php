@extends('super_admin.layouts.main')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'States')

@section('breadcrum-title', 'States')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'States')

@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
@endpush

@section('content')
    <div class="dashboard-header">
        <h3>State List</h3>
        <ul class="header-list-btns">
            <li>
                <a href="#add_state" class="btn btn-primary prime-btn btn-sm float-start me-3" data-bs-toggle="modal"><i class="fa-solid fa-plus me-2"></i>Add</a>
                <div class="input-block dash-search-input float-start">
                    <input type="text" class="form-control customSearch" placeholder="Search">
                    <span class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <i class="fa-solid fa-xmark hide" style="cursor: pointer;"></i>
                    </span>
                </div>
            </li>
        </ul>
    </div>

    <table class="my-datatable table-hover" id="state-master-table">
        <thead class="my-table-hover">
            <tr>
                <th>Sno.</th>
                <th>Name</th>
                <th>Status</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        @foreach ($specialities as $speciality)
            <tr class="table-appointment-wrap" id="state-row-{{ $speciality->id }}">
                <td class="mail-info-patient">
                    <ul>
                        <li>#{{ $loop->iteration }}</li>
                    </ul>
                </td>

                <td class="mail-info-patient" id="state-name-{{ $speciality->id }}">
                    <ul>
                        <li>{{ isset($speciality->name) ? ucfirst($speciality->name) : 'N/A' }}</li>
                    </ul>
                </td>

                <td class="mail-info-patient">
                    <ul>
                        <li>
                            <span class="badge badge-green status-badge">Available</span>
                        </li>
                    </ul>
                </td>

                <td class="appointment-start">
                    <a href="javascript:void(0);" class="delete-state" data-bs-toggle="modal" data-bs-target="#delete_state_modal" data-state-id="{{ $speciality->id }}">Delete</a>
                </td>

                <td class="appointment-start">
                    <a href="#edit_state" class="edit-state-button start-link" data-bs-toggle="modal" title="Edit State" data-state-id="{{ $speciality->id }}" data-state-name="{{ $speciality->name }}">
                        Edit
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <hr>
@endsection

@section('modal')
    <!-- Add State Moodal -->
    <div class="modal fade custom-modal custom-modal-two modal-lg" id="add_state">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New State</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span><i class="fa-solid fa-x"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-block input-block-new">
                        <label class="form-label">State Name</label>
                        <input type="text" class="form-control" id="stateName">
                    </div>

                    <div class="alert alert-danger d-none">
                        <ul>
                            <li id="add-state-error"></li>
                        </ul>
                    </div>

                    <div class="form-set-button">
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" id="add-state-button">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add State Moodal -->

    <!-- Edit State Moodal -->
    <div class="modal fade custom-modal custom-modal-two modal-lg" id="edit_state">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit State</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span><i class="fa-solid fa-x"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-block input-block-new">
                        <label class="form-label">State Name</label>
                        <input type="text" class="form-control" id="edit-state-name">
                    </div>

                    <div class="alert alert-danger d-none">
                        <ul>
                            <li id="edit-state-error"></li>
                        </ul>
                    </div>

                    <div class="form-set-button">
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" id="update-state-button">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit State Moodal -->

    {{-- success modal --}}
    <div class="modal fade custom-modal custom-modal-two modal-lg" id="success-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit State</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span><i class="fa-solid fa-x"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-block input-block-new">
                        <h4>State Name : <span id="success-state-name"></span></h4>
                    </div>

                    <div id="success-modal-alert" class="alert alert-success d-block ">
                        <ul>
                            <li>State Added Succesfully</li>
                        </ul>
                    </div>

                    <div class="form-set-button">
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- success modal --}}


    <!-- Delete State -->
    <div class="modal fade info-modal" id="delete_state_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="success-wrap">
                        <div class="success-info">
                            <div class="text-center">
                                <span class="icon-success bg-red"><i class="fa-solid fa-xmark"></i></span>
                                <h3>Remove State</h3>
                                <p>Are you sure you want to remove this State?</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-btn text-center">
                        <a href="#" class="btn btn-gray" data-bs-toggle="modal" data-bs-dismiss="modal" data-state-id="" id="delete_state_modal_button">Yes, Remove</a>
                        <a href="#" class="btn btn-primary prime-btn px-5" data-bs-toggle="modal" data-bs-dismiss="modal">No</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete State -->
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

        $('.fa-xmark').on('click', function() {
            $('.customSearch').val('');
            table.search('').draw();
            $('.fa-magnifying-glass').removeClass('hide');
            $(this).addClass('hide');
        });
    </script>
@endpush
