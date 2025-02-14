@php
    $pageTitle = 'Dashboard';
@endphp
@extends('doctor.layouts.main')
@section('title', $pageTitle)
@section('breadcrum-title', $pageTitle)
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', $pageTitle)

@section('content')
    <h2>Welcome to the Dashboard</h2>
    <p>This is the main content of the page.</p>
@endsection
