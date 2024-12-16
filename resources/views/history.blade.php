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

        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Stock</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Purchase Price</th>
                        <th>Selling price</th>
                        <th>Profit amount</th>
                        <th>CGT</th>
                        <th>Amt Receivable</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
