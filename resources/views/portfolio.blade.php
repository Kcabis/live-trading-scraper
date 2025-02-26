
@extends('layout')
@section('content')
    {{-- <div class="dashboard">
        <div class="sidebar">
            <button id="sidebarToggle">☰</button> <br>
            <ul>
                <li><a href="#" data-target="dashboardSection" class="menu-item">Dashboard</a></li>
                <li><a href="#" data-target="eventsSection" class="menu-item">Events</a></li>
                <li><a href="#" data-target="listedsecuritiesSection" class="menu-item">Listed Securities</a></li>
                <li><a href="#" data-target="accountStatementSection" class="menu-item">Account Statement</a></li>
                <li><a href="#" data-target="buyHistorySection" class="menu-item"> History</a></li>
                <li><a href="#" data-target="traderAnalyticsSection" class="menu-item">Trader Analytics</a></li>
                <li><a href="#" data-target="settingsSection" class="menu-item">Settings</a></li>


            </ul>

        </div> --}}
        <h1>this is my page</h1>

        <div class="main-content">
            <div id="contentArea">
                <h1>hey there</h1>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- <script>
        function loadSection(section) {
            fetch(`/${section}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('contentArea').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error loading section:', error);
                });
        }

        window.onload = () => loadSection('dashboard');
    </script> --}}
@endpush

            