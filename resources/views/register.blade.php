@extends('layouts.app')

@section('content')

<div class="container d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-lg border-0 rounded-4 p-4"
         style="width: 100%; max-width: 420px;">

        <!-- Centered Round Image -->
        <div class="d-flex justify-content-center mb-3">
            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d"
                 class="rounded-circle shadow"
                 style="width: 120px; height: 120px; object-fit: cover;"
                 alt="Fleet Image">
        </div>

        <!-- Title -->
        <div class="text-center">
            <h4 class="fw-bold mb-1">Create Account</h4>
            <p class="text-muted small mb-4">Join FleetFlow System</p>
        </div>

        <!-- Form -->
        <form method="POST" action="#">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text"
                       class="form-control rounded-3"
                       placeholder="Enter your full name">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email"
                       class="form-control rounded-3"
                       placeholder="Enter your email">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password"
                       class="form-control rounded-3"
                       placeholder="Create password">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Confirm Password</label>
                <input type="password"
                       class="form-control rounded-3"
                       placeholder="Confirm password">
            </div>

            <div class="d-grid">
                <button type="submit"
                        class="btn btn-dark rounded-3">
                    Register
                </button>
            </div>

        </form>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-decoration-none small">
                Already have an account? Login
            </a>
        </div>

    </div>

</div>

@endsection