<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact Us</title>

<style>
    body {
        font-family: Arial;
        background: linear-gradient(135deg, #eef2f3, #dfe9f3);
        display:flex;
        justify-content:center;
        align-items:center;
        height:100vh;
    }

    .box {
        background:white;
        padding:30px;
        border-radius:10px;
        width:350px;
        text-align:center;
        box-shadow:0 4px 15px rgba(0,0,0,0.2);
    }

    h2 { margin-bottom:15px; }

    p { margin:8px 0; }

    .btn {
        display:block;
        margin-top:15px;
        padding:10px;
        background:#0056b3;
        color:white;
        text-decoration:none;
        border-radius:5px;
    }

    .btn:hover {
        background:#004494;
    }
</style>
</head>

<body>

<div class="box">
    <h2>Contact Us</h2>

    <p><b>Name:</b> Rafi Ahamed</p>
    <p><b>Student ID:</b> 22241052</p>
    <p><b>Department:</b> Computer Science and Engineering</p>
    <p><b>Email:</b> rafi.ahamed@bracu.ac.bd</p>
    <p><b>Phone:</b> 01714767113</p>
    <p><b>Institution:</b> BRAC University</p>

    <a href="{{ route('dashboard') }}" class="btn">Back to Dashboard</a>
</div>

</body>
</html>