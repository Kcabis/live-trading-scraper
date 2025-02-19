@extends('portfolio')

@section('title', 'Trader Analytics')

@section('content')
    <div class="analytics-container">
        <div class="header">
            <h1>Trader Analytics</h1>
        </div>

        <div class="charts-section">
            <!-- Profit of Individual Stocks -->
            <div class="chart-container">
                <h2>Purchase value of Individual Stocks</h2>
                <canvas id="profitChart"></canvas>
            </div>

            <!-- Portfolio Weight -->
            <div class="chart-container">
                <h2>Portfolio Weight of Individual Stocks (Market Value in %)</h2>
                <canvas id="portfolioWeightChart"></canvas>
            </div>
        </div>

        <!-- Trader Analytics Table -->
        <div class="table-section">
            <h2>Trader Performance Overview</h2>
            <table class="analytics-table">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Portfolio</th>
                        <th>Winning Trades</th>
                        <th>Losing Trades</th>
                        <th>ROI</th>
                        <th>Avg Profit</th>
                        <th>Avg Loss</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($portfolioData as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data['portfolio_name'] }}</td>
                            <td>{{ $data['winning_trades'] }}</td>
                            <td>{{ $data['losing_trades'] }}</td>
                            <td>{{ $data['roi'] }}%</td>
                            <td>{{ $data['avg_profit'] }}</td>
                            <td>{{ $data['avg_loss'] }}</td>
                            <td>{{$data['status']}}</td>
                        </tr>
                    @endforeach
                </tbody>
                
                
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/trader_analytics.js') }}"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/trader_analytics.css') }}">
@endpush
