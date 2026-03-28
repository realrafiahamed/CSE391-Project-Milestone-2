<!-- resources/views/change_password.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Change Password - BracU Bus Booking</title>
<style>
    * { margin:0; padding:0; box-sizing:border-box; font-family: Arial, sans-serif; }
    body, html { height:100%; }
    .bg { background: url('/bus.jpg') no-repeat center center/cover; height:100%; display:flex; justify-content:flex-end; align-items:center; padding-right:3%; }
    .form-box { background: rgba(255,255,255,0.95); padding:30px; border-radius:10px; width:350px; box-shadow:0 4px 15px rgba(0,0,0,0.3); }
    .form-box h2 { text-align:center; margin-bottom:20px; color:#333; }
    .form-box input { width:100%; padding:10px; margin:8px 0; border:1px solid #ccc; border-radius:5px; }
    .form-box button { width:100%; padding:10px; background:#0056b3; color:white; border:none; border-radius:5px; cursor:pointer; font-size:16px; margin-top:15px; }
    .form-box button:hover { background:#004494; }
    .back-link { margin-top:15px; text-align:center; font-size:14px; }
    .back-link a { color:#0056b3; text-decoration:none; font-weight:bold; }
    .back-link a:hover { text-decoration:underline; }

    /* Success & error message boxes */
    .success { background: #d4edda; color: #155724; padding: 10px; border-radius:5px; margin-bottom:15px; }
    .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius:5px; margin-bottom:15px; }
</style>
</head>
<body>
<div class="bg">
    <div class="form-box">
        <h2>Change Password</h2>

        {{-- Success message --}}
        @if(session('status') === 'password-updated')
            <div class="success">
                ✔ Password updated successfully!
            </div>
        @endif

        {{-- Validation errors --}}
        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" autocomplete="off">
            @csrf
            @method('PUT')

            <input type="password" name="current_password" placeholder="Current Password" required />
            @error('current_password')
                <div class="error" style="margin-top:4px; font-size:14px;">{{ $message }}</div>
            @enderror

            <input type="password" name="password" placeholder="New Password" required />
            @error('password')
                <div class="error" style="margin-top:4px; font-size:14px;">{{ $message }}</div>
            @enderror

            <input type="password" name="password_confirmation" placeholder="Confirm New Password" required />

            <button type="submit">Update Password</button>
        </form>

        <div class="back-link">
            <a href="{{ route('dashboard') }}">Back to Dashboard</a>
        </div>
    </div>
</div>
</body>
</html>