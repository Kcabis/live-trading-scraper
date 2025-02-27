@extends('portfolio')

@section('title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dash.css') }}">
@endpush

@section('content')
<div class="portfolio-actions">
    <div>
        <button id="addShareholder" class="btn-primary">Add Portfolio</button>
        <button id="editShareholder" class="btn-secondary">Edit Portfolio</button>
    </div>
    <div class="welcome">
       <a href="{{route('settings')}}"> <button>Hey  {{auth()->user()->first_name ?? 'Guest'}}</button>
       </a>
    </div>

    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-danger">Logout</button>
    </form>
</div>

    
    <div class="table-container" style="text-align: center; margin: 0 auto; width: 80%; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <h3>Portfolios List</h3>
            <input type="text" id="searchInput" class="form-control" style="width: 250px;" placeholder="Search Portfolio..." />
        </div>

        <table class="table table-bordered table-striped" style="margin-top: 10px;">
            <thead class="table-dark">
                <tr>
                    <th>S.N</th>
                    <th>Portfolio-Name</th>
                    <th>Investment</th>
                    <th> Current units</th>
                    <th>Sold units</th>
                    <th>Realized_P/L</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="portfolioTable">
                @foreach($portfolioData as $portfolio)
                <tr>
                    <td>{{ $portfolio['id']}}</td>
                    <td>{{ $portfolio['name'] }}</td>
                    <td>{{$portfolio['investment']}}</td>
                    <td>{{$portfolio['total_stocks']}}</td>
                    <td>{{$portfolio['soldunits']}}</td>
                    <td>{{$portfolio['total_profit_loss']}}</td>

                    <td>
                        <a class="btn btn-primary btn-sm" href="/port?portfolio_id={{ $portfolio['id'] }}" style="margin-right: 10px; padding: 5px;">View</a>  
                        <form action="{{route('portfolio.delete', $portfolio['id'])}}" method="post" style="display: inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" id="deletePortfolioBtn" style="margin: 0px; padding: 5px;">Delete Portfolio</button>
                        </form>
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="addShareholderPopup" class="popup" style="display: none;">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Add New Portfolio</h2>
            <form id="addShareholderForm" action="{{ route('portfolio.store') }}" method="POST">
                @csrf
                <label for="shareholderName">Portfolio Name:</label>
                <input type="text" id="portfolio_name" name="portfolio_name" required>
                <button type="submit" id="addShareholderBtn">Add Portfolio</button>
                <button type="button" id="cancelShareholderBtn">Cancel</button>
            </form>
        </div>
    </div>

<div id="editPortfolioPopup" class="popup">
    <div class="popup-content">
        <input type="hidden" id="editPortfolioId">
        <span class="close">&times;</span>
        <h2>Edit Portfolio</h2>
        <form id="editPortfolioForm" action="/update-portfolio" method="POST">
            @csrf
            <label for="portfolioSelect">Select Portfolio:</label>
            <select name="portfolio_id" id="portfolioSelect" required>
                <option value="" disabled selected>-- Select a Portfolio --</option>
                @foreach($portfolios as $portfolio)
                    <option value="{{ $portfolio->id }}">{{ $portfolio->portfolio_name }}</option>
                @endforeach
            </select>
            
            <label for="editPortfolioName">New Portfolio Name:</label>
            <input type="text" id="editPortfolioName" name="portfolio_name" placeholder="Enter new portfolio name" required>
            
            <div style="display: flex; justify-content: space-between; margin-top: 20px;">
                <button type="submit" style="
                    padding: 10px 15px;
                    background-color: #007bff;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-weight: bold;
                ">Update Portfolio</button>
            </div>
        </form>
    </div>
</div>
<div class="table-container" style="text-align: center; margin: 0 auto; width: 80%; padding: 20px;">
    <table class="table table-bordered table-striped" style="margin-top: 10px;">
    </table>

    <div class="chart-container" style="margin-top: 40px; text-align: center;">
        <h3>Portfolio Value and Stock Count</h3>
        <canvas id="portfolioChart"></canvas>
    </div>
</div>


@endsection

@push('scripts')
<script src="{{ asset('js/port.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Get the search input and the portfolio table body
    const searchInput = document.getElementById('searchInput');
    const portfolioTable = document.getElementById('portfolioTable');

    // Add an event listener to the search input
    searchInput.addEventListener('keyup', function () {
        // Get the value from the search input and convert it to lowercase for case-insensitive comparison
        const searchValue = searchInput.value.toLowerCase();

        // Get all the rows in the portfolio table
        const rows = portfolioTable.getElementsByTagName('tr');

        // Loop through all the rows and filter them based on the portfolio name
        Array.from(rows).forEach(function (row) {
            const portfolioName = row.cells[1]?.textContent.toLowerCase() || '';

            // Check if the portfolio name starts with the search value
            if (portfolioName.startsWith(searchValue)) {
                // If the portfolio name matches the search input, display the row
                row.style.display = '';
            } else {
                // If the portfolio name doesn't match, hide the row
                row.style.display = 'none';
            }
        });
    });
});

    const portfolioData = @json($portfolioData); 

    const labels = portfolioData.map(portfolio => portfolio.name);
    const totalValues = portfolioData.map(portfolio => portfolio.total_value);
    const totalStocks = portfolioData.map(portfolio => portfolio.total_stocks);

    const ctx = document.getElementById('portfolioChart').getContext('2d');
    const portfolioChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Portfolio Value (Rs)',
                data: totalValues,
                backgroundColor: '#4e73df',
                borderColor: '#4e73df',
                borderWidth: 1
            },
            {
                label: 'Total Stocks',
                data: totalStocks,
                backgroundColor: '#1cc88a',
                borderColor: '#1cc88a',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
            },
        }
    });
</script>

@endpush
