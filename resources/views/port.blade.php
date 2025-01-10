@extends('layout')
@section('title', 'Dashboard')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css\styles.css') }}">
    @endpush

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


                <div
                    style="
                        display: flex;
                        justify-content: start;
                        align-items: center;
                        margin-top: 20px;
                    ">

<select id="shareholderSelect">
                       

    <option value="" disabled selected>Select Portfolio</option>
    @foreach ($portfolios as $portfolio)
        <option value="{{ $portfolio->id }}"
            {{ $portfolio->id == request()->get('portfolio_id') ? 'selected' : '' }}
            >{{ $portfolio->portfolio_name }} </option>
    @endforeach
</select>


<script>
let queryPortfolioId = new URLSearchParams(window.location.search).get('portfolio_id');
if (queryPortfolioId) {
document.getElementById('portfolio_id').value = queryPortfolioId;
}
document.getElementById('shareholderSelect').addEventListener('change', function() {
window.location.href = '/port?portfolio_id=' + this.value;  
});

</script>




                    <form id="searchStockForm" action="/port" method="GET">
                        <input type="hidden" id="portfolio_id" name="portfolio_id">
                        <button type="submit"
                            style="padding: 8px;
    font-size: 12px;
    margin-left: 10px; /* Space between buttons */
    cursor: pointer;
    background-color: #ccc; /* Blue background for buttons */
    color: black;
    border: none;
    border-radius: 8px;">Search</button>
                    </form>

                    <form id="clearStockForm" action="/port" method="GET">
                        <button type="submit"
                            style="padding: 8px;
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
                                <td>{{ $stock['id'] }}</td>
                                <td>{{ $stock['stock_name'] }}</td>
                                <td>{{ $stock['wacc'] }}</td>
                                <td>{{ $stock['quantity'] }}</td>
                                <td>
                                    <script>
                                        var purchasePrice = {{ $stock['wacc'] }};
                                        var quantity = {{ $stock['quantity'] }};
                                        var purchaseValue = purchasePrice * quantity;
                                        document.write(purchaseValue);
                                    </script>
                                </td>
                                <td>{{ $stock['ltp'] }}</td>
                                <td>
                                    <script>
                                        var ltpRaw = '{{ $stock['ltp'] }}'.replace(/,/g, '');
                                        var ltp = parseFloat(ltpRaw);
                                        var marketValue = ltp * quantity;
                                        document.write('<p id="marketValue">' + marketValue + '</p>' +
                                            '<input type="hidden" id="marketValueRaw" value="' + marketValue + '">');
                                    </script>
                                </td>
                                <td>
                                    <script>
                                        var purchaseValue = {{ $stock['wacc'] }} * {{ $stock['quantity'] }};
                                        var ltpRaw = '{{ $stock['ltp'] }}'.replace(/,/g, '');
                                        var ltp = parseFloat(ltpRaw);
                                        var marketValue = ltp * {{ $stock['quantity'] }};

                                        var profitLoss = marketValue - purchaseValue;
                                        if (profitLoss > 0) {
                                            document.write( profitLoss.toFixed(2));
                                        } else if (profitLoss < 0) {
                                            document.write('-' + Math.abs(profitLoss).toFixed(2));
                                        } else {
                                            document.write('Rs. 0.00');
                                        }
                                    </script>
                                </td>
                                <td>
                                    <button class="editStockBtn">Edit</button>
                                    <button class="deleteStockBtn">Delete</button>
                                </td>
                            </tr>
                        @endforeach

                        <script>
                            // // calculate all market value sum and append to portfolioVal
                            // var marketValueSum = 0
                            // var marketValueElements = document.querySelectorAll('#marketValueRaw');
                            // marketValueElements.forEach(function (element) {
                            //     marketValueSum += parseFloat(element.value);

                            // });  
                            // document.getElementById('portfolioVal').textContent = 'Rs. ' + marketValueSum.toFixed(2);
                            // //for current investment
                            // var purchaseValueSum=0;
                            // var purchasePriceElements = document.querySelectorAll('td:nth-child(3)'); 
                            // var purchasePrice = parseFloat(purchasePriceElements[index].textContent.trim());
                            // purchaseValueSum += purchaseValue;
                            // document.getElementById('curentInvestment').textContent = 'Rs. ' + purchaseValue.toFixed(2); 


                            // Calculate Portfolio Value and Current Investment
                            // Calculate Portfolio Value and Current Investment
                            document.addEventListener('DOMContentLoaded', function() {
                                let marketValueSum = 0; // Total Market Value
                                let purchaseValueSum = 0; // Total Purchase Value
                                let profitvalueSum=0; 

                                const marketValueElements = document.querySelectorAll('#marketValueRaw');
                                const purchasePriceElements = document.querySelectorAll('td:nth-child(3)'); // Purchase Price column
                                const quantityElements = document.querySelectorAll('td:nth-child(4)'); // Quantity column
                                const profitElements = document.querySelectorAll('td:nth-child(8)');

                                // Calculate Market Value Sum
                                marketValueElements.forEach(function(element) {
                                    marketValueSum += parseFloat(element.value);
                                });

                                // Calculate Purchase Value Sum
                                purchasePriceElements.forEach(function(element, index) {
                                    const purchasePrice = parseFloat(element.textContent.trim()); // Get purchase price
                                    const quantity = parseFloat(quantityElements[index].textContent.trim()); // Get quantity
                                    purchaseValueSum += purchasePrice * quantity; // Add to purchase value sum
                                });
                                profitElements.forEach(function(element,index){
                                    const profit=parseFloat(element.textContent.trim());
                                    profitvalueSum+=profit;
                                });

                                // Update Portfolio Value and Current Investment
                                document.getElementById('portfolioVal').textContent = 'Rs. ' + marketValueSum.toFixed(2);
                                document.getElementById('currentInvestment').textContent = 'Rs. ' + purchaseValueSum.toFixed(2);
                                document.getElementById('dailyGains').textContent = 'Rs. ' + profitvalueSum.toFixed(2);
                            });
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
        </div>




        <!-- Add Stock Pop-Up Form -->
        <div id="addStockPopup" class="popup">
            <div class="popup-content">
                <span class="close">&times;</span>
                <h2>Add New Stock</h2>
                <form id="addStockForm" action="/add-stock" method="POST">
                    @csrf
                    <label for="select" id="select" class="ok">Action</label>
                    <select id="action" class="form-select" name="action">
                        <option value="buy">Buy</option>
                    </select>
                    <label for="stockName">Stock Name:</label>
                    <select id="stockName" name="stockName" required>
                        <option value="" disabled selected>Select Stock</option>
                        @foreach ($symbols as $symbol)
                            <option value="{{ $symbol }}">{{ $symbol }}</option>
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
                <h2>Sell Stock</h2>
                <form id="sellStockForm" action="/sell-stock" method="POST">
                    @csrf
                    <label for="actionSelect" class="ok">Action</label>
                    <select id="actionSelect" class="form-select" name="action">
                        <option value="sell">Sell</option>
                    </select>
        
                    <label for="stockSelect">Stock Name:</label>
                    <select id="stockSelect" name="stockName" required>
                        <option value="" disabled selected>Select Stock</option>
                        @foreach ($portfolioStocks as $portstock)
                            <option value="{{ $portstock->stock_name }}" 
                                data-wacc="{{ $portstock->wacc }}" 
                                data-purchaseprice="{{ $portstock->purchase_price }}">
                                {{ $portstock->stock_name }}
                            </option>
                        @endforeach
                    </select>
        
                    <label for="taxSelect" class="ok">Capital Gain Tax</label>
                    <select id="taxSelect" class="form-select" name="type">
                        <option value="5">5%</option>
                        <option value="7.5">7.5%</option>
                    </select> <br>
        
                    <label for="sellingPriceInput">Selling Price:</label>
                    <input type="number" id="sellingPriceInput" name="sellingPrice" step="0.01" required>
        
                    <label for="quantityInput">Quantity:</label>
                    <input type="number" id="quantityInput" name="quantity" required>
        
                    <!-- Calculated Fields -->
                    <p>Total Amount: Rs. <span id="totalAmountDisplay">0.00</span></p>
                    <p>SEBON Commission: Rs. <span id="sebonCommissionDisplay">0.00</span></p>
                    <p>Broker Commission: Rs. <span id="brokerCommissionDisplay">0.00</span></p>
                    <p>DP Fee: Rs. <span id="dpFeeDisplay">25.00</span></p>
                    <p>WACC: Rs. <span id="waccDisplay">0.00</span></p>
                    <p>Selling Price: Rs. <span id="sellingPriceDisplay">0.00</span></p>
                    <p>Total Cost: Rs. <span id="totalCostDisplay">0.00</span></p>
                    <p>CGT (Tax): Rs. <span id="taxDisplay">0.00</span></p>
                    <p>Profit/Loss: Rs. <span id="profitLossDisplay">0.00</span></p>
                    <p>Net Receivable: Rs. <span id="receivableDisplay">0.00</span></p>
        
                    <!-- Buttons -->
                    <button type="button" id="sellStockBtn">OK</button>
                    <button type="button" id="cancelSellStockBtn">Cancel</button>
                </form>
            </div>
        </div>
        
        <script>
            function calculateValues() {
                const sellingPrice = parseFloat(document.getElementById('sellingPriceInput').value) || 0;
                const quantity = parseFloat(document.getElementById('quantityInput').value) || 0;
                const taxRate = parseFloat(document.getElementById('taxSelect').value) / 100 || 0;
                const dpFee = 25; // Constant DP Fee
        
                // Fetch the selected stock's data
                const stockSelect = document.getElementById('stockSelect');
                const selectedStock = stockSelect.options[stockSelect.selectedIndex];
                const wacc = parseFloat(selectedStock.getAttribute('data-wacc')) || 0;
                const purchasePrice = parseFloat(selectedStock.getAttribute('data-purchaseprice')) || 0;
        
                if (sellingPrice <= 0 || quantity <= 0) {
                    return;
                }
        
                const totalAmount = sellingPrice * quantity; // Total amount from selling price and quantity
                const sebonCommission = totalAmount * 0.00015; // SEBON Commission
                const brokerCommission = calculateBrokerCommission(totalAmount); // Broker Commission
                const totalCost = wacc * quantity; // Total Cost
                const profitLoss = totalAmount - totalCost; // Profit or Loss
                const cgt = profitLoss > 0 ? profitLoss * taxRate : 0;

                const receivable = totalAmount - cgt - dpFee - sebonCommission - brokerCommission; // Net Receivable Amount

                
        
                // Displaying calculated values
                document.getElementById('totalAmountDisplay').textContent = totalAmount.toFixed(2);
                document.getElementById('sebonCommissionDisplay').textContent = sebonCommission.toFixed(2);
                document.getElementById('brokerCommissionDisplay').textContent = brokerCommission.toFixed(2);
                document.getElementById('dpFeeDisplay').textContent = dpFee.toFixed(2);
                document.getElementById('waccDisplay').textContent = wacc.toFixed(2);
                document.getElementById('sellingPriceDisplay').textContent = sellingPrice.toFixed(2);
                document.getElementById('totalCostDisplay').textContent = totalCost.toFixed(2);
                document.getElementById('taxDisplay').textContent = cgt.toFixed(2);
                document.getElementById('profitLossDisplay').textContent = profitLoss.toFixed(2);
                document.getElementById('receivableDisplay').textContent = receivable.toFixed(2);
            }
        
            // Attach event listeners to form inputs
            document.getElementById('sellingPriceInput').addEventListener('input', calculateValues);
            document.getElementById('quantityInput').addEventListener('input', calculateValues);
            document.getElementById('taxSelect').addEventListener('change', calculateValues);
            document.getElementById('stockSelect').addEventListener('change', calculateValues);


            function calculateBrokerCommission(totalAmount) {
        if (totalAmount <= 2500) {
            return 10;
        } else if (totalAmount <= 50000) {
            return totalAmount * 0.36 / 100;
        } else if (totalAmount <= 500000) {
            return totalAmount * 0.33 / 100;
        } else if (totalAmount <= 2000000) {
            return totalAmount * 0.31 / 100;
        } else {
            return totalAmount * 0.27 / 100;
        }
    }
        </script>
        
        
        
        

        <!-- Sell Confirmation Popup -->
        <div id="confirmSalePopup" class="popup">
            <div class="popup-content">
                <span class="close">&times;</span>
                <h2>Confirm Stock Details</h2>
                <p>Total Amount: Rs. <span id="confirmTotalAmountDisplay"></span></p>
                <p>SEBON Commission: Rs. <span id="confirmSebonCommissionDisplay"></span></p>
                <p>Broker Commission: Rs. <span id="confirmBrokerCommissionDisplay"></span></p>
                <p>DP Fee: Rs. <span id="confirmDpFeeDisplay"></span></p>
                <p>WACC: Rs. <span id="confirmWaccDisplay"></span></p>
                <p>Selling Price: Rs. <span id="confirmsellingpriceDisplay"></span></p>
                <p>Total Cost: Rs. <span id="confirmTotalCostDisplay"></span></p>
                <p>CGT: Rs. <span id="confirmtaxDisplay"></span></p>
                <p>Profit/Loss: Rs. <span id="P\LDisplay"></span></p>
                <p>Net Receivable: Rs. <span id="ReceivableDisplay"></span></p>
                <!-- Buttons -->
                <button type="submit" id="send">OK</button>
                <button type="button" id="cancelSellStockBtn">Cancel</button>
                </form>

            </div>
        </div>



        <!-- Add shareholder popup -->
        <div id="addShareholderPopup" class="popup">
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


        <!-- Edit Portfolio Modal -->
        <div id="editPortfolioPopup" class="popup">
            <div class="popup-content">
                <input type="hidden" id="editPortfolioId">
                <label for="editPortfolioName">Choose a portfolio</label>

                <span class="close">&times;</span>
                <h2>Edit Portfolio</h2>
                <form id="editPortfolioForm">
                    @foreach ($portfolios as $portfolio)
                        <select name="portfolio" id="portfolio">
                            <option value="{{ $portfolio->id }}">{{ $portfolio->portfolio_name }}</option>
                        </select>
                    @endforeach
                    <input type="text" id="editPortfolioName" required>
                    <button type="submit">Update portfolio</button>
                    <button type="Delete">Delete Portfolio</button>
                </form>
            </div>
        </div>
    @endsection
    <script src="{{ asset('js/script.js') }}"></script>
