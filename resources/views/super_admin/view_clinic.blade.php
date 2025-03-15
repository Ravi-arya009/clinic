@extends('super_admin.layouts.main')

@section('title', 'Edit Clinic')

@section('breadcrum-title', 'Edit Clinic')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Edit Clinic')

@push('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')

    <div class="dashboard-header">
        <h3>Edit Clinic</h3>
    </div>

    @include('super_admin.partials.clinic_form', ['action' => route('super_admin.clinic.update', ['clinicId' => $clinic->id])])

    <x-Alert />

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        //Image Preview while profile update
        const uploadInput = document.querySelector('.upload');
        const previewContainer = document.querySelector('.profile-img');

        uploadInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = (event) => {
                const imageData = event.target.result;
                const image = document.createElement('img');
                image.src = imageData;
                image.style.width = '100%';
                image.style.height = '100%';
                image.style.objectFit = 'cover';

                previewContainer.innerHTML = '';
                previewContainer.appendChild(image);
            };

            reader.readAsDataURL(file);
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
