<!DOCTYPE html>
<html>
<head>
    <title>My Tickets</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">My Tickets</h2>
    @forelse($bookings as $booking)
        <div class="bg-white p-5 rounded-xl shadow mb-4">

            <h3 class="font-bold text-lg">
                {{ $booking->schedule->bus->bus_number }}
            </h3>

            <p>
                {{ $booking->schedule->route->from_location }}
                →
                {{ $booking->schedule->route->to_location }}
            </p>

            <p>Seat: <b>{{ $booking->seat_number }}</b></p>

            <p>Date: {{ $booking->schedule->travel_date }}</p>

            <a href="{{ route('ticket.view', $booking->id) }}"
               class="inline-block mt-3 bg-green-500 text-white px-4 py-2 rounded">
                View Ticket
            </a>

        </div>

    @empty
        <p>No tickets found</p>
    @endforelse

</div>

</body>
</html>