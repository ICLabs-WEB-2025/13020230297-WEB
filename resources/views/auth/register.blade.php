@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center min-vh-100">
        <!-- Register Form -->
        <div class="col-12 col-md-6 col-lg-6"> <!-- Adjust the width like the login form -->
            <div class="card shadow-lg border-0 rounded-3 p-4" style="background-color: rgba(255, 255, 255, 0.8);">
                <div class="card-header bg-transparent text-center">
                    <h3 class="mb-0" style="font-family: 'Poppins', sans-serif; font-weight: 600;">Register</h3>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label" style="font-weight: 600; color: #333;">Name <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus style="border-radius: 8px; padding: 10px;">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label" style="font-weight: 600; color: #333;">Email Address <span class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required style="border-radius: 8px; padding: 10px;">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label" style="font-weight: 600; color: #333;">Password <span class="text-danger">*</span></label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required style="border-radius: 8px; padding: 10px;">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label" style="font-weight: 600; color: #333;">Confirm Password <span class="text-danger">*</span></label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required style="border-radius: 8px; padding: 10px;">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 8px; font-weight: bold; background-color: #007bff; border: none; transition: background-color 0.3s;">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <p style="font-weight: 600;">Already have an account? <a href="{{ route('login') }}" style="color: #007bff;">Login here</a></p>
            </div>
        </div>
    </div>
</div>
@endsection