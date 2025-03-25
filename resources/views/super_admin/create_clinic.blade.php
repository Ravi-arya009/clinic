@extends('global.layouts.app')
@section('title', 'Create Clinic')
@section('breadcrum-title', 'Create Clinic')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Create Clinic')

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('sidebar')
    @include('super_admin.partials.sidebar')
@endsection

@section('content')
    <div class="dashboard-header">
        <h3>Create Clinic</h3>
    </div>
    @include('super_admin.partials.clinic_form', ['action' => route('super_admin.clinic.store')])
    <x-Alert />
@endsection

@push('scripts')
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src={{ asset('js/bootstrap-datetimepicker.min.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src={{ asset('js/clinic-utils.js') }}></script>

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
                    text: 'Creating the clinic',
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
                    url: "{{ route('super_admin.clinic.store') }}",
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
                            window.location.href = response.redirectRoute;
                        }
                    },
                    error: function(xhr) {
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
                                html: "There are validation errors, Fix them to continue.",
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
        });
    </script>
@endpush
