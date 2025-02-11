<div class="setting-title">
    <h5>User Information</h5>
</div>
<div class="setting-card">
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="form-wrap">
                <label class="col-form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $patient->name ?? '') }}" required>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="form-wrap">
                <label class="col-form-label">Phone <span class="text-danger">*</span></label>
                <input type="phone" name="phone" id="phone" class="form-control" value="{{ old('phone', $patient->phone ?? '') }}" required>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="form-wrap">
                <label class="col-form-label">WhatsApp</label>
                <input type="whatsapp" name="whatsapp" id="whatsapp" class="form-control" value="{{ old('whatsapp', $patient->whatsapp ?? '') }}">
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="form-wrap">
                <label class="col-form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $patient->email ?? '') }}">
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="form-wrap">
                <label class="col-form-label">Gender </label>
                <select name="gender" id="gender" class="form-control">
                    <option value="">Select</option>
                    <option value="1" {{ old('gender', $patient->gender ?? '') == 1 ? 'selected' : '' }}>Male</option>
                    <option value="2" {{ old('gender', $patient->gender ?? '') == 2 ? 'selected' : '' }}>Female</option>
                </select>
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
                        <option value="{{ $state->id }}" {{ old('state', $patient->state_id ?? '') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
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
                        <option value="{{ $city->id }}" {{ old('city', $patient->city_id ?? '') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-md
                <div class="col-lg-6 col-md-6">
            <div class="form-wrap">
                <label class="col-form-label">Pincode</label>
                <input type="text" name="pincode" id="pincode" class="form-control" value="{{ old('pincode', $patient->pincode ?? '') }}">
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="form-wrap">
                <label class="col-form-label">Area</label>
                <input type="text" name="area" id="area" class="form-control" value="{{ old('area', $patient->area ?? '') }}">
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="form-wrap">
                <label class="col-form-label">Address</label>
                <textarea name="address" id="address" class="form-control">{{ old('address', $patient->address ?? '') }}</textarea>
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
