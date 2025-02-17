@php
    $pageTitle = 'Patient Profile';
@endphp
@extends('doctor.layouts.main')
@section('title', $pageTitle)
@section('breadcrum-title', $pageTitle)
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', $pageTitle)

@section('content')

    <x-page-header :pageContentTitle="$pageTitle" />

    <div class="setting-title">
        <h5>Profile</h5>
    </div>

    <form action="{{ route('doctor.patient.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="setting-card">
            <div class="change-avatar img-upload">
                <div class="profile-img">
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
        @include('doctor.partials.user_card')
    </form>
@endsection
