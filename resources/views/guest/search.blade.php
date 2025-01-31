@extends('guest.layouts.main')
@section('title', 'Search')
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">
@endpush

@section('content')
    <div class="content">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
                    <!-- Search Filter -->
                    <div class="card search-filter">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Search Filter</h4>
                        </div>
                        <div class="card-body">
                            <div class="filter-widget">
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" placeholder="Select Date">
                                </div>
                            </div>
                            <div class="filter-widget">
                                <h4>Gender</h4>
                                <div>
                                    <label class="custom_check">
                                        <input type="checkbox" name="gender_type" checked>
                                        <span class="checkmark"></span> Male Doctor
                                    </label>
                                </div>
                                <div>
                                    <label class="custom_check">
                                        <input type="checkbox" name="gender_type">
                                        <span class="checkmark"></span> Female Doctor
                                    </label>
                                </div>
                            </div>
                            <div class="filter-widget">
                                <h4>Select Specialist</h4>
                                <div>
                                    <label class="custom_check">
                                        <input type="checkbox" name="select_specialist" checked>
                                        <span class="checkmark"></span> Urology
                                    </label>
                                </div>
                                <div>
                                    <label class="custom_check">
                                        <input type="checkbox" name="select_specialist" checked>
                                        <span class="checkmark"></span> Neurology
                                    </label>
                                </div>
                                <div>
                                    <label class="custom_check">
                                        <input type="checkbox" name="select_specialist">
                                        <span class="checkmark"></span> Dentist
                                    </label>
                                </div>
                                <div>
                                    <label class="custom_check">
                                        <input type="checkbox" name="select_specialist">
                                        <span class="checkmark"></span> Orthopedic
                                    </label>
                                </div>
                                <div>
                                    <label class="custom_check">
                                        <input type="checkbox" name="select_specialist">
                                        <span class="checkmark"></span> Cardiologist
                                    </label>
                                </div>
                                <div>
                                    <label class="custom_check">
                                        <input type="checkbox" name="select_specialist">
                                        <span class="checkmark"></span> Cardiologist
                                    </label>
                                </div>
                            </div>
                            <div class="btn-search">
                                <button type="button" class="btn w-100">Search</button>
                            </div>
                        </div>
                    </div>
                    <!-- /Search Filter -->
                </div>
                <div class="col-md-12 col-lg-8 col-xl-9">
                    {{-- Clinics --}}
                    <span id="clinics">
                        <button type="button" class="btn btn-info mb-3 text-white">Clinics <span class="badge bg-white text-info">{{ count($clinics) }}</span></button>
                        @if (count($clinics) > 0)
                            @foreach ($clinics as $clinic)
                                @include('guest.partials.search_result_card', ['entity' => $clinic, 'type'=>'clinic'])
                            @endforeach
                            <div class="load-more text-center">
                                <a class="btn btn-primary btn-sm prime-btn" href="javascript:void(0);">Load More</a>
                            </div>
                        @endif
                    </span>
                    {{-- Doctors --}}
                    <span id="doctors">
                        <button type="button" class="btn btn-info mb-3 text-white">Doctors <span class="badge bg-white text-info">{{ count($doctors) }}</span></button>
                        @if (count($doctors) > 0)
                            @foreach ($doctors as $doctor)
                                @include('guest.partials.search_result_card', ['entity' => $doctor, 'type'=>'doctor'])
                            @endforeach
                            <div class="load-more text-center">
                                <a class="btn btn-primary btn-sm prime-btn" href="javascript:void(0);">Load More</a>
                            </div>
                        @endif
                    </span>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src={{ asset('js/bootstrap-datetimepicker.min.js') }}></script>
@endpush
