<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <title>Document</title>
</head>
<body>
    


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
            @dd($stocks)
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
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>