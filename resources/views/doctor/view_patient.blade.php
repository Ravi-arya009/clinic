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

    <form action="#" method="POST">
        @csrf
        @method('PUT')
        @include('doctor.partials.user_card')
    </form>
@endsection
