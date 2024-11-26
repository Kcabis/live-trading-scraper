<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scraped Data</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Add any CSS file if necessary -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .table-container {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            overflow-x: auto;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
        }

        .search-bar {
            width: 100%;
            max-width: 300px;
            margin: 15px auto;
            display: flex;
            justify-content: center;
        }

        .search-bar input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        thead {
            background-color: #007bff;
            color: #fff;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        @media (max-width: 600px) {
            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px 10px;
            }
        }
    </style>
</head>
<body>
    <h1>Scraped Stock Data</h1>

    <div class="search-bar">
        <input type="text" id="search" placeholder="Search by Symbol...">
    </div>

    <div class="table-container">
        <table id="stockTable">
            <thead>
                <tr>
                    <th>Symbol</th>
                    <th>LTP</th>
                    <th>%Change</th>
                    <th>Open</th>
                    <th>High</th>
                    <th>Low</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                <tr>
                    <td>{{ $row['symbol'] }}</td>
                    <td>{{ $row['ltp'] }}</td>
                    <td>{{ $row['change'] }}</td>
                    <td>{{ $row['open'] }}</td>
                    <td>{{ $row['high'] }}</td>
                    <td>{{ $row['low'] }}</td>
                    <td>{{ $row['qty'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        const searchInput = document.getElementById('search');
        const table = document.getElementById('stockTable');
        const rows = table.getElementsByTagName('tr');

        searchInput.addEventListener('keyup', function () {
            const filter = searchInput.value.toUpperCase();
            for (let i = 1; i < rows.length; i++) {
                const cell = rows[i].getElementsByTagName('td')[0];
                if (cell) {
                    const text = cell.textContent || cell.innerText;
                    rows[i].style.display = text.toUpperCase().includes(filter) ? '' : 'none';
                }
            }
        });
    </script>
</body>
</html>
