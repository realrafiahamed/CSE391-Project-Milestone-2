<h2>Ticket Confirmed 🎟</h2>

<p><b>Name:</b> {{ $booking->user->first_name }} {{ $booking->user->last_name }}</p>

<p><b>From:</b> {{ $booking->schedule->route->from_location }}</p>
<p><b>To:</b> {{ $booking->schedule->route->to_location }}</p>

<p><b>Date:</b> {{ $booking->schedule->travel_date }}</p>
<p><b>Time:</b> {{ $booking->schedule->departure_time }}</p>

<p><b>Seat:</b> {{ $booking->seat_number }}</p>

<br>

<a href="{{ url('/ticket/'.$booking->id) }}">
    View / Download Ticket
</a>