@extends('global.layouts.app')

@section('title', 'Dashboard')

@section('breadcrum-title', 'Dashboard')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Dashboard')

@section('sidebar')
@include('patient.partials.sidebar')@endsection

@section('content')
    <div class="dashboard-header">
        <h3>Clinics</h3>
        <ul class="header-list-btns">
            <li>
                <div class="input-block dash-search-input">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                </div>
            </li>
        </ul>
    </div>

    <!-- Clinics -->
    <div class="row">
        @foreach ($clinics as $clinic)
            @include('patient.partials.clinic_card')
        @endforeach
    </div>
    <!-- /Clinics -->

    <div class="col-md-12">
        <div class="loader-item text-center">
            <a href="javascript:void(0);" class="btn btn-load">Load More</a>
        </div>
    </div>
@endsection
