<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <style>
        /* Global Styles */
        :root {
            --text-dark: #333;
            --secondary-color: #007bff;
            --accent-color: #28a745;
            --text-light: #fff;
            --transition-time: 0.3s;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .popup-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .popup-content h2 {
            font-size: 20px;
            color: var(--text-dark);
            margin-bottom: 20px;
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            text-align: center;
        }

        .popup-content form input,
        .popup-content form select {
            padding: 12px;
            margin-bottom: 20px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid var(--secondary-color);
        }

        .popup-content form input:focus,
        .popup-content form select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 5px var(--accent-color);
        }

        .popup-content button {
            padding: 12px;
            border: none;
            background: var(--secondary-color);
            color: var(--text-light);
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            transition: background var(--transition-time);
            margin-right: 10px; /* Spacing between buttons */
        }

        .popup-content button:hover {
            background: var(--accent-color);
        }

        .cancel-button {
            background: #ccc; /* Gray color for cancel */
        }

        .cancel-button:hover {
            background: #aaa; /* Darker gray on hover */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .popup-content {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="popup-content">
        <h2>Edit Event</h2>
        <form action="{{ route('event.update', $event->id) }}" method="post">
            @csrf
            @method('POST') <!-- Ensure that the request method is POST for updating -->

            <div>
                <label for="event_name">Event Name</label>
                <input type="text" id="event_name" name="event_name" value="{{ old('event_name', $event->event_name) }}" required>
            </div>

            <div>
                <label for="stock_name">Stock Name</label>
                <input type="text" id="stock_name" name="stock_name" value="{{ old('stock_name', $event->stock_name) }}" required>
            </div>

            <div>
                <label for="event_type">Event Type</label>
                <input type="text" id="event_type" name="event_type" value="{{ old('event_type', $event->event_type) }}" required>
            </div>

            <div>
                <label for="price">Price</label>
                <input type="number" id="price" name="price" value="{{ old('price', $event->price) }}" required>
            </div>

            <div>
                <label for="event_date">Event Date</label>
                <input type="date" id="event_date" name="event_date" value="{{ old('event_date', $event->event_date) }}" required>
            </div>

            <div>
                <button type="submit">Update Event</button>
                <a href="{{ route('admin') }}">
                    <button type="button" class="cancel-button">Cancel</button>
                </a>
            </div>
        </form>
    </div>
</body>
</html>
