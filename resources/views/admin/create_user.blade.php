@extends('admin.layouts.main')

@section('title', 'Create User')

@section('breadcrum-title', 'Create User')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Create User')

@section('content')


    <div class="dashboard-header">
        <h3>Create User</h3>
    </div>


    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf
        @include('admin.partials.user_card')
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
