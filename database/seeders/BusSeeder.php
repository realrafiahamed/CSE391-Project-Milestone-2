<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    DB::table('buses')->delete();
    $routes = DB::table('routes')->limit(11)->get();

    if ($routes->isEmpty()) return;

    $i = 1;

    foreach ($routes as $route) {
        DB::table('buses')->insert([
            'bus_number' => 'BUS-' . str_pad($i, 2, '0', STR_PAD_LEFT),
            'seat_capacity' => 40,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $i++;   
    }
    }
}
