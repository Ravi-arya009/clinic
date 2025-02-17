@extends('admin.layouts.main')

@section('title', 'User Profile')

@section('breadcrum-title', 'User Profile')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'User Profile')

@section('content')


    <div class="dashboard-header">
        <h3>Profile Settings</h3>
    </div>

    <div class="setting-title">
        <h5>Profile</h5>
    </div>

    <form action="{{ route('admin.patient.create', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="setting-card">
            <div class="change-avatar img-upload">
                <div class="profile-img">
                    {{-- <i class="fa-solid fa-file-image"></i> --}}
                    <img src="{{ asset('img/doctors-dashboard/profile-01.jpg') }}">
                </div>
                <div class="upload-img">
                    <h5>Profile Image</h5>
                    <div class="imgs-load d-flex align-items-center">
                        <div class="change-photo">
                            Upload New
                            <input type="file" class="upload">
                        </div>
                        <a href="#" class="upload-remove">Remove</a>
                    </div>
                    <p class="form-text">Your Image should Below 4 MB, Accepted format jpg,png,svg</p>
                </div>
            </div>
        </div>
        @include('admin.partials.user_card', ['type' => 'patient'])
    </form>

    </div>
@endsection
