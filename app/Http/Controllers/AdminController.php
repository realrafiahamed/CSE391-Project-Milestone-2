<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Bus;
use App\Models\Route;
use App\Models\Schedule;
use App\Mail\AnnouncementMail;
use App\Models\Booking;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today()->toDateString();
        $bookings = DB::table('bookings')
            ->join('schedules', 'bookings.schedule_id', '=', 'schedules.id')
            ->join('routes', 'schedules.route_id', '=', 'routes.id')
            ->where('bookings.travel_date', $today)
            ->select(
                'bookings.*',
                'routes.from_location',
                'routes.to_location',
                'schedules.departure_time',
                'schedules.arrival_time'
            )
            ->get();

        return view('admin.dashboard', compact('bookings'));
    }

    public function buses()
    {
        $buses = Bus::all();
        return view('admin.buses', compact('buses'));
    }

    public function storeBus(Request $request)
    {
        Bus::create([
            'bus_number' => $request->bus_number,
            'seat_capacity' => $request->seat_capacity,
            'admin_id' => 1
        ]);

        return back();
    }

    public function routes()
    {
        $routes = Route::all();
        return view('admin.routes', compact('routes'));
    }

    public function storeRoute(Request $request)
    {
        Route::create([
            'from_location' => $request->from_location,
            'to_location' => $request->to_location,
            'fare' => $request->fare,
            'admin_id' => 1
        ]);

        return back();
    }

    public function schedules()
    {
        $schedules = Schedule::with(['bus', 'route'])->get();
        $buses = Bus::all();
        $routes = Route::all();

        return view('admin.schedules', compact('schedules', 'buses', 'routes'));
    }

    public function storeSchedule(Request $request)
    {
        Schedule::create([
            'bus_id' => $request->bus_id,
            'route_id' => $request->route_id,
            'travel_date' => $request->travel_date,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'admin_id' => 1
        ]);

        return back();
    }

    public function announcementForm()
    {
        return view('admin.announcement');
    }

    public function sendAnnouncement(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(
                new AnnouncementMail($request->subject, $request->message)
            );
        }

        return back()->with('success', 'Announcement sent to all students!');
    }

}
