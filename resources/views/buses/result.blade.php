<!DOCTYPE html>
<html>
<head>
    <title>Available Buses</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f4f0;
            padding: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 16px;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            padding: 16px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            color: #c0392b;
        }

        .route {
            margin-top: 6px;
            font-size: 14px;
            color: #333;
        }

        .tag {
            display: inline-block;
            margin-top: 6px;
            padding: 4px 8px;
            background: #f8e9e7;
            color: #96281b;
            font-size: 12px;
            border-radius: 5px;
        }

        .time {
            margin-top: 8px;
            font-size: 13px;
        }

        .btn {
            margin-top: 12px;
            display: flex;
            justify-content: space-between;
        }

        .btn button {
            padding: 8px 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .book {
            background: #c0392b;
            color: white;
        }

        .back {
            background: #ddd;
        }
    </style>
</head>
<body>

<h2>Available Buses</h2>

@if($schedules->isEmpty())
    <p>No buses found for selected route/time.</p>
@else
<div class="grid">

@foreach($schedules as $s)
    <div class="card">

        <div class="title">
            {{ $s->bus->bus_number ?? 'N/A' }}
        </div>

        <div class="route">
            {{ $s->route->from_location ?? '' }} → {{ $s->route->to_location ?? '' }}
        </div>

        <div class="tag">
            Seat: {{ $s->bus->seat_capacity }}
        </div>

        <div class="time">
            Date: {{ $s->travel_date }} <br>
            Departure: {{ $s->departure_time }} <br>
            Arrival: {{ $s->arrival_time }}
        </div>

        <div class="btn">
            <a href="{{ route('seat.layout', $s->id) }}">
                <button class="book">Book Seats</button>
            </a>
            <button class="back" onclick="history.back()">Go Back</button>
        </div>
    </div>
@endforeach
</div>
@endif

</body>
</html>