@extends('layout')
@section('title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endpush
@section('content')
<div class="container">
    <div class="header">
        <h1>Account Statement</h1>
        <!-- Search box -->
        <input type="text" id="searchStockInput" class="form-control" placeholder="Search Stock by Name" onkeyup="searchStock()">
    </div>
    <div class="table-container">
        <table class="stock-table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Symbol</th>
                    <th>Action</th>
                    <th>Buy amount</th>
                    <th>Sell amount</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody id="stockTableBody">
                @if($transactions->isEmpty())
                    <tr>
                        <td colspan="6">No transactions available</td>
                    </tr>
                @else
                    <?php
                    $amount = 0; // Initialize amount to 0
                    ?>
                    @foreach($transactions as $transaction)
                        <tr class="stock-row">
                            <td>{{$transaction->id}}</td>
                            <td>{{$transaction->stock_name}}</td>
                            <td>{{$transaction->action}}</td>
    
                            <!-- Display Buy amount and set Sell amount to 0 if action is buy -->
                            <td>
                                @if($transaction->action == 'buy')
                                    <?php
                                    $buyAmount = $transaction->total_cost;
                                    $sellAmount = 0; // Set sell amount to 0 when action is buy
                                    $amount -= $buyAmount; // Subtract buy amount from total amount
                                    ?>
                                    {{$buyAmount}} <!-- Display Buy amount -->
                                @elseif($transaction->action == 'sell')
                                    <?php
                                    $buyAmount = 0; // Set buy amount to 0 when action is sell
                                    $sellAmount = $transaction->total_amount;
                                    $amount += $sellAmount; // Add sell amount to total amount
                                    ?>
                                    {{$buyAmount}} <!-- Display Buy amount as 0 for sell action -->
                                @else
                                    <?php
                                    $buyAmount = 0;
                                    $sellAmount = 0;
                                    ?>
                                    0 <!-- Default display when action is neither buy nor sell -->
                                @endif
                            </td>
    
                            <!-- Display Sell amount and set Buy amount to 0 if action is sell -->
                            <td>
                                @if($transaction->action == 'sell')
                                    {{$sellAmount}} <!-- Display Sell amount -->
                                @else
                                    0 <!-- Display Sell amount as 0 when action is buy -->
                                @endif
                            </td>
    
                            <!-- Display Amount with color coding for negative values -->
                            <td>
                                <span style="color: {{ $amount < 0 ? 'red' : 'white' }}">
                                    {{ number_format($amount, 2) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>  
</div>
@endsection

@push('scripts')
<script>
    function searchStock() {
    // Get the value of the search input
    let input = document.getElementById("searchStockInput").value.toLowerCase();

    // Get all rows from the table body
    let rows = document.getElementById("stockTableBody").getElementsByClassName("stock-row");

    // Loop through the rows to hide those that don't match the search query
    for (let i = 0; i < rows.length; i++) {
        let stockName = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase(); // Get the stock name from the second column (index 1)

        if (stockName.indexOf(input) > -1) {
            rows[i].style.display = ""; // Show row if search term matches
        } else {
            rows[i].style.display = "none"; // Hide row if search term doesn't match
        }
    }
}
</script>
@endpush
