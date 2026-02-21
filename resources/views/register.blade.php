@include('layouts.css')

<div class="container d-flex align-items-center justify-content-center" style="min-height: calc(150vh - 80px);">

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
        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text" name="name"
                    class="form-control rounded-3"
                    placeholder="Enter your full name">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email"
                    class="form-control rounded-3"
                    placeholder="Enter your email">
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold mb-3">Select Role</label>

                <div class="row g-3">

                    @foreach($roles as $role)
                    <div class="col-6">

                        <input type="checkbox"
                            class="role-checkbox"
                            name="roles[]"
                            value="{{ $role->id }}"
                            id="role{{ $role->id }}">

                        <label for="role{{ $role->id }}" class="role-card">
                            {{ $role->name }}
                        </label>

                    </div>
                    @endforeach

                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password"
                    class="form-control rounded-3"
                    placeholder="Create password">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control rounded-3" placeholder="Confirm password">
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

@include('layouts.js')