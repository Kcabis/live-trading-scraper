@extends('portfolio')

@section('title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endpush

@section('content')
    <h2>Dashboard</h2>
    <!-- Dashboard content goes here -->

            <!-- Dashboard Section -->
            <div id="dashboardSection" class="content">
                <div class="shareholder-options">
                   

                    <div style="
                        display: flex;
                        justify-content: start;
                        align-items: center;
                        margin-top: 20px;
                    ">
                     <select id="shareholderSelect">
                        <option value="" disabled selected>Select Portfolio</option>
                        @foreach($portfolios as $portfolio)
                            <option value="{{$portfolio->id}}"> {{$portfolio->portfolio_name}}</option>
                        @endforeach
                    </select>


                 

                        <form id="searchStockForm" action="/port" method="GET">
                            <input type="hidden" id="portfolio_id" name="portfolio_id">
                            <button type="submit" style="padding: 8px;
    font-size: 12px;
    margin-left: 10px; /* Space between buttons */
    cursor: pointer;
    background-color: #ccc; /* Blue background for buttons */
    color: black;
    border: none;
    border-radius: 8px;">Search</button>
                        </form>

                        <form id="clearStockForm" action="/portfolio" method="GET">
                            <button type="submit" style="padding: 8px;
    font-size: 12px;
    margin-left: 10px; /* Space between buttons */
    cursor: pointer;
    background-color: #ccc; /* Blue background for buttons */
    color: black;
    border: none;
    border-radius: 8px;">Clear</button>
                        </form>

                        <button id="addShareholder">Add Portfolio</button>
                        <button id="editShareholder">Edit Portfolio</button>

                    </div>




                </div>
          



                <div class="table-container" style="text-align: center; margin: 0 auto; width: 80%; padding: 20px;">
                    <!-- Search Box -->
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <h3>Portfolios List</h3>
                        <input type="text" id="searchInput" class="form-control" style="width: 250px;" placeholder="Search Portfolio..." />
                    </div>
                
                    <!-- Table -->
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
                            <!-- Example Rows -->
                            <tr>
                                <td>{{$portfolio->id}}</td>
                                <td>{{$portfolio->portfolio_name}}</td>
                                <td>$10,000</td>
                                <td>$8,000</td>
                                <td>$00</td>
                                <td>

                        <form id="searchStockForm" action="/port" method="GET">
                            <input type="hidden" id="portfolio_id" name="portfolio_id">
                            <button type="submit"> View</button>
                        </form>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <!-- Dynamic Rows Here -->
                        </tbody>
                        @endforeach
                    </table>
                </div>
                

    <!-- Add shareholder popup -->
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
            <label for="editPortfolioName">Choose a portfolio</label>

            <span class="close">&times;</span>
            <h2>Edit Portfolio</h2>
            <form id="editPortfolioForm">
                @foreach($portfolios as $portfolio)
                    <select name="portfolio" id="portfolio">
                        <option value="{{$portfolio->id}}">{{$portfolio->portfolio_name}}</option>
                    </select>
                @endforeach
                <input type="text" id="editPortfolioName" required>
                <button type="submit">Update portfolio</button>
                <button type="Delete">Delete Portfolio</button>
            </form>
        </div>
    </div>
                
            </div>
@endsection

@push('scripts')
<script src="{{ asset('js/script.js') }}"></script>
@endpush
