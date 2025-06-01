@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center min-vh-100">
        <!-- Login Form -->
        <div class="col-12 col-md-6 col-lg-6"> <!-- Wider form with col-md-6 and col-lg-6 -->
            <div class="card shadow-lg border-0 rounded-3 p-4" style="background-color: rgba(255, 255, 255, 0.8);">
                <div class="card-header bg-transparent text-center">
                    <h3 class="mb-0" style="font-family: 'Poppins', sans-serif; font-weight: 600;">Login</h3>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label" style="font-weight: 600; color: #333;">Email Address <span class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus style="border-radius: 8px; padding: 10px;">
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
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember" style="border-radius: 5px;">
                            <label class="form-check-label" for="remember_me">Remember me</label>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            @if (Route::has('password.request'))
                            <!-- <a class="btn btn-link" href="{{ route('password.request') }}" style="color: #007bff; font-size: 0.9rem;">Forgot Your Password?</a> -->
                            @endif
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 8px; font-weight: bold; background-color: #007bff; border: none; transition: background-color 0.3s;">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <p style="font-weight: 600;">Don't have an account? <a href="{{ route('register') }}" style="color: #007bff;">Register here</a></p>
            </div>
        </div>

        <!-- Anime Card Image -->
        <div class="col-12 col-md-6 col-lg-6 d-flex justify-content-center align-items-center">
            <div class="anime-card-container">
                <img src="{{ asset('images/anime-card.png') }}" alt="Anime Card" class="anime-card img-fluid" />
            </div>
        </div>
    </div>
</div>

@section('styles')
<style>
    /* Anime Card Styling */
    .anime-card-container {
        perspective: 1000px;
        width: 100%;
        max-width: 300px;
        /* Ukuran maksimum card */
    }

    .anime-card {
        width: 100%;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .anime-card:hover {
        transform: rotateY(15deg) rotateX(5deg);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    /* Card and Form Styling */
    .card {
        padding: 1.5rem;
        /* Padding lebih besar untuk form */
    }

    .card-body {
        padding: 1.5rem;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px;
        /* Padding lebih besar untuk input */
        font-size: 1rem;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        font-weight: bold;
        transition: background-color 0.3s ease-in-out;
        padding: 10px 20px;
        /* Tombol lebih besar */
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .anime-card-container {
            max-width: 250px;
            /* Lebih kecil di mobile */
        }

        .card {
            margin-bottom: 1rem;
            padding: 1rem;
        }

        .card-body {
            padding: 1rem;
        }

        .form-control {
            padding: 10px;
            font-size: 0.95rem;
        }

        .btn-primary {
            padding: 8px 16px;
        }

        .col-md-5,
        .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    @media (min-width: 769px) and (max-width: 992px) {
        .anime-card-container {
            max-width: 280px;
        }

        .card {
            padding: 1.2rem;
        }

        .card-body {
            padding: 1.2rem;
        }

        .form-control {
            padding: 11px;
        }

        .col-md-5 {
            flex: 0 0 45%;
            max-width: 45%;
        }

        .col-md-6 {
            flex: 0 0 48%;
            max-width: 48%;
        }
    }

    @media (min-width: 993px) {
        .anime-card-container {
            max-width: 300px;
        }
    }
</style>
@endsection

@endsection