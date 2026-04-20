<!DOCTYPE html>
<html>
<head>
    <title>Buses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 p-6">
<div class="max-w-5xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Available Buses</h2>
    @forelse($schedules ?? [] as $schedule)
        <div class="bg-white shadow-lg rounded-2xl p-5 mb-4 border">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">
                        {{ $schedule->bus->bus_number }}
                    </h3>

                    <p class="text-gray-600">
                        {{ $schedule->display_from }} → {{ $schedule->display_to }}
                    </p>

                    <p class="text-sm text-gray-500 mt-1">
                        Seat: {{ $schedule->bus->seat_capacity }} |
                        Fare: {{ $schedule->route->fare }}
                    </p>

                    <p class="text-sm text-gray-500">
                        Date: {{ $schedule->travel_date }} |
                        Departure: {{ $schedule->departure_time }}
                    </p>
                </div>

                <div class="flex flex-col gap-2">

                    <a href="{{ route('seat.layout', [
                        'id' => $schedule->id,
                        'date' => $schedule->travel_date,
                        'from' => $from,
                        'to' => $to
                        ]) }}"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-center">
                            Book Seats
                    </a>

                    <a href="{{ route('dashboard') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-center">
                        Go Back
                    </a>
                </div>

            </div>
        </div>
    @empty
        <p class="text-gray-500">No buses found</p>
    @endforelse
</div>
</body>
</html>