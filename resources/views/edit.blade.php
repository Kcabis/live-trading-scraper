
@extends('portfolio')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endpush

@section('content')
<div class="container">
    <a href="{{ route('history') }}" class="btn-back">Back</a>
    <h2>Edit Transaction Details</h2>
    <form id="editTransactionForm" action="{{ route('transactions.update', $transaction->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="action">Action:</label>
            <select id="action" name="action" class="form-control" required>
                <option value="buy" {{ $transaction->action == 'buy' ? 'selected' : '' }}>Buy</option>
                <option value="sell" {{ $transaction->action == 'sell' ? 'selected' : '' }}>Sell</option>
            </select>
        </div>

        <div class="form-group">
            <label for="stockName">Stock Name:</label>
            <p class="form-control-static">{{ $transaction->stock_name }}</p>
            <input type="hidden" id="stockName" name="stockName" value="{{ $transaction->stock_name }}">
        </div>

        <div class="form-group">
            <label for="type">Type:</label>
            <select id="type" name="type" class="form-control" required>
                <option value="IPO" {{ $transaction->type == 'IPO' ? 'selected' : '' }}>IPO</option>
                <option value="Secondary" {{ $transaction->type == 'Secondary' ? 'selected' : '' }}>Secondary</option>
                <option value="Right" {{ $transaction->type == 'Right' ? 'selected' : '' }}>Right</option>
                <option value="Bonus" {{ $transaction->type == 'Bonus' ? 'selected' : '' }}>Bonus</option>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Transaction Price:</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ $transaction->price }}" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" class="form-control" value="{{ $transaction->quantity }}" required>
        </div>

        <!-- Hidden inputs for calculated fields -->
        <input type="hidden" name="totalAmount" id="confirmTotalAmount" value="{{ $transaction->total_amount }}">
        <input type="hidden" name="capitalGainTax" id="confirmCapitalGainTax" value="{{ $transaction->capital_gain_tax }}">
        <input type="hidden" name="netReceivable" id="confirmNetReceivable" value="{{ $transaction->net_receivable }}">
        <input type="hidden" name="profitLoss" id="confirmProfitLoss" value="{{ $transaction->profit_loss }}">
        <input type="hidden" name="wacc" id="confirmWacc" value="{{ $transaction->wacc }}">
        <input type="hidden" name="netPayable" id="confirmNetPayable" value="{{ $transaction->net_payable }}">

        <button type="button" id="updateButton" class="btn btn-success">Update Transaction</button>
        <button type="button" class="btn btn-cancel" onclick="window.history.back()">Cancel</button>
    </form>
</div>

<!-- Enhanced Confirmation Popup -->
<div id="confirmPopup" class="popup" style="display: none;">
    <div class="popup-content">
        <span class="close" id="closePopup">&times;</span>
        <h2>Confirm Transaction Details</h2>
        <p>Total Amount: Rs. <span id="confirmTotalAmountDisplay"></span></p>
        <p>Capital Gain Tax: Rs. <span id="confirmCapitalGainTaxDisplay"></span></p>
        <p>Net Receivable: Rs. <span id="confirmNetReceivableDisplay"></span></p>
        <p>Profit/Loss: Rs. <span id="confirmProfitLossDisplay"></span></p>
        <p>WACC: Rs. <span id="confirmWaccDisplay"></span></p>
        <p>Net Payable: Rs. <span id="confirmNetPayableDisplay"></span></p>

        <!-- Buttons -->
        <button type="button" id="send" class="btn btn-success">OK</button>
        <button type="button" id="cancelConfirmBtn" class="btn btn-danger">Cancel</button>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/edit.js') }}"></script>
