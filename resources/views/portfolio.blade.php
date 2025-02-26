
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
<<<<<<< HEAD
            <header>
                <div class="header-content">
                    <div class="search-container">
                    <p class="blinking-text">Welcome to Smart folio</p>
                    </div>
                    <div class="profile-icon">
                        <img src="/image/bull.jpg" alt="Profile">
                    </div>
                </div>
            </header>

            <!-- Dashboard Section -->
            <div id="dashboardSection" class="content-section">
                <div class="shareholder-options">
                    <select id="shareholderSelect">
                        <option value="" disabled selected>Select Portfolio</option>
                        @foreach($portfolios as $portfolio)
                        <option value="{{$portfolio->id}}"> {{$portfolio->portfolio_name}}</option>
                        @endforeach
                    </select>
                    <button id="addShareholder" >Add Portfolio</button>
                    <button id="editShareholder">Edit Portfolio</button>
                </div>
                <div class="overview">
                    <div class="card1">
                        <h3>Portfolio Value</h3>
                        <p id="marketValue">Rs 0.00</p>
                    </div>
                    <div class="card2">
                        <h3>Current Investment</h3>
                        <p id="currentInvestment">Rs 0.00</p>
                    </div>
                    <div class="card3">
                        <h3>Investment Return</h3>
                        <div class="gain-container">
                            <div class="gain-entry" id="Realizedgain-container">
                                <span>Realized Gain:</span>
                                <span id="Realizedgain">Rs 0.00</span>
                            </div>
                            <div class="gain-entry" id="UnrealizedGain-container">
                                <span>Unrealized Gain:</span>
                                <span id="UnrealizedGain">Rs 0.00</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card4">
                        <h3>Daily Gains</h3>
                        <p id="dailyGains">Rs 0.00</p>
                    </div>
                </div>
                <div class="portfolio-table">
                    <!-- Search box above the table -->
                    <div class="table-search-container">
                        <input type="text" id="tableSearchBox" placeholder="Search Stock Name...">
                    </div>
                
                    <table>
                        <thead>
                            <tr>
                                <th>SN</th> <!-- New SN column header -->
                                <th>Stock</th>
                                <th>Purchase Price</th>
                                <th>Quantity</th>
                                <th>Purchase Value</th>
                                <th>LTP</th>
                                <th>Market Value</th>
                                <th>Profit/Loss</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $stock)
                            <tr>
                                <td>{{$stock->id}}</td>
                                <td>{{$stock->stockName}}</td>
                                <td>{{$stock->purchase_price}}</td>
                                <td>{{$stock->quantity}}</td>
                                <td>{{$stock->purchase_value}}</td>
                                <td>{{$stock->ltp}}</td>
                                <td>{{$stock->market_value}}</td>
                                <td>{{$stock->profit_loss}}</td>
                                <td>
                                    <button class="sellStockBtn">Sell</button>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                       
                    </table>
                    <button id="addStock">Add Stock</button>
                    <button id="sellStock"> Sell stock</button>
                </div>
            </div>

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
=======
            <div id="contentArea">
                <h1>hey there</h1>
>>>>>>> 9d969e033887cb9409564c4b2685dadf35f1f522
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

            