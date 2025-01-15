@extends('portfolio')

@section('title', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/ind-history.css') }}">
@endpush

@section('content')
    <h2>History</h2>

    <div class="container">
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Stock</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Purchase Price</th>
                        <th>Purchase amount</th>
                        <th>Selling price</th>
                        <th>Selling amount</th>
                        <th>CGT</th>
                        <th>Amt Receivable</th>
                        <th>Profit/Loss</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $stock)
                        <tr>
                            <td>{{ $stock->action }}</td>
                            <td>{{ $stock->stock_name }}</td>
                            <td>{{ $stock->type }}</td>
                            <td>{{ $stock->quantity }}</td>
                            <td>{{ $stock->wacc }}</td>
                            <td>{{ $stock->total_cost }}</td>

                            @if ($stock->action == 'buy')
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            @else
                                <td>{{ $stock->selling_price }}</td>
                                <td>{{ $stock->selling_amount }}</td>
                                <td>{{ $stock->cgt }}</td>
                                <td>{{ $stock->amt_receivable }}</td>
                                <td>{{ $stock->profit_loss }}</td>
                            @endif

                            <td>
                                <!-- Edit Button -->
                                <button type="button" class="btn btn-primary btn-sm edit-btn" id="editBtn"
                                    data-stock-id="{{ $stock->id }}" data-action="{{ $stock->action }}"
                                    data-stock-name="{{ $stock->stock_name }}" data-type="{{ $stock->type }}"
                                    data-quantity="{{ $stock->quantity }}" data-purchase-price="{{ $stock->wacc }}"
                                    data-total-cost="{{ $stock->total_cost }}" data-toggle="modal"
                                    data-target="#addStockPopup">
                                    Edit
                                </button>
                                <form action="{{ route('stock.delete', $stock->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" id="deleteStockBtn">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Stock Pop-Up Form (this is your existing popup form) -->
    <div id="addStockPopup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Edit Stock</h2>
            <form id="addStockForm" action="/update-stock" method="POST">
                @csrf
                @method('PUT') <!-- This is for updating stock -->
                <label for="select">Action</label>
                <select id="action" class="form-select" name="action">
                    <option value="buy">Buy</option>
                    <option value="sell">Sell</option>
                </select>

                <label for="stockName">Stock Name:</label>
                <select id="stockName" name="stockName" required>
                    <option value="" disabled>Select Stock</option>
                    @foreach ($stocks as $stock)
                        <option value="{{ $stock->stock_name }}">{{ $stock->stock_name }}</option>
                    @endforeach
                </select>


                <label for="type">Type</label>
                <select id="sel" class="form-select" name="type">
                    <option value="IPO">IPO</option>
                    <option value="Secondary">Secondary</option>
                    <option value="Right">Right</option>
                    <option value="Bonus">Bonus</option>
                </select>

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
                <button type="submit" id="saveStockBtn">Save</button>
                <button type="button" id="cancelStockBtn">Cancel</button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        // JavaScript to populate modal with stock data when "Edit" button is clicked
        document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
        const stockId = this.getAttribute('data-stock-id');
        const stockName = this.getAttribute('data-stock-name');
        const action = this.getAttribute('data-action');
        const type = this.getAttribute('data-type');
        const quantity = this.getAttribute('data-quantity');
        const purchasePrice = this.getAttribute('data-purchase-price');
        const totalCost = this.getAttribute('data-total-cost');

        // Set form action URL to update the stock
        const form = document.getElementById('addStockForm');
        form.action = `/update-stock/${stockId}`; // The URL will include the stock ID for editing

        // Pre-fill the fields in the form
        document.getElementById('action').value = action;
        document.getElementById('stockName').value = stockName;
        document.getElementById('sel').value = type;
        document.getElementById('quantity').value = quantity;
        document.getElementById('purchasePrice').value = purchasePrice;
        document.getElementById('confirmTotalCost').value = totalCost;

        // Show the popup
        document.getElementById('addStockPopup').style.display = 'block';
    });
});

        // Close the popup when clicking on the close button (x)
        document.querySelector('.close').addEventListener('click', function() {
            document.getElementById('addStockPopup').style.display = 'none';
        });

        // Close the popup when clicking on Cancel button
        document.getElementById('cancelStockBtn').addEventListener('click', function() {
            document.getElementById('addStockPopup').style.display = 'none';
        });
    </script>
@endpush
