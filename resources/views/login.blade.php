@include('layouts.css')
<div class="container d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-lg border-0 rounded-4 text-center p-4" style="width: 100%; max-width: 400px;">


        <div class="d-flex justify-content-center mb-3">
            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d" class="rounded-circle shadow"
                style="width: 120px; height: 120px; object-fit: cover;" alt="Fleet Image">
        </div>

        <h4 class="fw-bold mb-1">FleetFlow</h4>
        <p class="text-muted small mb-4">Fleet Management System</p>

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="mb-3 text-start">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control rounded-3" placeholder="Enter your email">
            </div>

            <div class="mb-3 text-start">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control rounded-3" placeholder="Enter your password">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-dark rounded-3">
                    Login
                </button>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('password.request') }}" class="text-decoration-none small">
                    Forgot Password?
                </a>
            </div>

        </form>

        <div class="mt-3">
            <a href="{{ route('register') }}" class="text-decoration-none small">
                Don’t have an account? Register
            </a>
        </div>

    </div>

</div>
@include('layouts.js')
