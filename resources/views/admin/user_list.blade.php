@extends('admin.layouts.main')

@section('title', 'User List')

@section('breadcrum-title', 'User List')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'User List')

@section('content')

    <div class="dashboard-header">
        <h3>User List</h3>
        <ul class="header-list-btns">
            <li>
                <div class="input-block dash-search-input">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                </div>
            </li>
        </ul>
    </div>
    <div class="appointment-tab-head">
        <div class="appointment-tabs">
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$roleName}}</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('admin.user.index') }}">All Roles</a>
                    <div class="dropdown-divider"></div>
                    @foreach (config('role') as $roleName => $roleId)
                        <a class="dropdown-item" href="{{ route('admin.user.index', ['role_id' => $roleId]) }}">{{ ucfirst($roleName) }}</a>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="filter-head">
            <div class="position-relative daterange-wraper me-2">
                <div class="input-groupicon calender-input">
                    <input type="text" class="form-control  date-range bookingrange" placeholder="From Date - To Date ">
                </div>
                <i class="fa-solid fa-calendar-days"></i>
            </div>
            <div class="form-sorts dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" id="table-filter"><i class="fa-solid fa-filter me-2"></i>Filter By</a>
                <div class="filter-dropdown-menu">
                    <div class="filter-set-view">
                        <div class="accordion" id="accordionExample">
                            <div class="filter-set-content">
                                <div class="filter-set-content-head">
                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Name<i class="fa-solid fa-chevron-right"></i></a>
                                </div>
                                <div class="filter-set-contents accordion-collapse collapse show" id="collapseTwo" data-bs-parent="#accordionExample">
                                    <ul>
                                        <li>
                                            <div class="input-block dash-search-input w-100">
                                                <input type="text" class="form-control" placeholder="Search">
                                                <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-set-content">
                                <div class="filter-set-content-head">
                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Appointment Type<i class="fa-solid fa-chevron-right"></i></a>
                                </div>
                                <div class="filter-set-contents accordion-collapse collapse show" id="collapseOne" data-bs-parent="#accordionExample">
                                    <ul>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">All Type</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">Video Call</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">Audio Call</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">Chat</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">Direct Visit</span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-set-content">
                                <div class="filter-set-content-head">
                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Visit Type<i class="fa-solid fa-chevron-right"></i></a>
                                </div>
                                <div class="filter-set-contents accordion-collapse collapse show" id="collapseThree" data-bs-parent="#accordionExample">
                                    <ul>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">All Visit</span>
                                                </label>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">General</span>
                                                </label>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">Consultation</span>
                                                </label>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">Follow-up</span>
                                                </label>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="filter-checks">
                                                <label class="checkboxs">
                                                    <input type="checkbox">
                                                    <span class="checkmarks"></span>
                                                    <span class="check-title">Direct Visit</span>
                                                </label>
                                            </div>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="filter-reset-btns">
                            <a href="#" class="btn btn-light">Reset</a>
                            <a href="#" class="btn btn-primary">Filter Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="appointment-tab-content grid-patient">
        <div class="row">

            <!-- User Card -->
            @forelse($users as $index => $user)
                @include('admin.partials.card_one', ['name' => $user->name, 'phone' => $user->phone, 'role' => ucfirst(array_search($user->role, config('role')))])
            @empty
                <p>No users found.</p>
            @endforelse
            <!-- /User Card -->
            <div class="col-md-12">
                <div class="loader-item text-center">
                    <a href="javascript:void(0);" class="btn btn-load">Load More</a>
                </div>
            </div>

        </div>
    </div>

@endsection
