<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Schedule;
use App\Models\Route;
use App\Models\Booking;
use App\Mail\TicketBookedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
class BusController extends Controller
    {
    
        public function search(Request $request)
        {
            $request->validate([
                'from' => 'required',
                'to' => 'required',
                'date' => 'required|date',
                'time' => 'required',
            ]);

            $from = $request->from;
            $to = $request->to;
            $date = $request->date;
            $time = $request->time;

            $schedules = Schedule::with(['bus', 'route'])
                //->whereDate('departure_time', $time) 
                ->whereTime('departure_time', $time) 
                ->whereHas('route', function ($q) use ($from, $to) {
                    $q->where(function ($sub) use ($from, $to) {
                        $sub->where('from_location', $from)
                            ->where('to_location', $to);
                    })->orWhere(function ($sub) use ($from, $to) {
                        $sub->where('from_location', $to)
                            ->where('to_location', $from);
                    });
                })
                ->get();
                $schedules = $schedules->unique(function ($item) {
                    return $item->bus_id . '_' . $item->departure_time;
                })->values();

            foreach ($schedules as $schedule) {
                $schedule->travel_date = $date;
                if ($schedule->route->from_location === $from) {
                    $schedule->display_from = $from;
                    $schedule->display_to = $to;
                } else {
                    $schedule->display_from = $to;
                    $schedule->display_to = $from;
                }
            }

            return view('buses.index', compact('schedules', 'from', 'to'));
        } 
    
    

        public function index(Request $request)
        {
            $schedules = Schedule::with(['bus', 'route'])->get();
            return view('buses.index', [
                'schedules' => $schedules,
                'from' => $request->from ?? null,
                'to' => $request->to ?? null,
            ]);
        }

        public function seatLayout($id, Request $request)
        {
            $schedule = Schedule::with('bus', 'route')->findOrFail($id);
            $schedule->travel_date = $request->date;
            $bookings = Booking::where('travel_date', $schedule->travel_date)
                ->whereHas('schedule', function ($q) use ($schedule) {
                    $q->where('bus_id', $schedule->bus_id);
                })
                ->get();
            $bookedSeats = $bookings->pluck('seat_number')->toArray();
            return view('seat.layout', [
                'schedule' => $schedule,
                'bookedSeats' => $bookedSeats,
                'from' => $request->from,
                'to' => $request->to,
                'routeId' => $schedule->id
            ]);
        }

        public function bookSeat(Request $request)
        {
            try {
                $scheduleId = $request->routeId;
                $seat = $request->seats;
                if (is_array($seat)) {
                    $seat = $seat[0] ?? null;
                }

                $seat = strtoupper(trim($seat));
                if (!$scheduleId || !$seat) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Missing data'
                    ]);
                }

                $schedule = Schedule::with('route')->findOrFail($scheduleId);
                $userId = Auth::id();
                if (!$userId) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Please login first'
                    ]);
                }
                $date = $request->travel_date;

                $exists = Booking::where('travel_date', $request->travel_date)
                    ->where('seat_number', $seat)
                    ->whereHas('schedule', function ($q) use ($schedule) {
                        $q->where('bus_id', $schedule->bus_id);
                    })
                    ->exists();

                    

                if ($exists) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Seat already booked!'
                    ]);
                }

                $count = Booking::where('user_id', $userId)
                    ->where('travel_date', $date)
                    ->count();

                if ($count >= 2) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You already booked 2 trips today'
                    ]);
                }

                $direction = $request->direction ?? 'unknown';
                $directionExists = Booking::where('user_id', $userId)
                    ->where('travel_date', $request->travel_date)
                    ->where('direction', $direction)
                    ->exists();

                if ($directionExists) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Already booked this direction today'
                    ]);
                }

                /*
                -------------------------------------------------
                CREATE BOOKING
                -------------------------------------------------
                */

                $selectedDate = $request->travel_date;
                $departureTime = $schedule->departure_time;
                $now = now();
                $busDateTime = \Carbon\Carbon::parse($selectedDate . ' ' . $departureTime);
                if ($busDateTime->lt($now)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This bus has already departed'
                    ]);
                }

                $booking = Booking::create([
                    'user_id' => Auth::id(),
                    'schedule_id' => $scheduleId,
                    'seat_number' => $seat,
                    'travel_date' => $request->travel_date,
                    'direction' => $direction,
                ]);
                $user = Auth::user();
                Mail::to($user->email)
                    ->send(new TicketBookedMail($booking));

                return response()->json([
                    'success' => true,
                    'message' => 'Booking Confirmed! Check your email for ticket.',
                    'booking_id' => $booking->id
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }
        }

        public function ticket($id)
        {
            $booking = Booking::with('schedule.bus', 'schedule.route')->findOrFail($id);
            return view('seat.ticket', compact('booking'));
        }

        public function myTickets()
        {
            $userId = Auth::user()->id;
            $bookings = Booking::with(['schedule.bus', 'schedule.route'])
                ->where('user_id', $userId)
                ->latest()
                ->get();

            return view('tickets.index', compact('bookings'));
        }
    }