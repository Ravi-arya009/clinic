@extends('global.layouts.app')

@section('title', 'Edit Clinic')

@section('breadcrum-title', 'Edit Clinic')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Edit Clinic')

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('sidebar')
    @include('super_admin.partials.sidebar')
@endsection

@section('content')
    <div class="dashboard-header">
        <h3>Edit Clinic</h3>
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if ($clinic->is_active == 1)
                    Active
                @else
                    Inactive
                @endif
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);" id="activate_clinic">Active</a>
                <a class="dropdown-item" href="javascript:void(0);" id="deactivate_clinic">Inactive</a>
            </div>
        </div>
    </div>

    @include('super_admin.partials.clinic_form', ['action' => route('super_admin.clinic.update', ['clinicId' => $clinic->id])])

@endsection

@push('scripts')
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src={{ asset('js/bootstrap-datetimepicker.min.js') }}></script>
    <script src={{ asset('js/clinic-utils.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        $(function() {
            ImagePreview('.upload', '.profile-img');
            //adding time slots to ul
            var clinic_working_hours = [];
            $("#add_slot_modal_button").on('click', function() {
                var clinic_opening_time = $("#clinic_opening_time").val();
                var clinic_closing_time = $("#clinic_closing_time").val();
                var day = $("#modal-day-text").text();
                var dayNumber = $("#modal-day-number").text();
                var shiftNumber = $("#modal-shift-number").text();
                var shift = $("#modal-shift-text").text();
                var targetUl = $("#" + day + "-" + shift + "-ul");
                targetUl.append("<li>" + clinic_opening_time + " - " + clinic_closing_time + "</li>");
                clinic_working_hours.push({
                    day: dayNumber,
                    shift: shiftNumber,
                    opening_time: clinic_opening_time,
                    closing_time: clinic_closing_time
                });
                $('#add_slot').modal('hide');

                console.log(clinic_working_hours)
            });

            //shows current day and shift on add time slots modal
            $(".add-slot").on('click', function() {
                var day = $(this).data("day");
                var shift = $(this).data("shift");

                var dayNumber = $(this).data("day-number");
                var shiftNumber = $(this).data("shift-number");

                $("#modal-day-text").text(day);
                $("#modal-day-number").text(dayNumber);

                $("#modal-shift-text").text(shift);
                $("#modal-shift-number").text(shiftNumber);
            });

            // Form submission
            $('#create_clinic_form').submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Processing...',
                    text: 'Updating the clinic',
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false
                });

                let formData = new FormData(this);
                formData.append('clinic_working_hours', JSON.stringify(clinic_working_hours));

                $.ajax({
                    url: "{{ route('super_admin.clinic.update', ['clinicId' => $clinic->id]) }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success == true) {
                            Swal.fire({
                                title: "Success",
                                text: response.message,
                                icon: "success"
                            });
                        }
                        if (response.success == false) {
                            Swal.fire({
                                title: "Error",
                                text: response.message,
                                icon: "error"
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr, status, error)
                        if (xhr.status === 422) {
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

                            // Show error alert with validation errors
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: "There are validation errors",
                                confirmButtonColor: '#d33'
                            });

                        } else {
                            console.log(xhr);
                            console.log('Something went wrong. Please try again.');
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong. Please try again later.',
                                confirmButtonColor: '#d33'
                            });
                        }
                    }
                });
            });
            $("#activate_clinic").on('click',function(){
                console.log("activate clinic");
            });
            $("#deactivate_clinic").on('click',function(){
                 $.ajax({
                    url: "{{ route('super_admin.clinic.deactivate') }}",
                    type: "get",
                    data: {'clinicId': "$clinic->id"},
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr, status, error)
                    }
                });
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
