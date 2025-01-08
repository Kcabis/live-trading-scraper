@extends('portfolio')

@section('title', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endpush

@section('content')
    <h2>Settings</h2>
    <!-- Dashboard content goes here -->

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <label for="showEntries">Show
                    <select id="showEntries" class="form-select form-select-sm"
                        style="width: auto; display: inline-block;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select> entries
                </label>
            </div>
            <!-- <div class="col-md-6 text-end">
            <input type="text" id="searchBox" class="form-control form-control-sm" placeholder="Search">
        </div> -->
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

                            <a class="btn btn-primary btn-sm" href="/port?portfolio_id={{$portfolio->id}}">View</a>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    <!-- Dynamic Rows Here -->
                </tbody>
                @endforeach
            </table>
        </div>

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
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                    <tr>
                        <td>{{$stock->action}}</td>
                        <td>{{$stock->stock_name}}</td>
                        <td>{{$stock->type}}</td>
                        <td>{{$stock->quantity}}</td>
                        <td>{{$stock->wacc}}</td>
                        <td>{{$stock->total_cost}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
