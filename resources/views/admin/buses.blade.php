<!DOCTYPE html>
<html>
<head>
    <title>Buses</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f4f6f9; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        th { background: #28a745; color: white; }
        input, button { padding: 8px; margin: 5px; }
    </style>
</head>
<body>

<h2>Buses</h2>

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

<form method="POST" action="/admin/buses">
    @csrf
    <input name="bus_number" placeholder="Bus Number" required>
    <input name="seat_capacity" placeholder="Seat Capacity" required>
    <button>Add Bus</button>
</form>

<hr>

<table>
    <tr>
        <th>ID</th>
        <th>Bus Name</th>
        <th>Seat Capacity</th>
    </tr>

    @foreach($buses as $b)
    <tr>
        <td>{{ $b->id }}</td>
        <td>{{ $b->bus_name }}</td>
        <td>{{ $b->seat_capacity }}</td>
    </tr>
    @endforeach
</table>

</body>
</html>