@extends('portfolio')

@section('title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endpush

@section('content')
    <h2>Dashboard</h2>
    <!-- Dashboard content goes here -->

            <!-- Dashboard Section -->
            <div id="dashboardSection2" class="content-section2">
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
            </div>
@endsection

@push('scripts')
<script src="{{ asset('js/script.js') }}"></script>
@endpush
