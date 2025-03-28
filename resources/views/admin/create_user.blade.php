@extends('global.layouts.app')

@section('title', 'Create User')

@section('breadcrum-title', 'Create User')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Create User')

@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <div class="dashboard-header">
        <h3>Create User</h3>
    </div>

    <form id="create_user_form" action="{{ route('admin.user.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        @include('admin.partials.user_card')
    </form>

    <x-Alert />
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src={{ asset('js/clinic-utils.js') }}></script>
    <script>
        $(document).ready(function() {
            ImagePreview('.upload', '.profile-img');

            //Toggle hide doctor related fields.
            $(".doctor-infofmation-card").hide();
            if ($("#role").val() == '{{ config('role.doctor') }}') {
                $(".doctor-infofmation-card").show();
            }
            $('#role').on('change', function() {
                if ($(this).val() === '{{ config('role.doctor') }}') {
                    $(".doctor-infofmation-card").show();
                } else {
                    $(".doctor-infofmation-card").hide();
                }
            });


            $('#create_user_form').submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Processing...',
                    text: 'Creating the user',
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false
                });

                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.user.store') }}",
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
                            window.location.href = response.data.redirectRoute;
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr);
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
                                html: "There are validation errors. Fix them to continue.",
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
        })
    </script>
@endpush