@endpush
@endsection@extends('layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endpush

@section('content')
<div class="container">
    <a href="{{ route('history') }}" class="btn-back">Back</a>
    <h2>Edit Transaction Details</h2>
    <form id="editTransactionForm" action="{{ route('transactions.update', $transaction->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="action">Action:</label>
            <select id="action" name="action            <!-- filepath: /Applications/XAMPP/xamppfiles/htdocs/live-trading-scraper-1/resources/views/edit.blade.php -->
            @extends('layout')
            
            @push('styles')
                <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
            @endpush
            
            @section('content')
            <div class="container">
                <a href="{{ route('history') }}" class="btn-back">Back</a>
                <h2>Edit Transaction Details</h2>
                <form id="editTransactionForm" action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            
                    @csrf
                    @method('PUT')
            
                    <div class="form-group">
                        <label for="action">Action:</label>
                        <select id="action" name="action" class="form-control" required>
                            <option value="buy" {{ $transaction->action == 'buy' ? 'selected' : '' }}>Buy</option>
                            <option value="sell" {{ $transaction->action == 'sell' ? 'selected' : '' }}>Sell</option>
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="stockName">Stock Name:</label>
                        <p class="form-control-static">{{ $transaction->stock_name }}</p>
                        <input type="hidden" id="stockName" name="stockName" value="{{ $transaction->stock_name }}">
                    </div>
            
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <select id="type" name="type" class="form-control" required>
                            <option value="IPO" {{ $transaction->type == 'IPO' ? 'selected' : '' }}>IPO</option>
                            <option value="Secondary" {{ $transaction->type == 'Secondary' ? 'selected' : '' }}>Secondary</option>
                            <option value="Right" {{ $transaction->type == 'Right' ? 'selected' : '' }}>Right</option>
                            <option value="Bonus" {{ $transaction->type == 'Bonus' ? 'selected' : '' }}>Bonus</option>
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="price">Transaction Price:</label>
                        <input type="number" id="price" name="price" class="form-control" value="{{ $transaction->price }}" required>
                    </div>
            
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" value="{{ $transaction->quantity }}" required>
                    </div>
            
                    <!-- Hidden inputs for calculated fields -->
                    <input type="hidden" name="totalAmount" id="confirmTotalAmount" value="{{ $transaction->total_amount }}">
                    <input type="hidden" name="capitalGainTax" id="confirmCapitalGainTax" value="{{ $transaction->capital_gain_tax }}">
                    <input type="hidden" name="netReceivable" id="confirmNetReceivable" value="{{ $transaction->net_receivable }}">
                    <input type="hidden" name="profitLoss" id="confirmProfitLoss" value="{{ $transaction->profit_loss }}">
                    <input type="hidden" name="wacc" id="confirmWacc" value="{{ $transaction->wacc }}">
                    <input type="hidden" name="netPayable" id="confirmNetPayable" value="{{ $transaction->net_payable }}">
            
                    <button type="button" id="updateButton" class="btn btn-success">Update Transaction</button>
                    <button type="button" class="btn btn-cancel" onclick="window.history.back()">Cancel</button>
                </form>
            </div>
            
            <!-- Enhanced Confirmation Popup -->
            <div id="confirmPopup" class="popup" style="display: none;">
                <div class="popup-content">
                    <span class="close" id="closePopup">&times;</span>
                    <h2>Confirm Transaction Details</h2>
                    <p>Total Amount: Rs. <span id="confirmTotalAmountDisplay"></span></p>
                    <p>Capital Gain Tax: Rs. <span id="confirmCapitalGainTaxDisplay"></span></p>
                    <p>Net Receivable: Rs. <span id="confirmNetReceivableDisplay"></span></p>
                    <p>Profit/Loss: Rs. <span id="confirmProfitLossDisplay"></span></p>
                    <p>WACC: Rs. <span id="confirmWaccDisplay"></span></p>
                    <p>Net Payable: Rs. <span id="confirmNetPayableDisplay"></span></p>
            
                    <!-- Buttons -->
                    <button type="button" id="send" class="btn btn-success">OK</button>
                    <button type="button" id="cancelConfirmBtn" class="btn btn-danger">Cancel</button>
                </div>
            </div>
            
            @push('scripts')
                <script src="{{ asset('js/edit.js') }}"></script>
            @endpush
            @endsection" class="form-control" required>
                <option value="buy" {{ $transaction->action == 'buy' ? 'selected' : '' }}>Buy</option>
                <option value="sell" {{ $transaction->action == 'sell' ? 'selected' : '' }}>Sell</option>
            </select>
        </div>

        <div class="form-group">
            <label for="stockName">Stock Name:</label>
            <p class="form-control-static">{{ $transaction->stock_name }}</p>
            <input type="hidden" id="stockName" name="stockName" value="{{ $transaction->stock_name }}">
        </div>

        <div class="form-group">
            <label for="type">Type:</label>
            <select id="type" name="type" class="form-control" required>
                <option value="IPO" {{ $transaction->type == 'IPO' ? 'selected' : '' }}>IPO</option>
                <option value="Secondary" {{ $transaction->type == 'Secondary' ? 'selected' : '' }}>Secondary</option>
                <option value="Right" {{ $transaction->type == 'Right' ? 'selected' : '' }}>Right</option>
                <option value="Bonus" {{ $transaction->type == 'Bonus' ? 'selected' : '' }}>Bonus</option>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Transaction Price:</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ $transaction->price }}" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" class="form-control" value="{{ $transaction->quantity }}" required>
        </div>

        <!-- Hidden inputs for calculated fields -->
        <input type="hidden" name="totalAmount" id="confirmTotalAmount" value="{{ $transaction->total_amount }}">
        <input type="hidden" name="capitalGainTax" id="confirmCapitalGainTax" value="{{ $transaction->capital_gain_tax }}">
        <input type="hidden" name="netReceivable" id="confirmNetReceivable" value="{{ $transaction->net_receivable }}">
        <input type="hidden" name="profitLoss" id="confirmProfitLoss" value="{{ $transaction->profit_loss }}">
        <input type="hidden" name="wacc" id="confirmWacc" value="{{ $transaction->wacc }}">
        <input type="hidden" name="netPayable" id="confirmNetPayable" value="{{ $transaction->net_payable }}">

        <button type="button" id="updateButton" class="btn btn-success">Update Transaction</button>
        <button type="button" class="btn btn-cancel" onclick="window.history.back()">Cancel</button>
    </form>
</div>

<!-- Enhanced Confirmation Popup -->
<div id="confirmPopup" class="popup" style="display: none;">
    <div class="popup-content">
        <span class="close" id="closePopup">&times;</span>
        <h2>Confirm Transaction Details</h2>
        <p>Total Amount: Rs. <span id="confirmTotalAmountDisplay"></span></p>
        <p>Capital Gain Tax: Rs. <span id="confirmCapitalGainTaxDisplay"></span></p>
        <p>Net Receivable: Rs. <span id="confirmNetReceivableDisplay"></span></p>
        <p>Profit/Loss: Rs. <span id="confirmProfitLossDisplay"></span></p>
        <p>WACC: Rs. <span id="confirmWaccDisplay"></span></p>
        <p>Net Payable: Rs. <span id="confirmNetPayableDisplay"></span></p>

        <!-- Buttons -->
        <button type="button" id="send" class="btn btn-success">OK</button>
        <button type="button" id="cancelConfirmBtn" class="btn btn-danger">Cancel</button>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/edit.js') }}"></script>
@endpush
@endsection
