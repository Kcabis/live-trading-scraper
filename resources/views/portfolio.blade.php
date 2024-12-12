<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Management Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{ asset('css/events.css')}}">
    <link rel="stylesheet" href="{{asset('css/settings.css')}}">
</head>
<body>
    <div class="dashboard">
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
            
        </div>
       
        <div class="main-content">
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
            </div>
        </div>
</div>
        @endforeach
</div>


            <!-- Advanced Charts Section -->
            <div id="listedsecuritiesSection" class="content-section" style="display: none;">
                <h2>Listed Securities</h2>
                <!-- Advanced Charts content goes here -->
            </div>

            <!-- Account Statement Section -->
            <div id="accountStatementSection" class="content-section" style="display: none;">
                <h2>Account Statement</h2>
                <!-- Account Statement content goes here -->
            </div>            
                  <!-- Buy History Section -->
            <div id="buyHistorySection" class="content-section" style="display: none;">
                <h2>Buy History</h2>
                <!-- Buy History content goes here -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    .table-container {
                        margin-top: 20px;
                        
                    }
                    .table{
                        width: 100%;
                    }
                    .table th {
                        background-color: #2a9d8f;
                        color: white;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="showEntries">Show 
                                <select id="showEntries" class="form-select form-select-sm" style="width: auto; display: inline-block;">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries
                            </label>
                        </div>
                        <!-- <div class="col-md-6 text-end">
                            <input type="text" id="searchBox" class="form-control form-control-sm" placeholder="Search">
                        </div> -->
                    </div>
                    
                    <div class="table-container">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Stock</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Purchase Price</th>
                                    <th>Selling price</th>
                                    <th>Profit amount</th>
                                    <th>CGT</th>
                                    <th>Amt Receivable</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            
            </div>
            <!-- Trader Analytics Section -->
            <div id="traderAnalyticsSection" class="content-section" style="display: none;">
                <h2>Trader Analytics</h2>
                <!-- Trader Analytics content goes here -->
            </div>

            <!-- Settings Section -->
            <!-- Settings Section -->
<div id="settingsSection" class="content-section" style="display: none;">
    <h2>Settings</h2>
    <div class="profile-container">
        <img id="profileImage" class="profile-img" src="default-profile.png" alt="Profile Image" />
        <button id="editProfileButton" class="edit-profile-btn">Edit</button>
    </div>
    <div class="user-details">
        <h3>User Details</h3>
        <form id="userDetailsForm">
            <label for="username">Username</label>
            <label for="email">Email</label>
            <label for="phone">Phone No.</label>
        </form>
    </div>
    <div class="change-password">
        <h3>Change Password</h3>
        <form id="passwordForm">
            <label for="currentPassword">Current Password</label>
            <input type="password" id="currentPassword" name="currentPassword" placeholder="Enter current password" />

            <label for="newPassword">New Password</label>
            <input type="password" id="newPassword" name="newPassword" placeholder="Enter new password" />

            <label for="retypePassword">Retype Password</label>
            <input type="password" id="retypePassword" name="retypePassword" placeholder="Retype new password" />
        </form>
    </div>
</div>

<!-- Popup Modal -->
<div id="imageUploadModal" class="modal">
    <div class="modal-content">
        <span id="closeModal" class="close">&times;</span>
        <h3>Upload Profile Image</h3>
        <input type="file" id="imageInput" />
        <button id="saveImageButton">Save</button>
    </div>
</div>

        </div>
    </div>

 <!-- Add Stock Pop-Up Form -->
<div id="addStockPopup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h2>Add New Stock</h2>
        <form id="addStockForm" action="/add-stock" method="POST">
            @csrf
            <label for="stockName">Stock Name:</label>
            <select id="stockName" name="stockName" required>
                <option value="" disabled selected>Select Stock</option>
                @foreach($symbols as $symbol)
                <option value="{{$symbol}}">{{$symbol}}</option>
                @endforeach
            </select>
            <label for="select" id="select" class="ok">Type</label>
            <select id="sel" class="form-select" name="type">
                <option value="IPO">IPO</option>
                <option value="Secondary">Secondary</option>
                <option value="Right">Right</option>
                <option value="Bonus">Bonus</option>
            </select> <br>
            <label for="purchasePrice">Purchase Price:</label>
            <input type="number" id="purchasePrice" name="purchasePrice" step="0.01" required>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
            
            <!-- Hidden Fields for Confirmation Data -->
            <input type="hidden" id="confirmTotalAmount" name="totalAmount">
            <input type="hidden" id="confirmSebonCommission" name="sebonCommission">
            <input type="hidden" id="confirmBrokerCommission" name="brokerCommission">
            <input type="hidden" id="confirmDpFee" name="dpFee">
            <input type="hidden" id="confirmWacc" name="wacc">
            <input type="hidden" id="confirmTotalCost" name="totalCost">

            <!-- Buttons -->
            <button type="button" id="addStockBtn">OK</button>
            <button type="button" id="cancelStockBtn">Cancel</button>
        </form>
    </div>
</div>

<!-- Buy Confirmation Popup -->
<div id="confirmPopup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h2>Confirm Stock Details</h2>
        <p>Total Amount: Rs. <span id="confirmTotalAmountDisplay"></span></p>
        <p>SEBON Commission: Rs. <span id="confirmSebonCommissionDisplay"></span></p>
        <p>Broker Commission: Rs. <span id="confirmBrokerCommissionDisplay"></span></p>
        <p>DP Fee: Rs. <span id="confirmDpFeeDisplay"></span></p>
        <p>WACC: Rs. <span id="confirmWaccDisplay"></span></p>
        <p>Total Cost: Rs. <span id="confirmTotalCostDisplay"></span></p>

        <!-- Buttons -->
        <button type="button" id="send">OK</button>
        <button type="button" id="cancelConfirmBtn">Cancel</button>
    </div>
</div>

{{-- 
<script>
// Convert the stock name to uppercase as the user types
document.getElementById('stockName').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
});

// Optional: Handling pop-up open and close actions
var popup = document.getElementById('addStockPopup');
var closeBtn = document.getElementsByClassName('close')[0];

function openPopup() {
    popup.style.display = "block";
}

function closePopup() {
    popup.style.display = "none";
}

closeBtn.onclick = closePopup;

window.onclick = function(event) {
    if (event.target == popup) {
        closePopup();
    }
};
</script> --}}



    <!-- Sell Stock Pop-Up Form -->
