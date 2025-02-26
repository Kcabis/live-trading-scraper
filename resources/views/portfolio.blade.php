
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

<<<<<<< HEAD
=======
            <!-- Financials Section -->
            <div id="eventsSection" class="content-section events-section" style="display: none;">
    <h2>Events</h2>
    @foreach($events as $event)
    <!-- Container for cards -->
     <div class="boxes">
    <div class="cards-container">
        <!-- Card 1 -->
        <div class="animated-card">
            
            <h3 class="card-title">{{$event->event_name}}</h3>
            <div class="card-data">
                <div class="data-left">
                    <p>{{$event->event_type}}</p>
                    <p>{{$event->stock_name}}</p>
                </div>
                <div class="data-right">
                    <p>{{$event->price}}</p>
                    <p>{{$event->event_date}}</p>
                </div>
            </div>
        </div>
</div>
        @endforeach
</div>
>>>>>>> 4e900b59cf30ca227797b8203fa1bb88e37405ad

            </ul>

        </div> --}}
        <h1>this is my page</h1>

        <div class="main-content">
            <div id="contentArea">
                <!-- The content for each section will be loaded dynamically here -->
                <h1>hey there</h1>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- <script>
        // Function to load content dynamically based on section name
        function loadSection(section) {
            // Use AJAX to load the content of the section dynamically
            fetch(`/${section}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('contentArea').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error loading section:', error);
                });
        }

        // Optionally, load the default section when the page is first loaded
        window.onload = () => loadSection('dashboard');
    </script> --}}
@endpush

            