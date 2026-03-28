<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Register - BracU Bus Booking</title>
<style>
    * {
        margin: 0; padding: 0; box-sizing: border-box;
        font-family: Arial, sans-serif;
    }
    body, html { height: 100%; }
    .bg {
        background: url('/bus.jpg') no-repeat center center/cover;
        height: 100%;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding-right: 3%;
    }
    .register-box {
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 10px;
        width: 380px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }
    .register-box h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    .register-box input, .register-box select {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .register-box button {
        width: 100%;
        padding: 10px;
        background: #0056b3;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 15px;
    }
    .register-box button:hover {
        background: #004494;
    }
    .login-link {
        margin-top: 15px;
        text-align: center;
        font-size: 14px;
    }
    .login-link a {
        color: #0056b3;
        text-decoration: none;
        font-weight: bold;
    }
    .login-link a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
<div class="bg">
    <div class="register-box">
        <h2>Register</h2>
        @if ($errors->any())
        <div style="color:red; margin-bottom:10px;">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ url('/register') }}" autocomplete="off">
            @csrf
            <input type="text" name="first_name" placeholder="First Name" required value="{{ old('first_name') }}" />
            <input type="text" name="last_name" placeholder="Last Name" required value="{{ old('last_name') }}"/>
            <input type="email" name="email" placeholder="University Gsuit Email" required />
            <input type="tel" name="phone" placeholder="Phone Number" required />

            <!-- Default Pickup Location Dropdown -->
            <select name="default_pickup_location" id="default_location" required>
                <option value="" disabled selected hidden>Select Default PickUp Location</option>
                <option value="Abdullahpur">Abdullahpur</option>
                <option value="House Building">House Building</option>
                <option value="Azampur">Azampur</option>
                <option value="Jasimuddin">Jasimuddin</option>
                <option value="Airport">Airport</option>
                <option value="Kawla">Kawla</option>
                <option value="Khilkhet">Khilkhet</option>
                <option value="Biswa Road">Biswa Road</option>
                <option value="Shewrah">Shewrah</option>

                <option value="Mirpur Bangla College">Mirpur Bangla College</option>
                <option value="Dhaka Laboratory School and College">Dhaka Laboratory School & College</option>
                <option value="Sony Cinema Hall">Sony Cinema Hall</option>
                <option value="Mirpur College Gate (Mirpur 2)">Mirpur College Gate (Mirpur 2)</option>
                <option value="Swimming Federation Gate">Swimming Federation Gate</option>
                <option value="Popular Diagnostic Centre">Popular Diagnostic Centre</option>
                <option value="Pallabi Post Office">Pallabi Post Office</option>
                <option value="Mirpur 11.5">Mirpur 11.5</option>
                <option value="Mirpur Ceramics">Mirpur Ceramics</option>
                <option value="Mirpur DOHS Gate">Mirpur DOHS Gate</option>
                <option value="Pallabi Thana">Pallabi Thana</option>
                <option value="Kalshi Bus Stand">Kalshi Bus Stand</option>
                <option value="ECB Chattar">ECB Chattar</option>

                <option value="Mirpur 14 Bus Stand">Mirpur 14 Bus Stand</option>
                <option value="NAM Garden Officers Quarter">NAM Garden Officers Quarter</option>
                <option value="Adarsha High School">Adarsha High School</option>
                <option value="Al Helal Specialized Hospital">Al Helal Specialized Hospital</option>
                <option value="Kazipara">Kazipara</option>
                <option value="Shewrapara">Shewrapara</option>
                <option value="Taltola Bus Stand">Taltola Bus Stand</option>
                <option value="Shadhinata Tower">Shadhinata Tower</option>

                <option value="Jigatola Bus Stand">Jigatola Bus Stand</option>
                <option value="Shankar Bus Stand">Shankar Bus Stand</option>
                <option value="Meena Bazar">Meena Bazar</option>
                <option value="West end of Manik Mia Avenue">West end of Manik Mia Avenue</option>

                <option value="Azimpur Etimkhana Mour">Azimpur Etimkhana Mour</option>
                <option value="Azimpur Chowrasta">Azimpur Chowrasta</option>
                <option value="New Market">New Market</option>
                <option value="Happy Arcade Shopping Mall">Happy Arcade Shopping Mall</option>
                <option value="Dhanmondi Road No 7">Dhanmondi Road No 7</option>
                <option value="Kalabagan Krira Chokro">Kalabagan Krira Chokro</option>
                <option value="Sobhanbag">Sobhanbag</option>
                <option value="Khejur Bagan Mour">Khejur Bagan Mour</option>

                <option value="Doyaganj Mour">Doyaganj Mour</option>
                <option value="Ittefaq Mour">Ittefaq Mour</option>
                <option value="Mugda Foot Over-bridge">Mugda Foot Over-bridge</option>
                <option value="Boudhha Mandir">Boudhha Mandir</option>
                <option value="Bashabo">Bashabo</option>
                <option value="Khilgaon Police Fari">Khilgaon Police Fari</option>
                <option value="Khidmah Hospital">Khidmah Hospital</option>

                <option value="Baldha Garden">Baldha Garden</option>
                <option value="Motijheel">Motijheel</option>
                <option value="Arambagh">Arambagh</option>
                <option value="Fakirapool Mour">Fakirapool Mour</option>
                <option value="Purana Paltan">Purana Paltan</option>
                <option value="Kakrail Mour">Kakrail Mour</option>
                <option value="Shantinagar Mour">Shantinagar Mour</option>
                <option value="Malibagh Mour">Malibagh Mour</option>
                <option value="Mouchak Mour">Mouchak Mour</option>
                <option value="Moghbazar T&T Office">Moghbazar T&T Office</option>
                <option value="Moghbazar Mour">Moghbazar Mour</option>

                <option value="Shia Masjid (near Top Ten shop)">Shia Masjid</option>
                <option value="Opposite to Suchona Community Center">Suchona Community Center</option>
                <option value="Shampa Market">Shampa Market</option>
                <option value="Shyamoli (Bata Mour)">Shyamoli (Bata Mour)</option>
                <option value="Opposite to Shyamoli Cinema Hall">Shyamoli Cinema Hall</option>
                <option value="Agargaon Radio Office">Agargaon Radio Office</option>
                <option value="Opposite to Agargaon flower shops">Agargaon flower shops</option>

                <option value="In front of Bata Showroom (Opposite to Japan Garden City Main Gate)">Japan Garden City Main Gate</option>
                <option value="In front of Baitus Sujud Jame Mosque (Near Mohammadpur Bus Stand/Nurjahan Route)">Baitus Sujud Jame Mosque (Near Mohammadpur Bus Stand/Nurjahan Route)</option>
                <option value="Town Hall Supermarket (In front of Bikrampur Mistanna Bhandar)">Town Hall Supermarket (In front of Bikrampur Mistanna Bhandar)</option>
                <option value="Opposite to Asad Gate (Under Foot over Bridge)">Opposite to Asad Gate </option>
                <option value="Dhaka Dental College Hostel (Opposite to Sobhanbag Mosque)">Dhaka Dental College Hostel</option>
                <option value="New Model Mohumukhi High School (Opposite to Kalabagan Bus Counter)">New Model Mohumukhi High School (Opposite to Kalabagan Bus Counter)</option>
                <option value="Water Bhaban (Near Panthapath Mour)">Water Bhaban (Near Panthapath Mour)</option>

                <option value="Narayanganj Central Shaheed Minar (Chashara)">Narayanganj Central Shaheed Minar (Chashara)</option>
                <option value="Himaloy Chinese & Community Centre (opposite to Narayanganj Zila Parishad)">Himaloy Chinese & Community Centre</option>
                <option value="Shibu Market (in front of Dutch Bangla Bank)">Shibu Market </option>
                <option value="Jalkuri Bus Stand, Fatullah (in front of First Security Islami Bank)">Jalkuri Bus Stand, Fatullah</option>
                <option value="Bhuighar (near Darussunnah Islamia Kamil Madrasah)">Bhuighar</option>
                <option value="Signboard (near Islamia Eye Hospital)">Signboard (near Islamia Eye Hospital)</option>
                <option value="Shamsul Hoque School & College (under foot over-bridge)">Shamsul Hoque School & College </option>
                <option value="Sanarpar Bus Stand, Siddhirganj">Sanarpar Bus Stand, Siddhirganj</option>
                <option value="Madaninagar Fazil Madrasah, Siddhirganj (near foot over-bridge)">Madaninagar Fazil Madrasah, Siddhirganj </option>
                <option value="Khankaye Jame Masjid, Narayanganj (near foot over-bridge)">Khankaye Jame Masjid, Narayanganj </option>
                <option value="Opposite to Rani Mahal Cinema Hall, Demra">Opposite to Rani Mahal Cinema Hall, Demra</option>
                <option value="IFIC Bank Ltd (opposite to Sarulia Bazar)">IFIC Bank Ltd (opposite to Sarulia Bazar)</option>
                <option value="In front of Demra Ideal College">In front of Demra Ideal College</option>

                <option value="Ebenezer International School, Bashundhara R/A">Ebenezer International School, Bashundhara R/A</option>
                <option value="Block-F, Road No 08, Bashundhara R/A (opposite to IFIC Bank)">Block-F, Road No 08, Bashundhara R/A </option>
                <option value="In front of Aga Khan Academy, Bashundhara R/A">In front of Aga Khan Academy, Bashundhara R/A</option>
                <option value="Jamuna Future Park (Under foot over-bridge)">Jamuna Future Park </option>
            </select>

            <input type="text" name="department" placeholder="Department" required />
            <input type="text" name="student_id" placeholder="Student ID" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required />

            <button type="submit">Register</button>
        </form>
        <div class="login-link">
            Already have an account? <a href="/">Login</a>
        </div>
    </div>
</div>
</body>
</html>