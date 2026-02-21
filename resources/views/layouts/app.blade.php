<!DOCTYPE html>
<html>

<head>
    <title>FleetFlow</title>

    @include('layouts.css')

    <style>
        body {
            overflow-x: hidden;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed {
            margin-left: -250px;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Top Dark Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid py-2 d-flex align-items-center gap-3">

            <!-- Sidebar Toggle (Desktop) -->
            <button id="sidebarToggle" class="btn btn-outline-light">
                <i class="bi bi-list"></i>
            </button>

            <!-- Logo -->
            <a href="#" class="navbar-brand d-flex align-items-center gap-2 m-0">
                {{-- <img src="https://via.placeholder.com/35" height="35"> --}}
                <span class="fw-bold">FleetFlow</span>
            </a>

            <!-- Search + Buttons (UNCHANGED as requested) -->
            <div class="input-group" style="max-width:500px; padding-left: 35px;">

                <input type="text" class="form-control" placeholder="Search..." aria-label="Search">

                <button class="btn btn-primary" type="button">
                    Group By...
                </button>

                <button class="btn btn-success" type="button">
                    Filter
                </button>

                <button class="btn btn-danger" type="button">
                    Sort By...
                </button>

            </div>

            <div class=" ms-auto">
                <button class="btn btn-danger" type="button">
                    <i class="bi bi-logout mr-1"></i> Logout
                </button>

            </div>

        </div>
    </nav>

    <div class="d-flex">

        <!-- Sidebar -->
        <div id="sidebar" class="sidebar bg-dark text-white p-3">


            <ul class="nav nav-pills flex-column gap-2">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
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
                        class="nav-link text-white {{ request()->routeIs('maintenance.*') ? 'active' : '' }}">
                        <i class="bi bi-wrench-adjustable me-2"></i> Maintenance
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('expenses.index') }}"
                        class="nav-link text-white {{ request()->routeIs('expenses.*') ? 'active' : '' }}">
                        <i class="bi bi-currency-rupee me-2"></i> Trip & Expense
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('drivers.index') }}"
                        class="nav-link text-white {{ request()->routeIs('drivers.*') ? 'active' : '' }}">
                        <i class="bi bi-graph-up-arrow me-2"></i> Performance
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="bi bi-bar-chart-line me-2"></i> Analytics
                    </a>
                </li>

            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-100 p-4">
            @yield('content')
        </div>
    </div>

    <!-- Mobile Sidebar -->

    <!-- Sidebar Toggle Script -->
    <script>
        const toggleBtn = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
        });
    </script>

    @include('layouts.js')
</body>

</html>
