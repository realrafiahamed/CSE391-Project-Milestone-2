<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        flex-direction: column;
        gap: 15px;
    }

    .login-box {
        width: 320px;
        padding: 25px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    input {
        width: 100%;
        margin: 10px 0;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        width: 100%;
        padding: 10px;
        background: #0056b3;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        margin-top: 5px;
    }

    button:hover {
        background: #004099;
    }

    .error {
        color: red;
        text-align: center;
        margin-top: 10px;
    }

    .back-btn {
        display: block;
        text-align: center;
        margin-top: 10px;
        padding: 10px;
        background: #6b7280;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .back-btn:hover {
        background: #4b5563;
    }

    .info-box {
        width: 320px;
        background: #fff3cd;
        border: 1px solid #ffeeba;
        padding: 15px;
        border-radius: 8px;
        font-size: 14px;
        color: #856404;
        text-align: center;
    }
</style>

</head>
<body>

<div class="login-box">
    <h2>Admin Login</h2>

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <input type="text" name="username" placeholder="Admin Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>

    <!-- BACK BUTTON -->
    <a href="/login" class="back-btn">Go Back to Student Login</a>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif
</div>

<!-- INFO BOX -->
<div class="info-box">
    <strong>For Testing</strong><br><br>
    Username: <b>admin</b><br>
    Password: <b>admin123</b>
</div>

</body>
</html>