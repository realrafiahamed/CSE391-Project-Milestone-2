<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Delete Profile</title>
<style>
    * { margin:0; padding:0; box-sizing:border-box; font-family: Arial; }
    body {
        height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        background: linear-gradient(135deg, #c9d6ff, #e2e2e2);
    }

    .box {
        background:white;
        padding:30px;
        border-radius:12px;
        width:380px;
        text-align:center;
        box-shadow:0 10px 30px rgba(0,0,0,0.3);
    }

    h2 {
        margin-bottom:15px;
        color:#333;
    }

    .warning {
        background:#ffe5e5;
        color:#a10000;
        padding:12px;
        border-radius:8px;
        margin-bottom:20px;
        font-size:14px;
    }

    .success {
        background:#d4edda;
        color:#155724;
        padding:10px;
        border-radius:6px;
        margin-bottom:15px;
    }

    .error {
        background:#f8d7da;
        color:#721c24;
        padding:10px;
        border-radius:6px;
        margin-bottom:10px;
        text-align:left;
    }

    input {
        width:100%;
        padding:12px;
        margin:10px 0;
        border-radius:6px;
        border:1px solid #ccc;
    }

    button {
        width:100%;
        padding:12px;
        background:#ff4b2b;
        color:white;
        border:none;
        border-radius:6px;
        font-size:16px;
        cursor:pointer;
        margin-top:10px;
    }

    button:hover {
        background:#e03e20;
    }

    .dashboard-btn {
        margin-top:10px;
        display:block;
        width:100%;
        padding:10px;
        background:#6c757d;
        color:white;
        border-radius:6px;
        text-decoration:none;
    }

    .dashboard-btn:hover {
        background:#5a6268;
    }
</style>
</head>

<body>

<div class="box">
    <h2>⚠️ Delete Account</h2>

    {{-- SUCCESS MESSAGE --}}
    @if (session('status') === 'account-deleted')
        <div class="success">
            ✔ Profile deleted successfully.
        </div>

        {{-- AUTO REDIRECT --}}
        <script>
            setTimeout(() => {
                window.location.href = "{{ route('login') }}";
            }, 3000);
        </script>
    @endif

    <div class="warning">
        Deleting Your Account is permanent and cannot be undone.<br><br>
        Type <b>DELETE</b> to confirm.
    </div>

    {{-- ERRORS --}}
    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('profile.delete') }}">
        @csrf
        @method('DELETE')
        <input type="text" name="confirm_text" placeholder="Type DELETE here..." required>
        <button type="submit">Delete My Account</button>
    </form>

    {{-- DASHBOARD BUTTON --}}
    <a href="{{ route('dashboard') }}" class="dashboard-btn">
        Go Back to Dashboard</a>
</div>
</body>
</html>