@php
    $pageTitle = 'Dashboard';
@endphp
@extends('global.layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', $pageTitle)
@section('breadcrum-title', $pageTitle)
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', $pageTitle)

@section('sidebar')
    @include('staff.partials.sidebar')
@endsection

@section('content')
this is content section
@endsection
