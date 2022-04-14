@extends('layouts.backend.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.index') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.index') }}">Users</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $user->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center mb-3">
                                    <i class="fas fa-id-badge fa-5x"></i>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstName">First Name</label>
                                        <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" class="form-control" value="{{ $user->last_name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phoneNumber">Phone Number</label>
                                        <input type="number" class="form-control" value="{{ $user->phone }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" value="{{ $user->address }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" value="{{ $user->city }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="province">Province</label>
                                        <input type="text" class="form-control" value="{{ $user->province }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" value="{{ $user->country }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pinCode">Pin Code</label>
                                        <input type="text" class="form-control" value="{{ $user->pin_code }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="role_as">Role</label>
                                        <input type="text" class="form-control"
                                            value="{{ Str::title($user->role_as) }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="float-left mt-3">
                                <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm" role="button">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
