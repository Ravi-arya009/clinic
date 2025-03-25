@extends('global.layouts.app')

@section('title', 'User Profile')

@section('breadcrum-title', 'User Profile')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'User Profile')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')


    <div class="dashboard-header">
        <h3>Profile Settings</h3>
    </div>

    <div class="setting-title">
        <h5>Profile</h5>
    </div>

    <form action="{{ route('admin.user.update', [$user->id]) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')
        @include('admin.partials.user_card')
    </form>

    <X-sweet-alert />

    </div>
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
