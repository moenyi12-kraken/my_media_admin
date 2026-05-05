@extends('admin.layout.index')

@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">User Profile</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <form class="form-horizontal" method="POST" action="{{ route('admin#PasswordChange') }}">
                                @csrf

                                @session('success')
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ Session::get('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endsession

                                @session('fail')
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ Session::get('fail') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endsession

                                <div class="form-group row">
                                    <label for="oldPassword" class="col-sm-2 col-form-label">Old Password</label>
                                    <div class="col-sm-10">
                                        <input type="password"
                                            class="form-control @error('oldPassword') is-invalid @enderror"
                                            name="oldPassword" value="" placeholder="Old Password">
                                        @error('oldPassword')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="newPassword" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password"
                                            class="form-control @error('newPassword') is-invalid @enderror"
                                            name="newPassword" value="" placeholder="New Password">
                                        @error('newPassword')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password"
                                            class="form-control @error('confirmPassword') is-invalid @enderror"
                                            name="confirmPassword" value="" placeholder="Confirm Password...">
                                        @error('confirmPassword')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn bg-dark text-white">Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
