@extends('layout')

@section('title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/listed.css') }}">
@endpush

@section('content')
    <h2>Dashboard</h2>
    <!-- Dashboard content goes here -->
    <div id="listedsecuritiesSection" class="content-section listed-section" style="display: none;">
        <h2>Listed Securities</h2>

        <!-- Header Section -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div class="Live">
                <button type="button" onclick="window.location.href='{{ route('scrape') }}'">Live
                    Market</button>
            </div>
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search by Symbol..." />
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <table id="securitiesTable">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Date</th>
                        <th>Security ID</th>
                        <th>
                            <span id="symbolHeader">Symbol</span>
                            <button class="sort-button" onclick="sortTable()">Sort</button>
                            <button class="sort-button" onclick="resetTable()">Reset</button>
                        </th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($securities as $security)
                        <tr>
                            <td>{{ $security->stock_id }}</td>
                            <td>{{ $security->Date }}</td>
                            <td>{{ $security->S_ID }}</td>
                            <td>{{ $security->symbol }}</td>
                            <td>{{$security->Name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript for Search and Sort -->
    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function () {
            const searchValue = this.value.toUpperCase();
            const table = document.getElementById('securitiesTable');
            const rows = table.getElementsByTagName('tr');
            for (let i = 1; i < rows.length; i++) {
                const symbolCell = rows[i].getElementsByTagName('td')[3]; // Corrected index for Symbol column
                if (symbolCell) {
                    const textValue = symbolCell.textContent || symbolCell.innerText;
                    rows[i].style.display = textValue.toUpperCase().includes(searchValue) ? '' : 'none';
                }
            }
        });

        let originalRows = [];

        // Save the original rows when the page loads
        window.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('securitiesTable');
            const rows = Array.from(table.rows).slice(1); // Skip header
            originalRows = rows.map(row => row.cloneNode(true)); // Clone the original rows
        });

        // Sort functionality
        function sortTable() {
            const table = document.getElementById('securitiesTable');
            const rows = Array.from(table.rows).slice(1); // Skip header row
            const sortedRows = rows.sort((a, b) => {
                const symbolA = a.cells[3].textContent.trim().toUpperCase();
                const symbolB = b.cells[3].textContent.trim().toUpperCase();
                return symbolA.localeCompare(symbolB);
            });
            const tbody = table.querySelector('tbody');
            tbody.innerHTML = ''; // Clear the table
            sortedRows.forEach(row => tbody.appendChild(row)); // Append sorted rows
        }

        // Reset functionality
        function resetTable() {
            const table = document.getElementById('securitiesTable');
            const tbody = table.querySelector('tbody');
            tbody.innerHTML = ''; // Clear the table
            originalRows.forEach(row => tbody.appendChild(row.cloneNode(true))); // Restore original rows
        }

    </script>


@endsection

@push('scripts')
<script src="{{ asset('js/script.js') }}"></script>
@endpush
