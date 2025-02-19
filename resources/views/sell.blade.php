@extends('layout')

@section('title', 'Sell Stock')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endpush

@section('content')
    <div class="container">
        <h2>Sell Stock</h2>
        <form id="sellStockForm" action="{{ route('sell.stock') }}" method="POST">
            @csrf
            <label for="action">Action:</label>
            <select id="actionn" name="action">
                <option value="sell">Sell</option>
            </select>

            <label for="stockName">Stock Name:</label>
            <input type="text" id="stockName" name="stockName" value="{{ $stock->stock_name }}" readonly>

            <label for="type">Capital Gain Tax:</label>
            <select id="type" name="type" required>
                <option value="5">5%</option>
                <option value="7.5">7.5%</option>
            </select>


            <label for="sellingPrice">Selling Price:</label>
            <input type="number" id="sellingPrice" name="sellingPrice" step="0.01" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" max="{{ $stock->quantity }}" required>

            <!-- Hidden Fields -->
            <input type="hidden" id="hiddenType" name="type" value="">
            <input type="hidden" id="wacc" name="wacc" value="{{ $stock->wacc }}">
            <input type="hidden" id="portfolio_id" name="portfolio_id" value="{{ $stock->portfolio_id }}">
            <input type="hidden" id="availableQuantity" value="{{ $stock->quantity }}">
            <input type="hidden" id="hiddenSebonCommission" name="sebonCommission">
            <input type="hidden" id="hiddenBrokerCommission" name="brokerCommission">
            <input type="hidden" id="hiddenDpFee" name="dpFee">

            <button type="button" id="sellStockBtn" class="btn btn-primary">Sell</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <div id="confirmPopup" class="popup" style="display: none;">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Confirm Stock Details</h2>
            <p>Total Amount: Rs. <span id="confirmTotalAmountDisplay"></span></p>
            <p>SEBON Commission: Rs. <span id="confirmSebonCommissionDisplay"></span></p>
            <p>Broker Commission: Rs. <span id="confirmBrokerCommissionDisplay"></span></p>
            <p>DP Fee: Rs. <span id="confirmDpFeeDisplay"></span></p>
            <p>WACC: Rs. <span id="confirmWaccDisplay"></span></p>
            <p>Selling Price: Rs. <span id="confirmsellingpriceDisplay"></span></p>
            <p>CGT: Rs. <span id="confirmtaxDisplay"></span></p>
            <p>Net Receivable: Rs. <span id="ReceivableDisplay"></span></p>
            <p>Profit/Loss: <span id="PLDisplay" style="font-weight: bold;"></span></p>

            <!-- Buttons -->
            <button type="button" id="send" class="btn btn-primary">OK</button>
            <button type="button" id="cancelSellStockBtn" class="btn btn-secondary">Cancel</button>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/sell.js') }}"></script>
@endpush
