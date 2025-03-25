@extends('global.layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'Family Members')

@section('breadcrum-title', 'Family Members')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Family Members')
@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('sidebar')
    @include('patient.partials.sidebar')
@endsection

@section('content')
    <div class="dashboard-header">
        <h3>Family Members</h3>
        <ul class="header-list-btns">
            <li>
                <a href="#" class="btn btn-primary prime-btn btn-sm float-start me-3" data-bs-toggle="modal" data-bs-target="#add_dependent"><i class="fa-solid fa-plus me-2"></i>Add</a>
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


    <table class="my-datatable table-hover" id="dependant-table">
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
                    <a href="javascript:void(0);" class="edit-icon" data-dependent-id="{{ $dependant->id }}" data-dependent-name="{{ $dependant->name }}" data-dependent-phone="{{ $dependant->phone }}" data-dependent-whatsapp="{{ $dependant->whatsapp }}" data-dependent-email="{{ $dependant->email }}"
                        data-dependent-dob="{{ $dependant->dob }}" data-dependent-gender="{{ $dependant->gender }}" data-dependent-relation="{{ $dependant->relation }}" data-bs-toggle="modal" data-bs-target="#add_dependent">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="javascript:void(0);" class="edit-icon ms-2 delete_dependent" data-bs-toggle="modal" data-bs-target="#delete_dependent" data-dependent-id="{{ $dependant->id }}" id="delete_dependant_{{ $dependant->id }}"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </table>

@endsection

@section('modal')
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
                                            <input type="date" name="dependant_dob" class="form-control" value="{{ old('dependant_dob') }}">
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

    <div class="modal fade info-modal" id="delete_dependent">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="success-wrap">
                        <div class="success-info">
                            <div class="text-center">
                                <span class="icon-success bg-red"><i class="fa-solid fa-xmark"></i></span>
                                <h3>Remove Family Member</h3>
                                <p>Are you sure you want to remove this family member?</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-btn text-center">
                        <a href="#" class="btn btn-gray" data-bs-toggle="modal" data-bs-dismiss="modal" id="delete_dependant_modal_button">Yes, Remove</a>
                        <a href="#" class="btn btn-primary prime-btn px-5" data-bs-toggle="modal" data-bs-dismiss="modal">No</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {
            var isEditMode = false;
            var currentDependentId = null;

            $('#delete_dependent').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var dependentId = button.data('dependent-id');
                $(this).data('dependent-id', dependentId);
            });


            $('#delete_dependant_modal_button').click(function() {
                var dependentId = $('#delete_dependent').data('dependent-id');

                $.ajax({
                    url: "{{ route('deleteDependant') }}",
                    type: "POST",
                    data: {
                        dependent_id: dependentId
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            $("#delete_dependant_" + dependentId).closest('tr').remove();
                            Swal.fire({
                                title: "Success!",
                                text: "Family Member Deleted!",
                                icon: "success"
                            });
                        } else {
                            console.log('something went wrong');
                        }
                    }
                });
            });


            $('#add_dependant_form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: isEditMode ? "{{ route('updateDependant') }}" : "{{ route('addDependant') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == 1) {
                            location.reload();
                            $("#add_dependent").modal('hide');
                            var row = $('<tr class="table-appointment-wrap">');
                            row.append('<td class="mail-info-patient"><ul><li>' + response.dependant.name + '</li></ul></td>');
                            row.append('<td class="mail-info-patient"><ul><li>' + response.dependant.phone + '</li></ul></td>');
                            row.append('<td class="mail-info-patient"><ul><li> - </li></ul></td>');
                            row.append('<td class="appointment-start"><a href="#" class="start-link">View</a></td>');
                            $('#dependant-table').append(row);
                            Swal.fire({
                                title: "Success!",
                                text: "Family Member Created!",
                                icon: "success"
                            });
                        } else {
                            console.log('something went wrong');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr, status, error);
                    }
                });
            });

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



            $('#add_dependent').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                // Check if this is coming from an edit button by checking if data-dependent-id exists
                if (button.data('dependent-id')) {
                    isEditMode = true;
                    currentDependentId = button.data('dependent-id');

                    // Change modal title
                    $(this).find('.modal-title').text('Edit Dependant');

                    // Fill form with data from the button's data attributes
                    $('#dependant_name').val(button.data('dependent-name'));
                    $('#dependant_phone').val(button.data('dependent-phone'));
                    $('#dependant_whatsapp').val(button.data('dependent-whatsapp'));
                    $('#dependant_email').val(button.data('dependent-email'));
                    $('input[name="dependant_dob"]').val(button.data('dependent-dob'));
                    $('#dependant_gender').val(button.data('dependent-gender'));
                    $('#dependant_relation').val(button.data('dependent-relation'));

                    // Add hidden field for the ID
                    if (button.data('dependent-id')) {
                        $('#add_dependant_form').append('<input type="hidden" id="dependent_id" name="dependent_id" value="' + currentDependentId + '">');
                    } else {
                        $('#dependent_id').val(currentDependentId);
                    }

                    // Change button text
                    $(this).find('.prime-btn').text('Update');
                } else {
                    // Reset to create mode
                    isEditMode = false;
                    currentDependentId = null;

                    // Reset the form
                    $('#add_dependant_form')[0].reset();

                    // Remove any hidden ID field
                    $('#dependent_id').remove();

                    // Restore original title and button text
                    $(this).find('.modal-title').text('Add Dependant');
                    $(this).find('.prime-btn').text('Save Changes');
                }
            });

        });
    </script>

    @if (session()->has('success'))
        <script>
            $(document).ready(function() {
                toastr.success('{{ session()->get('success') }}');
            });
        </script>
    @endif
@endpush
