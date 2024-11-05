<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scraped Data</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Add any CSS file if necessary -->
</head>
<body>
    <h1>Scraped Stock Data</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Symbol</th>
                <th>LTP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row['symbol'] }}</td>
                <td>{{ $row['ltp'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
