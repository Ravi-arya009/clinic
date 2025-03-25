@php
    $pageTitle = 'Patient Profile';
@endphp
@extends('global.layouts.app')
@section('title', $pageTitle)
@section('breadcrum-title', $pageTitle)
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', $pageTitle)

@section('sidebar')
    @include('doctor.partials.sidebar')
@endsection

@section('content')

    <x-page-header :pageContentTitle="$pageTitle" />

    <form action="{{route('doctor.patient.update', ['patientId'=>$patient->id])}}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')
        @include('doctor.partials.user_card')
    </form>
@endsection
