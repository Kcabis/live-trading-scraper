@extends('layout')

@section('title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dash.css') }}">
@endpush

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <!-- Add/Edit Buttons -->
        <div>
            <button id="addShareholder" style="
                padding: 8px 12px;
                font-size: 14px;
                cursor: pointer;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 8px;
                margin-right: 10px;
            ">Add Portfolio</button>
            <button id="editShareholder" style="
                padding: 8px 12px;
                font-size: 14px;
                cursor: pointer;
                background-color: #6c757d;
                color: white;
                border: none;
                border-radius: 8px;
            ">Edit Portfolio</button>
        </div>

        <!-- Logout Button -->
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" style="
                padding: 8px 12px;
                font-size: 14px;
                cursor: pointer;
                background-color: #d9534f;
                color: white;
                border: none;
                border-radius: 8px;
                font-weight: bold;
            ">Logout</button>
        </form>
    </div>
    
    <!-- Table Section -->
    <div class="table-container" style="text-align: center; margin: 0 auto; width: 80%; padding: 20px;">
        <!-- Search and Table Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <h3>Portfolios List</h3>
            <input type="text" id="searchInput" class="form-control" style="width: 250px;" placeholder="Search Portfolio..." />
        </div>

        <!-- Portfolio Table -->
        <table class="table table-bordered table-striped" style="margin-top: 10px;">
            <thead class="table-dark">
                <tr>
                    <th>S.N</th>
                    <th>Portfolio-Name</th>
                    <th>Market Value</th>
                    <th>Investment</th>
                    <th>Profit/Loss</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="portfolioTable">
                @foreach($portfolios as $portfolio)
                <tr>
                    <td>{{ $portfolio->id }}</td>
                    <td>{{ $portfolio->portfolio_name }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/port?portfolio_id={{ $portfolio->id }}">View</a>
                        <form action="{{route('portfolio.delete',$portfolio->id)}}" method="post">
                            @csrf
                            @method('delete')
                        <button type="submit" id="deletePortfolioBtn">Delete Portfolio</button>
                        </form>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Portfolio Popup -->
    <div id="addShareholderPopup" class="popup" style="display: none;">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Add New Portfolio</h2>
            <form id="addShareholderForm" action="/add-ph" method="POST">
                @csrf
                <label for="shareholderName">Portfolio Name:</label>
                <input type="text" id="shareholderName" name="portfolio_name" required>
                <button type="submit" id="addShareholderBtn">Add Portfolio</button>
                <button type="button" id="cancelShareholderBtn">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Edit Portfolio Modal -->
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

@endsection

@push('scripts')
<script src="{{ asset('js/port.js') }}"></script>
@endpush
