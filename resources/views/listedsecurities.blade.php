@extends('portfolio')
@section('title','Dashboard')
@push('styles')
<link rel="stylesheet" href="{{asset('css/listed.css')}}">
@endpush
@section('content')
<div id="listedsecuritiesSection" class="content-section listed-section">
    <h2>Listed Securities</h2>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div class="Live">
            <button type="button" onclick="window.location.href='{{ route('scrape') }}'">Live
                Market</button>
        </div>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search by Symbol..." />
        </div>
    </div>

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

<script>
    document.getElementById('searchInput').addEventListener('input', function () {
        const searchValue = this.value.toUpperCase();
        const table = document.getElementById('securitiesTable');
        const rows = table.getElementsByTagName('tr');
        for (let i = 1; i < rows.length; i++) {
            const symbolCell = rows[i].getElementsByTagName('td')[3]; 
            if (symbolCell) {
                const textValue = symbolCell.textContent || symbolCell.innerText;
                rows[i].style.display = textValue.toUpperCase().includes(searchValue) ? '' : 'none';
            }
        }
    });

    let originalRows = [];

    window.addEventListener('DOMContentLoaded', function () {
        const table = document.getElementById('securitiesTable');
        const rows = Array.from(table.rows).slice(1);
        originalRows = rows.map(row => row.cloneNode(true)); /
    });

    function sortTable() {
        const table = document.getElementById('securitiesTable');
        const rows = Array.from(table.rows).slice(1); 
        const sortedRows = rows.sort((a, b) => {
            const symbolA = a.cells[3].textContent.trim().toUpperCase();
            const symbolB = b.cells[3].textContent.trim().toUpperCase();
            return symbolA.localeCompare(symbolB);
        });
        const tbody = table.querySelector('tbody');
        tbody.innerHTML = ''; 
        sortedRows.forEach(row => tbody.appendChild(row)); 
    }

    function resetTable() {
        const table = document.getElementById('securitiesTable');
        const tbody = table.querySelector('tbody');
        tbody.innerHTML = ''; 
        originalRows.forEach(row => tbody.appendChild(row.cloneNode(true))); 
    }

</script>
    @endsection

    @push('script')
    <link rel="stylesheet" href="{{asset('js/script.js')}}">      
    @endpush
