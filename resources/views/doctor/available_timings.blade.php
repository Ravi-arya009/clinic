@php
    $pageTitle = 'Available Timings';
@endphp
@extends('global.layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', $pageTitle)
@section('breadcrum-title', $pageTitle)
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', $pageTitle)

@push('scripts')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">
@endpush

@section('sidebar')
    @include('doctor.partials.sidebar')
@endsection

@section('content')

    <x-page-header :pageContentTitle="$pageTitle" />

    <x-Alert />

    <div class="tab-pane fade show active" id="general-availability">
        <div class="card custom-card">
            <div class="card-body">
                <div class="card-header">
                    <h3>Select Available Slots</h3>
                </div>

                <div class="available-tab">
                    <ul class="nav">
                        <li>
                            <a href="#" class="active" data-bs-toggle="tab" data-bs-target="#day_1">Monday</a>
                        </li>
                        <li>
                            <a href="#" data-bs-toggle="tab" data-bs-target="#day_2">Tuesday</a>
                        </li>
                        <li>
                            <a href="#" data-bs-toggle="tab" data-bs-target="#day_3">Wednesday</a>
                        </li>
                        <li>
                            <a href="#" data-bs-toggle="tab" data-bs-target="#day_4">Thursday</a>
                        </li>
                        <li>
                            <a href="#" data-bs-toggle="tab" data-bs-target="#day_5">Friday</a>
                        </li>
                        <li>
                            <a href="#" data-bs-toggle="tab" data-bs-target="#day_6">Saturday</a>
                        </li>
                        <li>
                            <a href="#" data-bs-toggle="tab" data-bs-target="#day_7">Sunday</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content pt-0">
                    @for ($i = 1; $i <= 7; $i++)
                        <div class="tab-pane {{ $i == 1 ? 'active show' : 'fade' }}" id="day_{{ $i }}">
                            <div class="slot-box">
                                <div class="slot-header">
                                    <h5>Available Slots</h5>
                                    <ul>
                                        <li>
                                            <a href="#" class="add-slot add_time_slot" data-bs-toggle="modal" data-bs-target="#add_slot" data-day="{{ $i }}">Add Slots</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="slot-body">
                                    <ul class="time-slots">
                                        @if (isset($timeSlots) && isset($timeSlots[$i]) && $timeSlots[$i]->count() > 0)
                                            @foreach ($timeSlots[$i] as $slot)
                                                <li class="time_slot_li" id="slot_{{ $slot->id }}" data-id="{{ $slot->id }}" data-bs-toggle="modal" data-bs-target="#delete_slot"><i class="fa-regular fa-clock"></i>{{ date('h:i A', strtotime($slot->slot_time)) }}</li>
                                            @endforeach
                                        @else
                                            <p>No Slots Available</p>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Add Slots -->
    <div class="modal fade custom-modals" id="add_slot">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Slot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form action="{{ route('doctor.time_slots.store') }}" method="POST">
                    @csrf

                    <input type="hidden" id="doctor_id" name="doctor_id" value="{{ request('doctor_id') }}">
                    <div class="modal-body">
                        <div class="timing-modal">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-wrap">
                                        <label class="col-form-label">Select Slot Time</label>
                                        <input type="text" class="form-control timepicker1" id="time" name="time" value="09:00 AM">
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="form-wrap mb-0">
                                        <label class="col-form-label d-block">Apply this time slot to other days</label>
                                        <div class="custom-control form-check custom-control-inline">
                                            <input type="checkbox" id="checkbox_day_1" name="days[]" class="form-check-input day_checkbox" value="1">
                                            <label class="form-check-label" for="monday">Monday</label>
                                        </div>

                                        <div class="custom-control form-check custom-control-inline">
                                            <input type="checkbox" id="checkbox_day_2" name="days[]" class="form-check-input day_checkbox" value="2">
                                            <label class="form-check-label" for="tuesday">Tuesday</label>
                                        </div>

                                        <div class="custom-control form-check custom-control-inline">
                                            <input type="checkbox" id="checkbox_day_3" name="days[]" class="form-check-input day_checkbox" value="3">
                                            <label class="form-check-label" for="wednesday">Wednesday</label>
                                        </div>

                                        <div class="custom-control form-check custom-control-inline">
                                            <input type="checkbox" id="checkbox_day_4" name="days[]" class="form-check-input day_checkbox" value="4">
                                            <label class="form-check-label" for="thursday">Thursday</label>
                                        </div>

                                        <div class="custom-control form-check custom-control-inline">
                                            <input type="checkbox" id="checkbox_day_5" name="days[]" class="form-check-input day_checkbox" value="5">
                                            <label class="form-check-label" for="friday">Friday</label>
                                        </div>

                                        <div class="custom-control form-check custom-control-inline">
                                            <input type="checkbox" id="checkbox_day_6" name="days[]" class="form-check-input day_checkbox" value="6">
                                            <label class="form-check-label" for="saturday">Saturday</label>
                                        </div>

                                        <div class="custom-control form-check custom-control-inline">
                                            <input type="checkbox" id="checkbox_day_7" name="days[]" class="form-check-input day_checkbox" value="7">
                                            <label class="form-check-label" for="sunday">Sunday</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="modal-btn text-end">
                            <a href="#" class="btn btn-gray" data-bs-toggle="modal" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-primary prime-btn">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Add Slots -->

    <!-- Remove Slots -->
    <div class="modal fade info-modal" id="delete_slot">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="success-wrap">
                        <div class="success-info">
                            <div class="text-center">
                                <span class="icon-success bg-red"><i class="fa-solid fa-xmark"></i></span>
                                <h3>Remove Slots</h3>
                                <p>Are you sure you want to remove this slots?</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-btn text-center">
                        <a href="#" class="btn btn-gray" data-bs-toggle="modal" data-bs-dismiss="modal" data-slot_id="" id="delete_slot_modal_button">Yes, Remove</a>
                        <a href="#" class="btn btn-primary prime-btn px-5" data-bs-toggle="modal" data-bs-dismiss="modal">No</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Remove Slots -->

    {{-- success/ error modal --}}
    <div class="modal fade info-modal" id="alert_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="success-wrap">
                        <div class="success-info">
                            <div class="text-center">
                                <span class="custom-icon-success"><i class="fa-solid fa-check"></i></span>
                                <h3>Success</h3>
                                <p>Slot removed succesfully</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-btn text-center">
                        <a href="#" class="btn px-5 btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal">Ok</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src={{ asset('js/bootstrap-datetimepicker.min.js') }}></script>
@endpush
