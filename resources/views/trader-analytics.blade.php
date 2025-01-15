@extends('portfolio')

@section('title', 'Trader Analytics')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/trader_analytics.css') }}">
@endpush

@section('content')
    <div class="analytics-container">
        <div class="header">
            <h1>Trader Analytics</h1>
        </div>

        <div class="charts-section">
            <!-- Profit of Individual Stocks -->
            <div class="chart-container">
                <h2>Profit of Individual Stocks</h2>
                <canvas id="profitChart"></canvas>
            </div>

            <!-- Portfolio Weight -->
            <div class="chart-container">
                <h2>Portfolio Weight of Individual Stocks (Market Value in %)</h2>
                <canvas id="portfolioWeightChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/trader_analytics.js') }}"></script>
@endpush
