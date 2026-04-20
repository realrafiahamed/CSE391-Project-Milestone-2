<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('bookings')->truncate();
        DB::table('schedules')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $routes = collect(DB::table('routes')->get());
        $buses  = DB::table('buses')->get();

        $times = [
            ['07:30:00', '09:00:00'],
            ['12:30:00', '14:00:00'],
            ['17:00:00', '18:30:00'],
        ];

        $dates = [
            now()->toDateString(),
            now()->addDay()->toDateString(),
            now()->addDays(2)->toDateString(),
        ];

        // YOUR COMMENT BLOCKS (route index ranges)
        $groups = [
            [0, 9],
            [9, 13],
            [22, 8],
            [30, 8],
            [38, 8],
            [46, 7],
            [53, 11],
            [64, 7],
            [71, 7],
            [78, 13],
            [91, 3],
        ];

        $busIndex = 0;

        foreach ($groups as $g) {

            $start = $g[0];
            $count = $g[1];

            $routeGroup = $routes->slice($start, $count);

            $bus = $buses[$busIndex % $buses->count()];
            $busIndex++;

            foreach ($routeGroup as $route) {
                foreach ($dates as $date) {
                    foreach ($times as $t) {

                        DB::table('schedules')->insert([
                            'bus_id' => $bus->id,
                            'route_id' => $route->id,
                            'travel_date' => $date,
                            'departure_time' => $t[0],
                            'arrival_time' => $t[1],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
    }
}