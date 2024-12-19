@extends('portfolio')

@section('title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endpush

@section('content')
    <h2>Dashboard</h2>
    <!-- Dashboard content goes here -->

            <!-- Dashboard Section -->
            <div id="dashboardSection" class="content">
                <div class="shareholder-options">
                   

                    <div style="
                        display: flex;
                        justify-content: start;
                        align-items: center;
                        margin-top: 20px;
                    ">
                     <select id="shareholderSelect">
                        <option value="" disabled selected>Select Portfolio</option>
                        @foreach($portfolios as $portfolio)
                            <option value="{{$portfolio->id}}"> {{$portfolio->portfolio_name}}</option>
                        @endforeach
                    </select>


                 

                        <form id="searchStockForm" action="/portfolio" method="GET">
                            <input type="hidden" id="portfolio_id" name="portfolio_id">
                            <button type="submit" style="padding: 8px;
    font-size: 12px;
    margin-left: 10px; /* Space between buttons */
    cursor: pointer;
    background-color: #ccc; /* Blue background for buttons */
    color: black;
    border: none;
    border-radius: 8px;">Search</button>
                        </form>

                        <form id="clearStockForm" action="/portfolio" method="GET">
                            <button type="submit" style="padding: 8px;
    font-size: 12px;
    margin-left: 10px; /* Space between buttons */
    cursor: pointer;
    background-color: #ccc; /* Blue background for buttons */
    color: black;
    border: none;
    border-radius: 8px;">Clear</button>
                        </form>

                        <button id="addShareholder">Add Portfolio</button>
                        <button id="editShareholder">Edit Portfolio</button>

                    </div>




                </div>
                <div class="overview">
                    <div class="card1">
                        <h3>Portfolio Value</h3>
                        <p id="portfolioVal">Rs 0.00</p>
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
                                    <td>{{$stock->stock_name}}</td>
                                    <td>{{$stock->wacc}}</td>
                                    <td>{{$stock->quantity}}</td>
                                    <td>
                                        <script>
                                            var purchasePrice = {{$stock->wacc}};
                                            var quantity = {{$stock->quantity}};
                                            var purchaseValue = purchasePrice * quantity;
                                            document.write(purchaseValue);
                                        </script>
                                    </td>
                                    <td>{{$stock->ltp}}</td>
                                    <td>
                                        <script>
                                            var ltpRaw = '{{$stock->ltp}}'.replace(/,/g, '');
                                            var ltp = parseFloat(ltpRaw);
                                            var marketValue = ltp * quantity;
                                            document.write('<p id="marketValue">' + marketValue + '</p>' +
                                                '<input type="hidden" id="marketValueRaw" value="' + marketValue + '">');
                                        </script>
                                    </td>
                                    <td>
                                        <script>
                                            var purchaseValue = {{$stock->wacc}} * {{$stock->quantity}};
                                            var ltpRaw = '{{$stock->ltp}}'.replace(/,/g, '');
                                            var ltp = parseFloat(ltpRaw);
                                            var marketValue = ltp * {{$stock->quantity}};

                                            var profitLoss = marketValue - purchaseValue;
                                            if (profitLoss > 0) {
                                                document.write('<span class="profit-badge">Profit</span> Rs. ' + profitLoss.toFixed(2));
                                            } else if (profitLoss < 0) {
                                                document.write('<span class="loss-badge">Loss</span> Rs. ' + Math.abs(profitLoss).toFixed(2));
                                            } else {
                                                document.write('Rs. 0.00');
                                            }
                                        </script>
                                    </td>
                                    <td>
                                        <button class="addStockBtn">Add</button>
                                        <button class="editStockBtn">Edit</button>
                                        <button class="deleteStockBtn">Delete</button>
                                    </td>
                                </tr>

                            @endforeach

                            <script>
                                // calculate all market value sum and append to portfolioVal
                                var marketValueSum = 0;
                                var marketValueElements = document.querySelectorAll('#marketValueRaw');
                                marketValueElements.forEach(function (element) {
                                    marketValueSum += parseFloat(element.value);
                                });
                                document.getElementById('portfolioVal').textContent = 'Rs. ' + marketValueSum.toFixed(2);


                            </script>

                            <style>
                                .profit-badge {
                                    background-color: #2a9d8f;
                                    color: white;
                                    padding: 5px 10px;
                                    border-radius: 5px;
                                }

                                .loss-badge {
                                    background-color: #e76f51;
                                    color: white;
                                    padding: 5px 10px;
                                    border-radius: 5px;
                                }

                                #marketValueRaw {
                                    display: none;
                                }
                            </style>
                        </tbody>

                    </table>
                    <button id="addStock">Add Stock</button>
                    <button id="sellStock"> Sell stock</button>
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
                <input type="hidden" id="portfolio_id2" name="portfolio_id">



                <!-- Buttons -->
                <button type="button" id="addStockBtn">OK</button>
                <button type="button" id="cancelStockBtn">Cancel</button>
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
            <button type="submit" id="send">OK</button>
            <button type="button" id="cancelConfirmBtn">Cancel</button>
            </form>

        </div>
    </div>

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
        document.getElementById('sName').addEventListener('input', function () {
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
                
            </div>
@endsection

@push('scripts')
<script src="{{ asset('js/script.js') }}"></script>
@endpush
