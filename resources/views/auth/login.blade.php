<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BracU Bus Booking</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }
    body, html {
        height: 100%;
    }
    .bg {
        background: url('{{ asset("bus.jpg") }}') no-repeat center center/cover;
        height: 100%;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding-right: 2%;
    }
    .login-box {
        background: rgba(255, 255, 255, 0.9);
        padding: 50px;
        border-radius: 10px;
        width: 380px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }
    .login-box h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    .login-box input {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .login-box button {
        margin-top: 8px;
        width: 100%;
        padding: 10px;
        background: #0056b3;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
    .login-box button:hover {
        background: #004494;
    }
    .register-link {
        margin-top: 15px;
        text-align: center;
        font-size: 15px;
    }
    .register-link a {
        color: #0056b3;
        text-decoration: none;
        font-weight: bold;
    }
    .register-link a:hover {
        text-decoration: underline;
    }
    .error-message {
        color: red;
        margin-top: 10px;
        font-size: 14px;
        text-align: center;
    }
</style>
</head>
<body>

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

<div class="bg">
    <div class="login-box">
        <h2>Login</h2>

        {{-- DELETE SUCCESS MESSAGE --}}
        @if (session('status') === 'account-deleted')
            <div style="
                background: #d4edda;
                color: #155724;
                padding: 10px;
                border-radius: 5px;
                margin-bottom: 15px;
                text-align:center;">
                ✔ Profile deleted successfully.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="register-link" style="margin-top:15px;">
            No account? <a href="{{ route('register') }}">Register</a><br>
            For admin? <a href="{{ route('admin.login') }}">Login here</a>
        </div>
    </div>
</div>
</body>
</html>