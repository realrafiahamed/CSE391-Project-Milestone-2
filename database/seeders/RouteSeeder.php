<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RouteSeeder extends Seeder
{
    public function run(): void
    {
        $campus = "Campus (Badda)";

        $routes = [

            // Uttara line
            "Abdullahpur",
            "House Building",
            "Azampur",
            "Jasimuddin",
            "Airport",
            "Kawla",
            "Khilkhet",
            "Biswa Road",
            "Shewrah",

            // Mirpur 1
            "Mirpur Bangla College",
            "Dhaka Laboratory School and College",
            "Sony Cinema Hall",
            "Mirpur College Gate (Mirpur 2)",
            "Swimming Federation Gate",
            "Popular Diagnostic Centre",
            "Pallabi Post Office",
            "Mirpur 11.5",
            "Mirpur Ceramics",
            "Mirpur DOHS Gate",
            "Pallabi Thana",
            "Kalshi Bus Stand",
            "ECB Chattar",

            // Mirpur 2
            "Mirpur 14 Bus Stand",
            "NAM Garden Officers Quarter",
            "Adarsha High School",
            "Al Helal Specialized Hospital",
            "Kazipara",
            "Shewrapara",
            "Taltola Bus Stand",
            "Shadhinata Tower",

            // Dhanmondi
            "Jigatola Bus Stand",
            "Shankar Bus Stand",
            "Meena Bazar",
            "West end of Manik Mia Avenue",

            // Azimpur
            "Azimpur Etimkhana Mour",
            "Azimpur Chowrasta",
            "New Market",
            "Happy Arcade Shopping Mall",
            "Dhanmondi Road No 7",
            "Kalabagan Krira Chokro",
            "Sobhanbag",
            "Khejur Bagan Mour",

            // Old Dhaka
            "Doyaganj Mour",
            "Ittefaq Mour",
            "Mugda Foot Over-bridge",
            "Boudhha Mandir",
            "Bashabo",
            "Khilgaon Police Fari",
            "Khidmah Hospital",

            // Motijheel
            "Baldha Garden",
            "Motijheel",
            "Arambagh",
            "Fakirapool Mour",
            "Purana Paltan",
            "Kakrail Mour",
            "Shantinagar Mour",
            "Malibagh Mour",
            "Mouchak Mour",
            "Moghbazar T&T Office",
            "Moghbazar Mour",

            // Shyamoli
            "Shia Masjid (near Top Ten shop)",
            "Opposite to Suchona Community Center",
            "Shampa Market",
            "Shyamoli (Bata Mour)",
            "Opposite to Shyamoli Cinema Hall",
            "Agargaon Radio Office",
            "Opposite to Agargaon flower shops",

            // Mohammadpur
            "In front of Bata Showroom (Opposite to Japan Garden City Main Gate)",
            "In front of Baitus Sujud Jame Mosque",
            "Town Hall Supermarket",
            "Opposite to Asad Gate",
            "Dhaka Dental College Hostel",
            "New Model Mohumukhi High School",
            "Water Bhaban",

            // Narayanganj (FARE = 200)
            "Narayanganj Central Shaheed Minar (Chashara)",
            "Himaloy Chinese & Community Centre",
            "Shibu Market",
            "Jalkuri Bus Stand, Fatullah",
            "Bhuighar",
            "Signboard",
            "Shamsul Hoque School & College",
            "Sanarpar Bus Stand",
            "Madaninagar Fazil Madrasah",
            "Khankaye Jame Masjid",
            "Rani Mahal Cinema Hall",
            "IFIC Bank Ltd",
            "Demra Ideal College",

            // Bashundhara
            "Ebenezer International School, Bashundhara R/A",
            "Block-F, Road No 08",
            "Aga Khan Academy, Bashundhara R/A",
            "Jamuna Future Park",
        ];

        foreach ($routes as $from) {

            $fare = (str_contains($from, "Narayanganj")) ? 200 : 100;

            DB::table('routes')->insert([
                'from_location' => $from,
                'to_location' => $campus,
                'fare' => $fare,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}