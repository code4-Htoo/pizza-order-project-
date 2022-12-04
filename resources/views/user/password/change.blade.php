
@extends('user.layouts.master')

@section('content')
<div class="orw">
    <div class="col-4 offset-4">
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                <div class="">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Password</h3>
                                </div>
                                {{-- ChangePassword Success Alert Message --}}
                                @if (session('changePasswordSuccess'))
                                <div class="col-12">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="text-success fa-regular fa-circle-check mr-2"></i>{{session('changePasswordSuccess')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>
                                </div>
                                @endif
                                {{-- Oldpassword not match Alert Message --}}
                                @if (session('notMatch'))
                                <div class="col-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-triangle-exclamation me-2"></i></i>{{session('notMatch')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>
                                </div>
                                @endif
                                <hr>
                                <form action="{{ route('user#ChangePassword') }}" method="post" novalidate="novalidate">
                                    @csrf

                                    <div class="form-group">
                                        <label  class="control-label mb-1">Old Password</label>
                                        <input id="cc-pament" name="oldPassword" type="password" class="form-control
                                        @error ('oldPassword') is-invalid @enderror"

                                        aria-required="true" aria-invalid="false" placeholder="Enter Old password...">

                                        @error('oldPassword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">New Password</label>
                                        <input id="cc-pament" name="newPassword" type="password" class="form-control @error ('newPassword') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter New Password...">
                                        @error('newPassword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Confirm Password</label>
                                        <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error ('confirmPassword') is-invalid @enderror"

                                        aria-required="true" aria-invalid="false" placeholder="Confirm New Password...">
                                        @error('confirmPassword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-dark text-white btn-block ">
                                            <span class=""
                                            id="payment-button-amount">Change Password</span>
                                            {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                            <i class=" fa-solid fa-circle-right"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
