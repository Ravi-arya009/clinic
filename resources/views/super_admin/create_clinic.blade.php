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

    <x-sweet-alert />
@endsection
