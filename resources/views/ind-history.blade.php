@extends('portfolio')

@section('title', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/ind-history.css') }}">
@endpush

@section('content')
    <h2>History</h2>
    <div class="Live">
        <button type="button" onclick="window.location.href='{{ route('history') }}'">Back</button>
    </div>

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
                        <th>Purchase Amount</th>
                        <th>Selling Price</th>
                        <th>Selling Amount</th>
                        <th>CGT</th>
                        <th>Amt Receivable</th>
                        <th>Profit/Loss</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->action }}</td>
                            <td>{{ $transaction->stock_name }}</td>
                            <td>{{ $transaction->type }}</td>
                            <td>{{ $transaction->quantity }}</td>
                            <td>{{ $transaction->wacc}}</td>
                            <td>{{ $transaction->total_amount }}</td>

                            @if ($transaction->action == 'buy')
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            @else
                                <td>{{ $transaction->price }}</td>
                                <td>{{ $transaction->total_amount }}</td>
                                <td>{{ $transaction->cgt }}</td>
                                <td>{{ $transaction->net_receivable }}</td>
                                <td>{{ $transaction->profit_loss }}</td>
                            @endif

                            <td>
                                <button id="editTransactionBtn">
                                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                </button>
                                <form action="{{ route('transactions.delete', $transaction->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" id="deleteTransactionBtn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