<div id="sellStockPopup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h2>Sell your stock</h2>
        <form id="sellStockForm">
            <label for="stockName">Stock Name:</label>
            <input type="text" id="sName" name="stockName" required>
            
            <label for="sellingPrice">Selling Price:</label>
            <input type="number" id="sellingPrice" name="sellingPrice" step="0.01" required>
            
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>

            <label for="sel">Capital gain Tax</label>
            <select id="sel" class="form-select">
            <option value="1">7.5%</option>
            <option value="2">5%</option>
            </select>
            <br>
            <button type="button" id="sellStockBtn">OK</button>
            <button type="button" id="cancelSellStockBtn">Cancel</button>
        </form>
    </div>
</div>

<script>
    // Automatically convert stock name to uppercase
    document.getElementById('sName').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
})
</script>


<!-- Add shareholder popup -->
<div id="addShareholderPopup" class="popup" style="display: none;">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Add New Portfolio</h2>
            <form id="addShareholderForm" action="/add-ph" method="POST">
                @csrf
                <label for="shareholderName">Portfolio Name:</label>
                <input type="text" id="shareholderName" name="portfolio_name" required>
                <button type="submit" id="addShareholderBtn">Add Portfolio</button>
                <button type="button" id="cancelShareholderBtn">Cancel</button>
            </form>
        </div>
    </div>

   

    <!-- Sell  Confirmation Popup -->
    <div id="sellconfirmPopup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Confirm Stock Details</h2>
            <p>Total Amount: Rs. <span id="confirmTotalAmount"></span></p>
            <p>SEBON Commission: Rs. <span id="confirmSebonCommission"></span></p>
            <p>Broker Commission: Rs. <span id="confirmBrokerCommission"></span></p>
            <p>DP Fee: Rs. <span id="confirmDpFee"></span></p>
            <p>WACC: Rs. <span id="confirmWacc"></span></p>
            <p>CGT:Rs. <span id="CGT"></span></p>
            <p>Net Receivale:Rs. <span id="Net revceiavale"></span></p>
            <button type="button" id="sellconfirmBtn">Confirm</button>
            <button type="button" id="cancelConfirmBtn">Cancel</button>
        </div>
    </div>
 <!-- Edit Portfolio Modal -->
<div id="editPortfolioPopup" class="popup">
    <div class="popup-content">
        <input type="hidden" id="editPortfolioId">
        <label for="editPortfolioName">Choose a portfolio</label>
        
        <span class="close">&times;</span>
        <h2>Edit Portfolio</h2>
        <form id="editPortfolioForm">
             @foreach($portfolios as $portfolio)
            <select name="portfolio" id="portfolio">
                <option value="{{$portfolio->id}}">{{$portfolio->portfolio_name}}</option>
            </select>
            @endforeach
            <input type="text" id="editPortfolioName" required>
            <button type="submit">Update portfolio</button>
            <button type="Delete">Delete Portfolio</button>
        </form>
    </div>
</div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>