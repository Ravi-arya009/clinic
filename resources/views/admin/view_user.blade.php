@extends('global.layouts.app')

@section('title', 'User Profile')

@section('breadcrum-title', 'User Profile')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'User Profile')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')


    <div class="dashboard-header">
        <h3>Profile Settings</h3>
    </div>

    <div class="setting-title">
        <h5>Profile</h5>
    </div>

    <form id="update_user_form" action="{{ route('admin.user.update', [$user->id]) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')
        @include('admin.partials.user_card')
    </form>

    <X-sweet-alert />

    </div>
@endsection

@push('scripts')
    <script src={{ asset('js/clinic-utils.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        ImagePreview('.upload', '.profile-img');

        $('#update_user_form').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Processing...',
                text: 'Updating the user',
                didOpen: () => {
                    Swal.showLoading();
                },
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false
            });

            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.user.update', [$user->id]) }}",
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
    </script>
    @if (session()->has('success'))
        <script>
            $(document).ready(function() {
                toastr.success('{{ session()->get('success') }}');
            });
        </script>
    @endif
@endpush
