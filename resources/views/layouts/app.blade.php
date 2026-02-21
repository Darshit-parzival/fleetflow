<!DOCTYPE html>
<html>
<head>
    <title>FleetFlow</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">FleetFlow</a>
    </div>
</nav>

<div class="container mt-5">
    @yield('content')
</div>

</body>
</html>