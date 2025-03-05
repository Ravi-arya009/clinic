@extends('super_admin.layouts.main')
@section('title', 'Create Clinic')
@section('breadcrum-title', 'Create Clinic')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Create Clinic')

@section('content')

    <div class="dashboard-header">
        <h3>Create Clinic</h3>
    </div>

    @include('super_admin.partials.clinic_form', ['action' => route('super_admin.clinic.store')])

    <x-Alert />
@endsection

@push('scripts')
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
@endpush
