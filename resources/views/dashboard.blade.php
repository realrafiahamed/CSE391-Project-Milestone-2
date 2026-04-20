<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>BRAC University – Bus Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --red:    #c0392b;
      --red-d:  #96281b;
      --red-l:  #f8e9e7;
      --ink:    #1a1a1a;
      --mute:   #6b6b6b;
      --line:   #ddd;
      --bg:     #f5f4f0;
      --white:  #ffffff;
      --card:   #ffffff;
      --mono:   'IBM Plex Mono', monospace;
      --sans:   'IBM Plex Sans', sans-serif;
      --radius: 6px;
      --shadow: 0 2px 12px rgba(0,0,0,0.08);
    }

    body {
      font-family: var(--sans);
      background: var(--bg);
      color: var(--ink);
      min-height: 100vh;
    }

    /* ── NAV ── */
    nav {
      background: var(--white);
      border-bottom: 2px solid var(--red);
      padding: 0 32px;
      height: 62px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 1px 6px rgba(0,0,0,0.07);
    }

    .nav-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }
    .nav-brand .logo-badge {
      background: var(--red);
      color: #fff;
      font-family: var(--mono);
      font-size: 12px;
      font-weight: 500;
      letter-spacing: 1px;
      padding: 4px 8px;
      border-radius: 4px;
    }
    .nav-brand .brand-text {
      font-size: 15px;
      font-weight: 700;
      color: var(--ink);
      letter-spacing: -0.3px;
    }
    .nav-brand .brand-sub {
      font-size: 11px;
      font-weight: 400;
      color: var(--mute);
      font-family: var(--mono);
    }
    .brand-info { display: flex; flex-direction: column; }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 4px;
      list-style: none;
    }
    .nav-links a {
      text-decoration: none;
      color: var(--ink);
      font-size: 14px;
      font-weight: 500;
      padding: 6px 14px;
      border-radius: var(--radius);
      transition: background 0.15s, color 0.15s;
    }
    .nav-links a:hover { background: var(--red-l); color: var(--red); }
    .nav-links a.active { color: var(--red); font-weight: 600; }

    .dropdown {
      position: relative;
    }
    .dropdown-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      background: none;
      border: 1.5px solid var(--line);
      padding: 6px 14px;
      border-radius: 30px;
      font-family: var(--sans);
      font-size: 14px;
      font-weight: 500;
      color: var(--ink);
      cursor: pointer;
      transition: border-color 0.15s, background 0.15s;
      list-style: none; 
    }
    .dropdown-btn:hover { border-color: var(--red); background: var(--red-l); }
    .dropdown-btn .avatar {
      width: 26px; height: 26px;
      background: var(--red);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      color: #fff;
      font-size: 11px;
      font-weight: 700;
      font-family: var(--mono);
    }
    .dropdown-btn .chevron {
      font-size: 10px;
      color: var(--mute);
      transition: transform 0.2s;
    }
    .dropdown[open] .chevron { transform: rotate(180deg); }

    .dropdown-menu {
      display: none;
      position: absolute;
      right: 0; top: calc(100% + 8px);
      background: var(--white);
      border: 1.5px solid var(--line);
      border-radius: var(--radius);
      min-width: 200px;
      box-shadow: var(--shadow);
      overflow: hidden;
    }
    .dropdown[open] .dropdown-menu { display: block; }
    .dropdown-menu a,
    .dropdown-menu button {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      color: var(--ink);
      font-size: 14px;
      padding: 11px 16px;
      border-bottom: 1px solid var(--line);
      transition: background 0.12s;
      width: 100%;
      background: none;
      border: none;
      text-align: left;
      cursor: pointer;
    }

    .dropdown-menu a:hover,
    .dropdown-menu button:hover {
      background: var(--red-l);
    }

    .dropdown-menu a.danger,
    .dropdown-menu button.danger {
      color: var(--red);
    }

    .dropdown-menu a.danger:hover,
    .dropdown-menu button.danger:hover {
      background: var(--red-l);
    }
    .dropdown-menu a:last-child { border-bottom: none; }
    .dropdown-menu a span.icon { font-size: 15px; }

    .dropdown summary::-webkit-details-marker,
    .dropdown summary::marker {
      display: none;
    }

    .hero {
      background: var(--red);
      color: #fff;
      padding: 36px 32px 32px;
      border-bottom: 3px solid var(--red-d);
    }
    .hero-inner { max-width: 860px; margin: 0 auto; }
    .hero h1 {
      font-size: 26px;
      font-weight: 700;
      letter-spacing: -0.5px;
      margin-bottom: 4px;
    }
    .hero p {
      font-size: 14px;
      opacity: 0.85;
      font-family: var(--mono);
    }

    main {
      max-width: 860px;
      margin: 36px auto;
      padding: 0 32px;
    }

    .section-label {
      font-family: var(--mono);
      font-size: 11px;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: var(--mute);
      margin-bottom: 14px;
    }

    .booking-card {
      background: var(--card);
      border: 1.5px solid var(--line);
      border-radius: 10px;
      box-shadow: var(--shadow);
      overflow: hidden;
    }
    .booking-card-header {
      background: var(--red-l);
      border-bottom: 1.5px solid #e5cac7;
      padding: 16px 24px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .booking-card-header .dot {
      width: 10px; height: 10px;
      border-radius: 50%;
      background: var(--red);
    }
    .booking-card-header span {
      font-size: 14px;
      font-weight: 600;
      color: var(--red-d);
    }

    .booking-form {
      padding: 28px 24px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .form-group { display: flex; flex-direction: column; gap: 6px; }
    .form-group.full-width { grid-column: 1 / -1; }

    label {
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 0.4px;
      color: var(--mute);
      text-transform: uppercase;
      font-family: var(--mono);
    }

    input, select {
      width: 100%;
      padding: 11px 14px;
      border: 1.5px solid var(--line);
      border-radius: var(--radius);
      font-family: var(--sans);
      font-size: 14px;
      color: var(--ink);
      background: var(--white);
      outline: none;
      transition: border-color 0.15s, box-shadow 0.15s;
      appearance: none;
      -webkit-appearance: none;
    }
    input:focus, select:focus {
      border-color: var(--red);
      box-shadow: 0 0 0 3px rgba(192, 57, 43, 0.1);
    }
    select {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b6b6b' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 12px center;
      padding-right: 34px;
    }

    .route-connector {
      grid-column: 1 / -1;
      display: flex;
      align-items: center;
      gap: 0;
      margin: -6px 0;
    }
    .route-connector .route-dot {
      width: 12px; height: 12px;
      border-radius: 50%;
      border: 2px solid var(--red);
      background: var(--white);
      flex-shrink: 0;
    }
    .route-connector .route-line {
      flex: 1;
      height: 2px;
      background: repeating-linear-gradient(90deg, var(--red) 0, var(--red) 6px, transparent 6px, transparent 12px);
    }
    .route-connector .route-arrow {
      font-size: 16px;
      color: var(--red);
      flex-shrink: 0;
    }

    .form-footer {
      padding: 0 24px 28px;
      display: flex;
      justify-content: flex-end;
      align-items: center;
      gap: 12px;
    }

    .btn-reset {
      background: none;
      border: 1.5px solid var(--line);
      padding: 11px 22px;
      border-radius: var(--radius);
      font-family: var(--sans);
      font-size: 14px;
      font-weight: 500;
      color: var(--mute);
      cursor: pointer;
      transition: border-color 0.15s, color 0.15s;
    }
    .btn-reset:hover { border-color: var(--ink); color: var(--ink); }
    .btn-search {
      background: var(--red);
      border: none;
      padding: 11px 28px;
      border-radius: var(--radius);
      font-family: var(--sans);
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      cursor: pointer;
      letter-spacing: 0.3px;
      transition: background 0.15s, transform 0.1s;
    }
    .btn-search:hover { background: var(--red-d); }
    .btn-search:active { transform: scale(0.98); }

    .info-tiles {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 14px;
      margin-top: 32px;
    }
    .tile {
      background: var(--card);
      border: 1.5px solid var(--line);
      border-radius: 8px;
      padding: 18px 20px;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .tile .tile-icon { font-size: 22px; margin-bottom: 4px; }
    .tile .tile-val {
      font-size: 22px;
      font-weight: 700;
      font-family: var(--mono);
      color: var(--red);
    }
    .tile .tile-label { font-size: 12px; color: var(--mute); }

    footer {
      margin-top: 60px;
      border-top: 1.5px solid var(--line);
      padding: 20px 32px;
      text-align: center;
      font-size: 12px;
      color: var(--mute);
      font-family: var(--mono);
    }

    @media (max-width: 620px) {
      nav { padding: 0 16px; }
      .hero { padding: 24px 16px; }
      main { padding: 0 16px; margin: 24px auto; }
      .booking-form { grid-template-columns: 1fr; }
      .route-connector { display: none; }
      .info-tiles { grid-template-columns: 1fr 1fr; }
    }
  </style>
</head>
<body>

<nav>
  <a class="nav-brand" href="#">
    <span class="logo-badge">BRACU</span>
    <div class="brand-info">
      <span class="brand-text">BUS DASHBOARD</span>
      <span class="brand-sub">student portal</span>
    </div>
  </a>

  <ul class="nav-links">
    <li><a href="{{ route('dashboard') }}" class="active">Dashboard</a></li>
    <li><a href="{{ route('tickets.index') }}">My Tickets</a></li>
    <li><a href="https://www.bracu.ac.bd/students-transport-service" target="_blank">Routes</a></li>
    <li><a href="{{ route('contact') }}">Contact Us</a></li>

    <li class="dropdown">
      <details class="dropdown">
        <summary class="dropdown-btn">
          <span class="avatar">RA</span>
          Profile
          <span class="chevron">▼</span>
        </summary>
        <div class="dropdown-menu">
          <a href="{{ route('profile.edit') }}"><span class="icon">✏️</span> Edit Profile</a>
          <a href="{{ route('password.change') }}"><span class="icon">🔑</span> Change Password</a>
          <a href="{{ route('profile.delete.page') }}" class="danger"><span class="icon">🗑️</span> Delete Profile</a>
          <form method="POST" action="{{ route('logout') }}" style="margin:0;">
          @csrf
          <button type="submit" class="danger">
              <span class="icon">🚪</span> Logout
          </button>
          </form>
        </div>
      </details>
    </li>
  </ul>
</nav>

<div class="hero">
  <div class="hero-inner">
    <h1>BRACU Bus Dashboard</h1>
    <p>Welcome back• Student Transport System — Dhaka routes</p>
  </div>
</div>

<main>

  <p class="section-label">Quick Booking</p>

  <div class="booking-card">
    <div class="booking-card-header">
      <span class="dot"></span>
      <span>Plan Your Journey</span>
    </div>

    <form id="searchForm" method="GET" action="{{ route('buses.search') }}">
      <div class="booking-form">
        <div class="form-group">
          <label for="from">From — Pickup Point</label>
          <select id="from" name="from" required>
            <option value="">Select pickup point</option>
            
            @foreach($locations as $loc)
              <option value="{{ $loc }}">{{ $loc }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="to">To — Drop-off Point</label>
          <select id="to" name="to" required>
            <option value="">Select drop-off location</option>
            
            @foreach($locations as $loc)
              <option value="{{ $loc }}">{{ $loc }}</option>
            @endforeach
          </select>
        </div>
      
        <div class="route-connector">
          <span class="route-dot"></span>
          <span class="route-line"></span>
          <span class="route-arrow">▶</span>
        </div>

        <div class="form-group">
          <label for="travel-date">Travel Date</label>
          <input type="date" name="date" id="travel-date" required/>
        </div>


        <div class="form-group">
          <label for="time-slot">Departure Slot</label>
          <select id="time-slot" name="time" required>
            <option value="">Select time</option>
            <option value="07:30:00">07:30 AM – Morning (1st batch)</option>
            <option value="12:30:00">12:00 PM – Noon</option>
            <option value="17:00:00">05:00 PM – Afternoon</option>     
          </select>
        </div>
      </div>

      <div class="form-footer">
        <button class="btn-reset" type="button" onclick="window.location.href='{{ url()->current() }}'">Clear</button>
        <button type="submit" class="btn-search">Search Available Buses →</button>
      </div>
    </form>
  </div>

  <div style="margin-top:16px; padding:12px 16px; background:#fff8e1; border:1.5px solid #f0c040; border-radius:6px; font-size:13px; color:#7a5c00; font-family:var(--mono);">
    ⚠️ Student ID card must be shown to the driver. Tickets are non-transferable.
  </div>
</main>
<footer>
  © 2026 BRAC University &nbsp;|&nbsp; Developed by Rafi Ahamed (ID: 22241052)
</footer>

    <script id="locations-data" type="application/json">
      {!! json_encode($locations) !!}
    </script>

    <script>
    const locations = JSON.parse(document.getElementById("locations-data").textContent);
    const from = document.getElementById("from");
    const to = document.getElementById("to");
    from.addEventListener("change", function () {
        to.innerHTML = "";
        if (from.value === "Campus (Badda)") {
            locations.forEach(loc => {
                if (loc !== "Campus (Badda)") {
                    to.innerHTML += `<option value="${loc}">${loc}</option>`;
                }
            });
        } else {
            to.innerHTML = `<option value="Campus (Badda)">Campus (Badda)</option>`;
            to.value = "Campus (Badda)";
        }
    });

      const input = document.getElementById("travel-date");
      const today = new Date();
      const maxDate = new Date();
      maxDate.setDate(today.getDate() + 2)
      const format = d => d.toISOString().split('T')[0];
      input.min = format(today);
      input.max = format(maxDate);
      input.value = format(today);
    </script>

    <script>
      document.getElementById("searchForm").addEventListener("submit", function(e) {

          const date = document.getElementById("travel-date").value;
          const time = document.getElementById("time-slot").value;

          if (!date || !time) return;

          const selectedDateTime = new Date(date + "T" + time);
          const now = new Date();

          if (selectedDateTime < now) {
              e.preventDefault();
              alert("❌ You cannot search past buses.");
          }
      });
</script>
    
</body>
</html>