<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>Seat Layout - {{ $schedule->bus->bus_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <style>
        .seat {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.95rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .seat.available {
            background: #f8fafc;
            border: 2px solid #64748b;
            color: #334155;
        }
        
        .seat.available:hover {
            background: #e0f2fe;
            border-color: #0ea5e9;
            transform: scale(1.08);
        }
        
        .seat.selected {
            background: linear-gradient(135deg, #22c55e, #4ade80);
            border: 2px solid #16a34a;
            color: white;
            transform: scale(1.1);
        }
        
        .seat.booked {
            background: #1f2937;
            color: #9ca3af;
            cursor: not-allowed;
            border: 2px solid #374151;
        }
        
        .bus-container {
            background: linear-gradient(145deg, #f8fafc, #e2e8f0);
            padding: 32px 40px;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            max-width: 420px;   /* Reduced width */
            margin: 0 auto;
        }
        
        .legend-dot {
            width: 16px;
            height: 16px;
            border-radius: 6px;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen py-8">

<div class="max-w-5xl mx-auto px-6">
    <div class="flex flex-col lg:flex-row gap-10 items-start justify-center">
        
        <!-- Bus Seat Layout -->
        <div>
            <div class="bus-container">
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-bus text-3xl text-sky-600"></i>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Select Seat</h1>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">Driver Side</div>
                        <div class="w-12 h-1.5 bg-gradient-to-r from-amber-400 to-orange-500 rounded-full mt-1"></div>
                    </div>
                </div>

                <!-- Seats -->
                <div class="grid grid-cols-5 gap-2.5 max-w-[340px] mx-auto">
                    @php $rows = range('A','J'); @endphp
                    @foreach($rows as $row)
                        @for($i=1; $i<=4; $i++)
                            @php 
                                $seat = $row . $i; 
                                $isBooked = in_array($seat, $bookedSeats); 
                            @endphp
                            
                            @if($i == 3)
                                <div class="w-8"></div> <!-- Aisle gap -->
                            @endif
                            
                            <button 
                                class="seat {{ $isBooked ? 'booked' : 'available' }}"
                                {{ $isBooked ? 'disabled' : '' }}
                                data-seat="{{ $seat }}">
                                {{ $seat }}
                            </button>
                        @endfor
                    @endforeach
                </div>
            </div>

            <!-- Legend -->
            <div class="flex justify-center gap-6 mt-6 text-sm">
                <div class="flex items-center gap-2">
                    <div class="legend-dot bg-slate-200 border-2 border-slate-600"></div>
                    <span class="text-gray-600">Available</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="legend-dot bg-gradient-to-br from-green-400 to-emerald-500"></div>
                    <span class="text-gray-600">Selected</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="legend-dot bg-gray-800"></div>
                    <span class="text-gray-600">Booked</span>
                </div>
            </div>
        </div>

        <!-- Trip Information -->
        <div class="w-full max-w-xs lg:max-w-sm pt-4">
            <div class="bg-white rounded-3xl shadow-xl p-7">
                <h2 class="text-xl font-bold text-gray-800 mb-5">Trip Information</h2>
                
                <div class="space-y-5 text-sm">
                    <div>
                        <p class="text-gray-500">Bus Number</p>
                        <p class="font-semibold text-lg">{{ $schedule->bus->bus_number }}</p>
                    </div>
                    
                    <div>
                        <p class="text-gray-500">Route</p>
                        <p class="font-medium text-base">{{ $from }} → {{ $to }}</p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-500">Date</p>
                            <p class="font-semibold">{{ $schedule->travel_date }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Departure Time</p>
                            <p class="font-semibold">{{ $schedule->departure_time }}</p>
                        </div>
                    </div>
                </div>

                <input type="hidden" id="schedule_id" value="{{ $schedule->id }}">
                <input type="hidden" id="travel_date" value="{{ $schedule->travel_date }}">

                <div class="mt-8">
                    <div class="flex justify-between items-end mb-3">
                        <span class="text-gray-500 text-sm">Selected Seat</span>
                        <span id="selectedSeatDisplay" class="text-4xl font-bold text-emerald-600 leading-none">-</span>
                    </div>
                    
                    <button id="bookBtn" 
                            class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 
                                 text-white py-4 rounded-2xl font-semibold text-lg shadow-lg shadow-emerald-500/30 
                                 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                            disabled>
                        <i class="fa-solid fa-ticket"></i>
                        Confirm Booking
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const seats = document.querySelectorAll('.seat:not(.booked)');
    const bookBtn = document.getElementById('bookBtn');
    const selectedSeatDisplay = document.getElementById('selectedSeatDisplay');
    const scheduleId = document.getElementById('schedule_id').value;
    
    let selectedSeat = null;

    seats.forEach(seat => {
        seat.addEventListener('click', () => {
            seats.forEach(s => s.classList.remove('selected'));
            
            seat.classList.add('selected');
            selectedSeat = seat.innerText.trim();
            
            selectedSeatDisplay.textContent = selectedSeat;
            bookBtn.disabled = false;
        });
    });

    bookBtn.addEventListener('click', () => {
        if (!selectedSeat) return;
        showPaymentModal();
        });

        function proceedBooking() {
            const fromValue = "{{ $from }}";
            const direction = fromValue.includes("Campus") ? "from_campus" : "to_campus";
            const travelDate = document.getElementById("travel_date").value;

            fetch("{{ route('seats.book') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    routeId: scheduleId,
                    seats: [selectedSeat],
                    travel_date: travelDate,
                    direction: direction
                })
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                if(data.success){
                    window.location.href = "/ticket/" + data.booking_id;
                }
            });
        }
    
        function showPaymentModal() {
            document.getElementById("paymentModal").style.display = "block";
        }
        function closeModal() {
            document.getElementById("paymentModal").style.display = "none";
        }
        function confirmPayment() {
            const number = document.getElementById("bkashNumber").value;
            if (!number) {
                alert("Enter bKash number");
                return;
            }
            closeModal();
            proceedBooking();
        }
            
    
</script>
<div id="paymentModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">
    <div style="background:white; width:300px; margin:100px auto; padding:20px; border-radius:10px; text-align:center;"> 
        <h3>📱 bKash Payment</h3>
        <p>Amount: {{ $schedule->route->fare }} BDT</p>
        <input type="text" placeholder="Enter bKash Number" id="bkashNumber" style="width:100%; padding:8px; margin:10px 0;">
        <button onclick="confirmPayment()" style="background:#e2136e; color:white; padding:8px 12px;">Pay Now</button>
        <button onclick="closeModal()">Cancel</button>
    </div>

</div>

</body>
</html>