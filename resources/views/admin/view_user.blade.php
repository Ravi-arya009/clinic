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

    <form action="{{ route('admin.user.update', [$user->id]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.partials.user_card')
    </form>

    <X-sweet-alert />

    </div>
@endsection
