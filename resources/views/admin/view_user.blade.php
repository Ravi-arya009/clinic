@extends('admin.layouts.main')

@section('title', 'User Profile')

@section('breadcrum-title', 'User Profile')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'User Profile')

@section('content')


    <div class="dashboard-header">
        <h3>Profile Settings</h3>
    </div>

    <div class="setting-title">
        <h5>Profile</h5>
    </div>

    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="setting-card">
            <div class="change-avatar img-upload">
                <div class="profile-img">
                    {{-- <i class="fa-solid fa-file-image"></i> --}}
                    <img src="{{ asset('img/doctors-dashboard/profile-01.jpg') }}">
                </div>
                <div class="upload-img">
                    <h5>Profile Image</h5>
                    <div class="imgs-load d-flex align-items-center">
                        <div class="change-photo">
                            Upload New
                            <input type="file" class="upload">
                        </div>
                        <a href="#" class="upload-remove">Remove</a>
                    </div>
                    <p class="form-text">Your Image should Below 4 MB, Accepted format jpg,png,svg</p>
                </div>
            </div>
        </div>
        <div class="setting-title">
            <h5>Information</h5>
        </div>
        <div class="setting-card">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Phone <span class="text-danger">*</span></label>
                        <input type="phone" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" required>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">WhatsApp</label>
                        <input type="whatsapp" name="whatsapp" id="whatsapp" class="form-control" value="{{ $user->whatsapp }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Email Address </label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Gender </label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">
                                Select
                            </option>
                            <option value="1" @if ($user->gender == 1) selected @endif>
                                Male
                            </option>
                            <option value="2" @if ($user->gender == 2) selected @endif>
                                Female
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Role </label>
                        <select name="role" id="role" class="form-control" required>
                            @foreach (config('role') as $roleName => $roleId)
                                <option value="{{ $roleId }}" @if ($user->role == $roleId) selected @endif>
                                    {{ ucfirst($roleName) }}
                                </option>
                            @endforeach

                        </select>
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
            <a href="#" class="btn btn-gray">Cancel</a>
            <button type="submit" class="btn btn-primary prime-btn">Save Changes</button>
        </div>

    </form>

    </div>
@endsection
