<!-- resources/views/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @stack('styles') <!-- Section-specific styles -->
</head>

<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <button id="sidebarToggle">☰</button> <br>
            <ul>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('events') }}">Events</a></li>
                <li><a href="{{ route('listedsecurities') }}">Listed Securities</a></li>
                <li><a href="{{ route('account-statement') }}">Account Statement</a></li>
                <li><a href="{{ route('history') }}">History</a></li>
                <li><a href="{{ route('trader-analytics') }}">Trader Analytics</a></li>
                <li><a href="{{ route('settings') }}">Settings</a></li>
            </ul>
        </div>
        <!-- Main Content -->
        <div class="content">
            @yield('content') <!-- Section-specific content -->
        </div>
    </div>

    <!-- Global JS -->
    <script src="{{ asset('js/script.js') }}"></script>
    @stack('scripts') <!-- Section-specific scripts -->
</body>

</html>
