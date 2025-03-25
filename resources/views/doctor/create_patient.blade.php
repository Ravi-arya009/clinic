@extends('global.layouts.app')

@section('title', 'Create Patient')

@section('breadcrum-title', 'Create Patient')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Create Patient')

@section('sidebar')
    @include('doctor.partials.sidebar')
@endsection

@section('content')

    <div class="dashboard-header">
        <h3>Create Patient</h3>
    </div>

    <form action="{{ route('doctor.patient.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        @include('doctor.partials.user_card')
    </form>

    </div>
@endsection
