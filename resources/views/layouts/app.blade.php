<!DOCTYPE html>
<html>

<head>
    <title>FleetFlow</title>

    @include('layouts.css')
</head>


<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">FleetFlow</a>
        </div>
    </nav>
    @if(session('success') || session('error'))
    <div class="flash-wrapper">

        <div class="flash-box {{ session('success') ? 'success' : 'error' }}">
            <div class="flash-content">
                {{ session('success') ?? session('error') }}
            </div>
            <div class="flash-progress"></div>
        </div>

    </div>
    @endif

    <div class="d-flex">

        <!-- Sidebar (Desktop) -->
        <div class="sidebar d-none d-lg-block bg-dark text-white p-3">
            <h5 class="fw-bold mb-4">FleetFlow</h5>

            <ul class="nav nav-pills flex-column gap-2">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('drivers.index') }}"
                        class="nav-link text-white {{ request()->routeIs('drivers.*') ? 'active' : '' }}">
                        <i class="bi bi-person"></i> Drivers
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('vehicles.index') }}"
                        class="nav-link text-white {{ request()->routeIs('vehicles.*') ? 'active' : '' }}">
                        <i class="bi bi-truck me-2"></i> Vehicle Registry
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('trips.index') }}"
                        class="nav-link text-white {{ request()->routeIs('trips.*') ? 'active' : '' }}">
                        <i class="bi bi-map me-2"></i> Trip Dispatcher
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('maintenance.index') }}"
                        class="nav-link text-white {{ request()->routeIs('maintanance.*') ? 'active' : '' }}">
                        <i class="bi bi-tools me-2"></i> Maintenance
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('expenses.index') }}"
                        class="nav-link text-white {{ request()->routeIs('expenses.*') ? 'active' : '' }}">
                        <i class="bi bi-currency-rupee me-2"></i> Trip & Expense
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="bi bi-person-check me-2"></i> Performance
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="bi bi-graph-up me-2"></i> Analytics
                    </a>
                </li>

            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">

            <!-- Top Navbar (Mobile toggle) -->
            <nav class="navbar navbar-light bg-white shadow-sm px-3">
                <button class="btn btn-outline-dark d-lg-none" data-bs-toggle="offcanvas"
                    data-bs-target="#mobileSidebar">
                    <i class="bi bi-list"></i>
                </button>

                <span class="fw-semibold">Dashboard</span>
            </nav>

            <div class="p-4">
                @yield('content')
            </div>
        </div>

    </div>

    <!-- Mobile Sidebar -->
    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="mobileSidebar">

        <div class="offcanvas-header">
            <h5 class="offcanvas-title">FleetFlow</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body">
            <ul class="nav nav-pills flex-column gap-2">

                <li class="nav-item">
                    <a href="#" class="nav-link text-white active">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-white">Vehicle Registry</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-white">Trip Dispatcher</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-white">Maintenance</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-white">Trip & Expense</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-white">Performance</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-white">Analytics</a>
                </li>

            </ul>
        </div>
    </div>

    @include('layouts.js')
    </script>
</body>

</html>