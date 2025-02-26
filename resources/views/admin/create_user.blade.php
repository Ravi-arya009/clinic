@extends('admin.layouts.main')

@section('title', 'Create User')

@section('breadcrum-title', 'Create User')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Create User')

@section('content')

    <div class="dashboard-header">
        <h3>Create User</h3>
    </div>

    <form action="{{ route('admin.user.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        @include('admin.partials.user_card')
    </form>

    <x-sweet-alert />

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
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
        })


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

<style>
    .profile-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
    }
</style>
