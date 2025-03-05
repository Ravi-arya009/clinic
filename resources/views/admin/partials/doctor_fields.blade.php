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
                        <option value="{{ $speciality->id }}" @if (old('speciality', $user->doctorProfile->speciality_id ?? '') == $speciality->id) selected @endif>{{ $speciality->name }}</option>
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
                        <option value="{{ $qualification->id }}" @if (old('qualification', $user->doctorProfile->qualification_id ?? '') == $qualification->id) selected @endif>{{ $qualification->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-wrap">
                <label class="col-form-label">Experience <span class="fw-light text-info">(In Years)</span></label>
                <input type="text" name="experience" id="experience" class="form-control" value="{{ old('experience', $user->doctorProfile->experience ?? '') }}">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-wrap">
                <label class="col-form-label">Consultaion Fee</label>
                <input type="text" name="consultation_fee" id="consultation_fee" class="form-control" value="{{ old('consultation_fee', $user->doctorProfile->consultation_fee ?? '') }}">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-wrap">
                <label class="col-form-label">Bio</label>
                <textarea name="bio" id="bio" class="form-control">{{ old('consultation_fee', $user->doctorProfile->bio ?? '') }}</textarea>
            </div>
        </div>
    </div>
</div>
