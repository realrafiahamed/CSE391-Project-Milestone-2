<!DOCTYPE html>
<html>
<head>
    <title>Schedules</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f4f6f9; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        th { background: #dc3545; color: white; }
        select, input, button { padding: 8px; margin: 5px; }
    </style>
</head>
<body>

<h2>Schedules</h2>

<style>
    .admin-nav {
        background: #1f2937;
        padding: 12px;
        display: flex;
        gap: 10px;
        align-items: center;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .admin-nav a {
        color: white;
        text-decoration: none;
        padding: 8px 12px;
        background: #374151;
        border-radius: 6px;
        transition: 0.2s;
        font-size: 14px;
    }

    .admin-nav a:hover {
        background: #2563eb;
        transform: translateY(-1px);
    }

    .admin-nav .logout {
        margin-left: auto;
        background: #ef4444;
    }

    .admin-nav .logout:hover {
        background: #dc2626;
    }
</style>

<div class="admin-nav">

    <a href="/admin/dashboard">Dashboard</a>
    <a href="/admin/buses">Buses</a>
    <a href="/admin/routes">Routes</a>
    <a href="/admin/schedules">Schedules</a>
    <a href="/admin/announcements">Announcement</a>
    <a href="/admin/logout" class="logout">Logout</a>

</div>

<br>

<form method="POST" action="/admin/schedules">
    @csrf

    <select name="bus_id" required>
        <option value="">Select Bus</option>
        @foreach($buses as $b)
            <option value="{{ $b->id }}">{{ $b->bus_number }}</option>
        @endforeach
    </select>

    <select name="route_id" required>
        <option value="">Select Route</option>
        @foreach($routes as $r)
            <option value="{{ $r->id }}">
                {{ $r->from_location }} → {{ $r->to_location }}
            </option>
        @endforeach
    </select>

    <input type="date" name="travel_date" required>
    <input type="time" name="departure_time" required>
    <input type="time" name="arrival_time" required>

    <button>Create Schedule</button>
</form>

<hr>

<table>
    <tr>
        <th>ID</th>
        <th>Bus</th>
        <th>Route</th>
        <th>Date</th>
        <th>Departure</th>
        <th>Arrival</th>
    </tr>

    @foreach($schedules as $s)
    <tr>
        <td>{{ $s->id }}</td>
        <td>{{ $s->bus->bus_name }}</td>
        <td>{{ $s->route->from_location }} → {{ $s->route->to_location }}</td>
        <td>{{ $s->travel_date }}</td>
        <td>{{ $s->departure_time }}</td>
        <td>{{ $s->arrival_time }}</td>
    </tr>
    @endforeach
</table>

</body>
</html>