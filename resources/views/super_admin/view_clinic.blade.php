@extends('super_admin.layouts.main')

@section('title', 'Edit Clinic')

@section('breadcrum-title', 'Edit Clinic')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Edit Clinic')

@section('content')

    <div class="dashboard-header">
        <h3>Edit Clinic</h3>
    </div>

    @include('super_admin.partials.clinic_form', ['action' => route('super_admin.clinic.update', ['clinicId'=>$clinic->id])])

@endsection
