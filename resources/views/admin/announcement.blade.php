<!DOCTYPE html>
<html>
<head>
    <title>Announcement</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f4f6f9; }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        button {
            padding: 10px;
            background: #2563eb;
            color: white;
            border: none;
            cursor: pointer;
        }

        .msg {
            color: green;
        }
    </style>
</head>
<body>

<div style="
    background:#1f2937;
    padding:12px;
    display:flex;
    gap:10px;
    align-items:center;
    border-radius:8px;
    margin-bottom:15px;">
    <a href="/admin/dashboard" style="color:white; text-decoration:none; padding:8px 12px; background:#374151; border-radius:6px;">Dashboard</a>
    <a href="/admin/buses" style="color:white; text-decoration:none; padding:8px 12px; background:#374151; border-radius:6px;">Buses</a>
    <a href="/admin/routes" style="color:white; text-decoration:none; padding:8px 12px; background:#374151; border-radius:6px;">Routes</a>
    <a href="/admin/schedules" style="color:white; text-decoration:none; padding:8px 12px; background:#374151; border-radius:6px;">Schedules</a>
    <a href="/admin/announcements" style="color:white; text-decoration:none; padding:8px 12px; background:#374151; border-radius:6px;">Announcement</a>
    <a href="/admin/logout" style="margin-left:auto; color:white; text-decoration:none; padding:8px 12px; background:#ef4444; border-radius:6px;">Logout</a>
</div>

<h2>Send Announcement</h2>
@if(session('success'))
    <p class="msg">{{ session('success') }}</p>
@endif

<form method="POST" action="/admin/announcements/send">
    @csrf
    <input type="text" name="subject" placeholder="Subject" required>
    <textarea name="message" rows="6" placeholder="Message" required></textarea>
    <button type="submit">Send to All Students</button>
</form>
</body>
</html>