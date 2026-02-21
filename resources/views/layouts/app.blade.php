<!DOCTYPE html>
<html>

<head>
    <title>FleetFlow</title>
    @include('layouts.css')
</head>


<body class="bg-light">

    <nav>
        <a href="{{ url('/') }}" class="brand">FleetFlow</a>
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

    <div class="container mt-5">
        @yield('content')
    </div>
    @include('layouts.js')
    </script>
</body>

</html>