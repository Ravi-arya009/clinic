{{-- {{dd($clinic)}} --}}
<form action="{{ $action }}" method="POST">
    @csrf
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
                    <label class="col-form-label">Area</label>
                    <input type="text" name="area" id="area" class="form-control" value="{{ old('area', $clinic->area ?? '') }}">
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="form-wrap">
                    <label class="col-form-label">Clinic's Phone </label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $clinic->phone ?? '') }}">
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="form-wrap">
                    <label class="col-form-label">Contact Person</label>
                    <input type="text" name="contact_person" id="contact_person" class="form-control" value="{{ old('contact_person', isset($clinic) ? ucfirst($clinic->contact_person) : '') }}">
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-wrap">
                    <label class="col-form-label">Contact Person's Phone</label>
                    <input type="text" name="contact_person_phone" id="contact_person_phone" class="form-control" value="{{ old('contact_person_phone', $clinic->contact_person_phone ?? '') }}">
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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif --}}

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="modal-btn text-end">
        <button type="submit" class="btn btn-primary prime-btn">Save Changes</button>
    </div>

</form>
