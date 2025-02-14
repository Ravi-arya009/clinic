@extends('admin.layouts.main')

@section('title', 'Create Patient')

@section('breadcrum-title', 'Create Patient')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Create Patient')

@section('content')


    <div class="dashboard-header">
        <h3>Create Patient</h3>
    </div>


    <form action="{{ route('admin.patient.store') }}" method="POST">
        @csrf
        @include('admin.partials.user_card', ['type' => 'patient'])
    </form>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".doctor-infofmation-card").hide();

            if ($("#role").val() == 2) {
                $(".doctor-infofmation-card").show();
            }
            $('#role').on('change', function() {
                if ($(this).val() === '{{ config('role.doctor') }}') {
                    $(".doctor-infofmation-card").show();
                } else {
                    $(".doctor-infofmation-card").hide();
                }
            });
        })
    </script>
@endpush
