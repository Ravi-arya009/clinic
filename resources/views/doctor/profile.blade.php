@php
    $pageTitle = 'Profile';
@endphp
@extends('doctor.layouts.main')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', $pageTitle)
@section('breadcrum-title', $pageTitle)
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', $pageTitle)


@push('stylesheets')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.cssI" rel="stylesheet">
@endpush
@section('content')
    <form id="update_profile" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="userId" value="{{ $doctor->id }}">
        <input type="hidden" name="role" value="{{ config('role.doctor') }}">
        <div class="setting-card">
            <div class="change-avatar img-upload">
                <div class="profile-img">
                    <div class="clinic-logo">
                        @if (isset($doctor))
                            @if (isset($doctor->profile_image))
                                <img src="{{ asset('storage/profile_images/' . $doctor->profile_image) }}" alt="Profile Picture">
                            @else
                                <img src="{{ asset('img/default-profile-picture.webp') }}" alt="Default Profile Picture">
                            @endif
                        @else
                            <i class="fa-solid fa-file-image"></i>
                        @endif
                    </div>
                </div>
                <div class="upload-img">
                    <h5>Profile Picture</h5>
                    <div class="imgs-load d-flex align-items-center">
                        <div class="change-photo">
                            Upload New
                            <input type="file" name="profile_picture" class="upload">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="setting-title">
            <h5>User Information</h5>
        </div>
        <div class="setting-card">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $doctor->name ?? '') }}" required>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Phone <span class="text-danger">*</span></label>
                        <input type="phone" name="phone" id="phone" class="form-control" value="{{ old('phone', $doctor->phone ?? '') }}" required>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">WhatsApp</label>
                        <input type="whatsapp" name="whatsapp" id="whatsapp" class="form-control" value="{{ old('whatsapp', $doctor->whatsapp ?? '') }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $doctor->email ?? '') }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Select</option>
                            <option value="1" {{ old('gender', $doctor->gender ?? '') == 1 ? 'selected' : '' }}>Male</option>
                            <option value="2" {{ old('gender', $doctor->gender ?? '') == 2 ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Date Of Birth</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob', $doctor->dob ?? '') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="setting-title">
            <h5>Address</h5>
        </div>
        <div class="setting-card">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">State</label>
                        <select class="form-control select2_dropdown" name="state" id="state">
                            <option value="" selected>Select</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}" {{ old('state', $doctor->state_id ?? '') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
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
                                <option value="{{ $city->id }}" {{ old('city', $doctor->city_id ?? '') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Address</label>
                        <textarea name="address" id="address" class="form-control">{{ old('address', $doctor->address ?? '') }}</textarea>
                    </div>
                </div>
                <div class="col-lg-6 col-md
                <div class="col-lg-6 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Pincode</label>
                        <input type="text" name="pincode" id="pincode" class="form-control" value="{{ old('pincode', $doctor->pincode ?? '') }}">
                    </div>
                </div>

            </div>
        </div>

        <div class="setting-title doctor-infofmation-card">
            <h5>Doctor Information</h5>
        </div>
        <div class="setting-card doctor-infofmation-card">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Speciality</label>
                        <select class="form-control select2_dropdown" name="speciality" id="speciality">
                            <option value="" selected>Select</option>
                            @foreach ($specialities as $speciality)
                                <option value="{{ $speciality->id }}" @if (old('speciality', $doctor->doctorProfile->speciality_id ?? '') == $speciality->id) selected @endif>{{ $speciality->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Qualification</label>
                        <select class="form-control select2_dropdown" name="qualification" id="qualification">
                            <option value="" selected>Select</option>
                            @foreach ($qualifications as $qualification)
                                <option value="{{ $qualification->id }}" @if (old('qualification', $doctor->doctorProfile->qualification_id ?? '') == $qualification->id) selected @endif>{{ $qualification->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Experience <span class="fw-light text-info">(In Years)</span></label>
                        <input type="text" name="experience" id="experience" class="form-control" value="{{ old('experience', $doctor->doctorProfile->experience ?? '') }}">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Consultaion Fee</label>
                        <input type="text" name="consultation_fee" id="consultation_fee" class="form-control" value="{{ old('consultation_fee', $doctor->doctorProfile->consultation_fee ?? '') }}">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Bio</label>
                        <textarea name="bio" id="bio" class="form-control">{{ old('consultation_fee', $doctor->doctorProfile->bio ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="modal-btn text-end">
            <button type="submit" class="btn btn-primary prime-btn">Save Changes</button>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
    <script src={{ asset('js/clinic-utils.js') }}></script>
    <script>
        $(function() {
            ImagePreview('.upload', '.profile-img');

            $('#update_profile').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('doctor.profile.update') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success == true) {
                            swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                            })
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr, status, error);
                    }
                });
            });
        });
    </script>
@endpush
