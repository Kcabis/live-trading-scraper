@extends('layout')
@section('title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="header">
        <button onclick="window.location.href='{{ route('dashboard') }}'" class="btn btn-secondary">← Back</button>
        <h1>Account Statement</h1>
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
                    $amount = 0;
                    ?>
                    @foreach($transactions as $transaction)
                        <tr class="stock-row">
                            <td>{{$transaction->id}}</td>
                            <td>{{$transaction->stock_name}}</td>
                            <td>{{$transaction->action}}</td>
    
                            <td>
                                @if($transaction->action == 'buy')
                                    <?php
                                    $buyAmount = $transaction->total_cost;
                                    $sellAmount = 0; 
                                    $amount -= $buyAmount;
                                    ?>
                                    {{$buyAmount}} 
                                @elseif($transaction->action == 'sell')
                                    <?php
                                    $buyAmount = 0; 
                                    $sellAmount = $transaction->total_amount;
                                    $amount += $sellAmount; 
                                    ?>
                                    {{$buyAmount}}
                                @else
                                    <?php
                                    $buyAmount = 0;
                                    $sellAmount = 0;
                                    ?>
                                    0 
                                @endif
                            </td>
    
                            <td>
                                @if($transaction->action == 'sell')
                                    {{$sellAmount}} 
                                @else
                                    0
                                @endif
                            </td>
    
                            <td>
                                <span style="color: {{ $amount < 0 ? 'red' : 'green' }}">
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
        let input = document.getElementById("searchStockInput").value.toLowerCase();
        let rows = document.getElementById("stockTableBody").getElementsByClassName("stock-row");

        for (let i = 0; i < rows.length; i++) {
            let stockName = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase(); 

            if (stockName.indexOf(input) > -1) {
                rows[i].style.display = ""; 
            } else {
                rows[i].style.display = "none"; 
            }
        }
    }
</script>
@endpush
