@extends('patient.layouts.main')

@section('title', 'Dashboard')

@section('breadcrum-title', 'Dashboard')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Dashboard')

@section('content')
    <h2>Welcome {{$currentUser->name}}</h2>
    <p>This is the main content of the page.</p>
@endsection
