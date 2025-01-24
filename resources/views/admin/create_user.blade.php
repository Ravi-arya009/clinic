@extends('admin.layouts.main')

@section('title', 'Create User')

@section('breadcrum-title', 'Create User')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Create User')

@section('content')


    <div class="dashboard-header">
        <h3>Profile Settings</h3>
    </div>


    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf
        <div class="setting-title">
            <h5>Information</h5>
        </div>
        <div class="setting-card">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Phone <span class="text-danger">*</span></label>
                        <input type="phone" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">WhatsApp</label>
                        <input type="whatsapp" name="whatsapp" id="whatsapp" class="form-control" value="{{ old('phone') }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Role<span class="text-danger">*</span> </label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="">Select Role</option>
                            @foreach (config('role') as $roleName => $roleId)
                                <option value="{{ $roleId }}">{{ ucfirst($roleName) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-wrap">
                        <label class="col-form-label">Gender </label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Select</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
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
            <button type="submit" class="btn btn-primary prime-btn">Save Changes</button>
        </div>

    </form>

    </div>
@endsection
