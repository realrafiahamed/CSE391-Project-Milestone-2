<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: #f4f6f9;
        }

        /* NAV BAR */
        .navbar {
            background: #1f2937;
            padding: 15px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .navbar a {
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            background: #374151;
            transition: 0.2s;
            font-size: 14px;
        }

        .navbar a:hover {
            background: #2563eb;
        }

        .navbar .active {
            background: #2563eb;
        }

        /* CONTENT */
        .container {
            padding: 20px;
        }

        h2 {
            margin-bottom: 15px;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background: #2563eb;
            color: white;
        }

        tr:hover {
            background: #f1f5f9;
        }

        /* CARD STATS (optional simple touch) */
        .stats {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            flex: 1;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <a href="/admin/dashboard" class="active">Dashboard</a>
    <a href="/admin/buses">Buses</a>
    <a href="/admin/routes">Routes</a>
    <a href="/admin/schedules">Schedules</a>
    <a href="/admin/announcements">Announcements</a>
    <a href="/admin/logout" style="background:#ef4444;">Logout</a>
</div>

<!-- CONTENT -->
<div class="container">

    <h2>Today’s Bookings</h2>

    <!-- TABLE -->
    <table>
        <tr>
            <th>Seat</th>
            <th>From</th>
            <th>To</th>
            <th>Departure</th>
            <th>Arrival</th>
        </tr>

        @forelse($bookings as $b)
        <tr>
            <td>{{ $b->seat_number }}</td>
            <td>{{ $b->from_location }}</td>
            <td>{{ $b->to_location }}</td>
            <td>{{ $b->departure_time }}</td>
            <td>{{ $b->arrival_time }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No bookings today</td>
        </tr>
        @endforelse
    </table>

</div>

</body>
</html>