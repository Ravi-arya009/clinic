<form id="create_clinic_form" action="{{ $action }}" enctype="multipart/form-data" method="POST">
    @csrf
    <!-- Clinic logo -->
    <div class="setting-card">
        <div class="change-avatar img-upload">
            <div class="profile-img">
                <div class="clinic-logo">
                    @if (isset($clinic->logo))
                        @if (isset($clinic->logo))
                            <img src="{{ asset('storage/clinic_logos/' . $clinic->logo) }}" alt="Clinic Logo">
                        @else
                            <img src="{{ asset('img/default-profile-picture.webp') }}" alt="Default Clinic Logo">
                        @endif
                    @else
                        <i class="fa-solid fa-file-image"></i>
                    @endif
                </div>
            </div>
            <div class="upload-img">
                <h5>Clinic Logo</h5>
                <div class="imgs-load d-flex align-items-center">
                    <div class="change-photo">
                        Upload New
                        <input type="file" id="logo" name="logo" class="upload">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Clinic logo -->
    <!-- Clinic Information -->
    <div class="setting-title">
        <h5>Clinic Information</h5>
    </div>
    <div class="setting-card">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="form-wrap">
                    <label class="col-form-label">Clinic Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', isset($clinic) ? ucfirst($clinic->name) : '') }}" required>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-wrap">
                    <label class="col-form-label">Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $clinic->slug ?? '') }}" required>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-wrap">
                    <label class="col-form-label">State</label>
                    <select class="form-control select2_dropdown" name="state" id="state">
                        <option value="" selected>Select</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}" @if (old('state', $clinic->state_id ?? '') == $state->id) selected @endif>{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-wrap">
                    <label class="col-form-label">City</label>
                    <select class="form-control select2_dropdown" name="city" id="city">
                        <option value="" selected>Select</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" @if (old('city', $clinic->city_id ?? '') == $city->id) selected @endif>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-wrap">
                    <label class="col-form-label">Address</label>
                    <textarea name="address" id="address" class="form-control">{{ old('address', $clinic->address ?? '') }}</textarea>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-wrap">
                    <label class="col-form-label">Pincode</label>
                    <input type="text" name="pincode" id="pincode" class="form-control" value="{{ old('pincode', $clinic->pincode ?? '') }}">
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-wrap">
                    <label class="col-form-label">Area</label>
                    <input type="text" name="area" id="area" class="form-control" value="{{ old('area', $clinic->area ?? '') }}">
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-wrap">
                    <label class="col-form-label">Speciality</label>
                    <select class="form-control select2_dropdown" name="speciality" id="speciality">
                        <option value="" selected>Select</option>
                        @foreach ($specialities as $speciality)
                            <option value="{{ $speciality->id }}" @if (old('speciality', $clinic->speciality_id ?? '') == $speciality->id) selected @endif>{{ $speciality->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <!-- /Clinic Information -->
    <!-- Contact Information -->
    <div class="setting-title">
        <h5>Contact Information</h5>
    </div>
    <div class="setting-card">
        <div class="row">
            <div class="col-lg-6">
                <div class="setting-title">
                    <h6 class="fw-bold">Clinic Contact</h6>
                </div>
                <div class="setting-card">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-wrap">
                                <label class="col-form-label">Clinic's Phone </label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $clinic->phone ?? '') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-wrap">
                                <label class="col-form-label">Clinic's WhatsApp </label>
                                <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="{{ old('whatsapp', $clinic->whatsapp ?? '') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-wrap">
                                <label class="col-form-label">Clinic's E-mail </label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $clinic->email ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="setting-title">
                    <h6 class="d-inline-block fw-bold">Contact Person</h6><small class="d-inline-block  text-danger ms-1">(For Super Admin Use Only)</small>
                </div>
                <div class="setting-card">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-wrap">
                                <label class="col-form-label">Contact Person's Name </label>
                                <input type="text" name="contact_person" id="contact_person" class="form-control" value="{{ old('contact_person', isset($clinic) ? ucfirst($clinic->contact_person) : '') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-wrap">
                                <label class="col-form-label">Contact Person's Phone</label>
                                <input type="text" name="contact_person_phone" id="contact_person_phone" class="form-control" value="{{ old('contact_person_phone', $clinic->contact_person_phone ?? '') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-wrap">
                                <label class="col-form-label">Contact Person's WhatsApp</label>
                                <input type="text" name="contact_person_whatsapp" id="contact_person_whatsapp" class="form-control" value="{{ old('contact_person_whatsapp', $clinic->contact_person_whatsapp ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Contact Information -->
    <!-- Clinic Admins -->
    @if (!isset($clinic))
        <div class="setting-title">
            <h5>Admin Information</h5>
        </div>
        <div class="setting-card">
            <div class="row">
                <input type="hidden" name="admin_id" id="admin_id" value="{{ isset($clinic) ? ucfirst($clinic->admin->id) : '' }}">
                <div class="col-lg-6 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Admin Name <span class="text-danger">*</span></label>
                        <input type="text" name="admin_name" id="admin_name" class="form-control" value="{{ old('admin_name', isset($clinic) ? ucfirst($clinic->admin->name) : '') }}">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Admin's Phone <span class="text-danger">*</span></label>
                        <input type="text" name="admin_phone" id="admin_phone" class="form-control" value="{{ old('admin_phone', $clinic->admin->phone ?? '') }}">
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="setting-title">
            <h5>Clinic Admins</h5>
        </div>
        <div class="setting-card">
            <div class="row">
                <div class="col">
                    <div class="custom-table">
                        <table class="table table-responsive table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>WhatsApp</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clinic->admins as $admin)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="doctor-profile.html" class="avatar avatar-sm me-2">
                                                    @if (isset($admin->profile_image))
                                                        <img class="avatar-img rounded-3" src="{{ asset('storage/profile_images/' . $admin->profile_image) }}" alt="User Image">
                                                    @else
                                                        <img class="avatar-img rounded-3" src={{ asset('storage/profile_images/default-profile-picture.webp') }} alt="User Image">
                                                    @endif
                                                </a>
                                                <a href="javascript:void(0);">{{ $admin->name }}</a>
                                            </h2>
                                        </td>
                                        <td>{{ $admin->phone }}</td>
                                        <td>{{ $admin->whatsapp ?? '-' }}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm prime-btn">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- /Clinic Admins -->
    <!-- Clinic Timings -->
    <div class="setting-title">
        <h5>Clinic Timings</h5>
    </div>
    <div class="setting-card">
        <div class="available-tab">
            <ul class="nav">
                <li>
                    <a href="#" class="active" data-bs-toggle="tab" data-bs-target="#Monday-slot">Monday</a>
                </li>
                <li>
                    <a href="#" data-bs-toggle="tab" data-bs-target="#Tuesday-slot">Tuesday</a>
                </li>
                <li>
                    <a href="#" data-bs-toggle="tab" data-bs-target="#Wednesday-slot">Wedneday</a>
                </li>
                <li>
                    <a href="#" data-bs-toggle="tab" data-bs-target="#Thursday-slot">Thursday</a>
                </li>
                <li>
                    <a href="#" data-bs-toggle="tab" data-bs-target="#Friday-slot">Friday</a>
                </li>
                <li>
                    <a href="#" data-bs-toggle="tab" data-bs-target="#Saturday-slot">Saturday</a>
                </li>
                <li>
                    <a href="#" data-bs-toggle="tab" data-bs-target="#Sunday-slot">Sunday</a>
                </li>
            </ul>
        </div>

        <div class="tab-content pt-0">
            @for ($i = 1; $i <= 7; $i++)
                <?php $currentDay = date('l', strtotime('Sunday + ' . $i . ' days')); ?>
                <div class="tab-pane fade @if ($i == 1) active show @endif" id="{{ $currentDay }}-slot">
                    <div class="slot-box">
                        <div class="slot-header">
                            <h5>{{ $currentDay }}</h5>
                        </div>
                        <div class="slot-body">
                            <ul class="shifts">
                                <li class="morning_shift border-bottom">
                                    <h5 class="d-inline-block">Morning</h5>
                                    <a href="#" class="add-slot float-end" data-bs-toggle="modal" data-bs-target="#add_slot" data-shift-number="1" data-shift="Morning" data-day-number="{{ $i }}" data-day="{{ $currentDay }}">Add Timing</a>
                                    <ul class="time-slots" id="{{ $currentDay }}-Morning-ul">
                                        @if (isset($ClinicWorkingHours[$i][1]))
                                            @foreach ($ClinicWorkingHours[$i][1] as $WorkingHour)
                                                <li>{{ date('h:i A', strtotime($WorkingHour['opening_time'])) }} - {{ date('h:i A', strtotime($WorkingHour['closing_time'])) }}</li>
                                            @endforeach
                                        @else
                                            <p>-</p>
                                        @endif
                                    </ul>
                                </li>
                                <li class="afternoon_shift border-bottom mt-3">
                                    <h5 class="d-inline-block">Afternoon</h5>
                                    <a href="#" class="add-slot float-end" data-bs-toggle="modal" data-bs-target="#add_slot" data-shift-number="2" data-shift="Afternoon" data-day-number="{{ $i }}" data-day="{{ $currentDay }}">Add Timing</a>
                                    <ul class="time-slots" id="{{ $currentDay }}-Afternoon-ul">
                                        @if (isset($ClinicWorkingHours[$i][2]))
                                            @foreach ($ClinicWorkingHours[$i][2] as $WorkingHour)
                                                <li>{{ date('h:i A', strtotime($WorkingHour['opening_time'])) }} - {{ date('h:i A', strtotime($WorkingHour['closing_time'])) }}</li>
                                            @endforeach
                                        @else
                                            <p>-</p>
                                        @endif
                                    </ul>
                                </li>
                                <li class="morning_shift border-bottom mt-3">
                                    <h5 class="d-inline-block">Evening</h5>
                                    <a href="#" class="add-slot float-end" data-bs-toggle="modal" data-bs-target="#add_slot" data-shift-number="3" data-shift="Evening" data-day-number="{{ $i }}" data-day="{{ $currentDay }}">Add Timing</a>
                                    <ul class="time-slots" id="{{ $currentDay }}-Evening-ul">
                                        @if (isset($ClinicWorkingHours[$i][3]))
                                            @foreach ($ClinicWorkingHours[$i][3] as $WorkingHour)
                                                <li>{{ date('h:i A', strtotime($WorkingHour['opening_time'])) }} - {{ date('h:i A', strtotime($WorkingHour['closing_time'])) }}</li>
                                            @endforeach
                                        @else
                                            <p>-</p>
                                        @endif
                                    </ul>
                                </li>
                                <li class="morning_shift mt-3">
                                    <h5 class="d-inline-block">Night</h5>
                                    <a href="#" class="add-slot float-end" data-bs-toggle="modal" data-bs-target="#add_slot" data-shift-number="4" data-shift="Night" data-day-number="{{ $i }}" data-day="{{ $currentDay }}">Add Timing</a>
                                    <ul class="time-slots" id="{{ $currentDay }}-Night-ul">
                                        @if (isset($ClinicWorkingHours[$i][4]))
                                            @foreach ($ClinicWorkingHours[$i][4] as $WorkingHour)
                                                <li>{{ date('h:i A', strtotime($WorkingHour['opening_time'])) }} - {{ date('h:i A', strtotime($WorkingHour['closing_time'])) }}</li>
                                            @endforeach
                                        @else
                                            <p>-</p>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <!-- /Clinic Timings -->
    <div class="modal-btn text-end">
        <button type="submit" class="btn btn-primary prime-btn" id="create_clinic">Save Changes</button>
    </div>
</form>

@section('modal')
    <!-- Add Slots -->
    <div class="modal fade custom-modals" id="add_slot">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Clinic Timings</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="add-dependent">
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="badge badge-info text-white px-4 mb-3">Day</p> <small class="fw-bold" id="modal-day-text">Monday</small>
                                <input type="hidden" value="" id="modal-day-number" name="modal-day-number">
                                <div class="form-wrap">
                                    <label class="form-label">Opening Time <span class="text-danger">*</span></label>
                                    <input type="text" id="clinic_opening_time" class="form-control timepicker1" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="badge badge-info text-white px-4 mb-3">Shift</p> <small class="fw-bold" id="modal-shift-text">Evening</small>
                                <input type="hidden" value="" id="modal-shift-number" name="modal-shift-number">
                                <div class="form-wrap">
                                    <label class="form-label">Closing Time <span class="text-danger">*</span></label>
                                    <input type="text" id="clinic_closing_time" class="form-control timepicker1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="modal-btn text-end">
                        <button class="btn btn-primary prime-btn rounded-pill px-5" id="add_slot_modal_button">Add</button>
                    </div>
                </div>
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
                        <a href="#" class="btn btn-gray" data-bs-toggle="modal" data-bs-dismiss="modal">Yes, Remove</a>
                        <button class="btn btn-primary prime-btn">No, i Changed my mind</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Remove Slots -->
@endsection
