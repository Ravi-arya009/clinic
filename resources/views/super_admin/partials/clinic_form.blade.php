<form action="{{ $action }}" method="POST">
    @csrf
    <div class="setting-card">
        <div class="change-avatar img-upload">
         <div class="profile-img">
             @if (isset($clinic))
                 <img src="{{ asset('storage/profile_images/' . $clinic->profile_image) }}" alt="Profile Picture">
             @else
                 <i class="fa-solid fa-file-image"></i>
             @endif
         </div>
         <div class="upload-img">
             <h5>Profile Picture</h5>
             <div class="imgs-load d-flex align-items-center">
                 <div class="change-photo">
                     Upload New
                     <input type="file" name="profile_picture" class="upload">

                 </div>
                 <a href="#" class="upload-remove">Remove</a>
             </div>
         </div>
     </div>

    </div>
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

    <div class="row">
        <div class="col-lg-6">
            <div class="setting-title">
                <h5>Contact Information</h5>
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
                <h5 class="d-inline-block">Contact Person</h5><span class="text-danger ms-2">(For Super Admin Use Only)</span>
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


    @if (!isset($clinic))
        {{-- make a user form partial and fetch it instead of writing the whole code --}}
        <div class="row">
            <div class="setting-title">
                <h5>Admin Information</h5>
            </div>
            <div class="setting-card">
                <input type="hidden" name="admin_id" id="admin_id" value="{{ isset($clinic) ? ucfirst($clinic->admin->id) : '' }}">
                <div class="row">
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
        </div>
    @else
        {{-- make a table partial and fetch it instead of writing the whole code --}}
        <div class="setting-title">
            <h5>Clinic Admins</h5>
        </div>
        <div class="setting-card p-1">
            <div class="custom-table">
                <div class="table-responsive">
                    <table class="table table-center mb-0">
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
                                                <img class="avatar-img rounded-3" src="{{ asset('img/doctors/doctor-thumb-02.jpg') }}" alt="User Image">
                                            </a>
                                            <a href="doctor-profile.html">{{ $admin->name }}</a>
                                        </h2>
                                    </td>
                                    <td>{{ $admin->phone }}</td>
                                    <td>{{ $admin->whatsapp ?? '-' }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm prime-btn">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    <div class="modal-btn text-end">
        <button type="submit" class="btn btn-primary prime-btn">Save Changes</button>
    </div>

</form>
