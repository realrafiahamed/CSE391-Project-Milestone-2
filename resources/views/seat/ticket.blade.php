<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bus Ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    
    <style>
        .ticket {
            width: 340px;                    /* Narrower */
            margin: 30px auto;
            background: white;
            border: 2px solid #222;
            padding: 15px 14px;              /* Reduced padding */
            font-family: 'Courier New', Courier, monospace;
            font-size: 13px;
            line-height: 1.3;
            color: #111;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        
        .header {
            text-align: center;
            border-bottom: 2px dashed #333;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }
        
        .title {
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        
        .company {
            font-size: 12px;
            margin: 2px 0;
        }
        
        .divider {
            border-top: 1px dashed #555;
            margin: 9px 0;
        }
        
        .row {
            display: flex;
            justify-content: space-between;
            margin: 4px 0;
        }
        
        .seat {
            font-size: 19px;
            font-weight: 900;
            text-align: center;
            background: #111;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            display: inline-block;
            margin: 6px auto;
        }
        
        .footer {
            text-align: center;
            margin-top: 12px;
            font-size: 11px;
            border-top: 1px dashed #333;
            padding-top: 9px;
        }
    </style>
</head>
<body class="bg-gray-100 py-8">

<div class="ticket" id="ticket">
    
    <div class="header">
        <div class="title">BUS TICKET</div>
        <div class="company">BRACU Student Transport</div>
        <div style="font-size: 10px;">e-Ticket • Non Transferable</div>
    </div>

    <div class="row">
        <span>Passenger:</span>
        <span style="font-weight:bold;">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
    </div>
    <div class="row">
        <span>ID:</span>
        <span style="font-weight:bold;">{{ auth()->user()->student_id ?? 'N/A' }}</span>
    </div>

    <div class="divider"></div>

    <div class="row">
        <span>Bus No:</span>
        <span style="font-weight:bold;">{{ $booking->schedule->bus->bus_number }}</span>
    </div>

    <div class="text-center my-2">
        <div class="seat">SEAT {{ $booking->seat_number }}</div>
    </div>

    <div class="divider"></div>

    <div class="row">
        <span>From:</span>
        <span style="font-weight:bold;">{{ $booking->schedule->route->from_location }}</span>
    </div>
    <div class="row">
        <span>To:</span>
        <span style="font-weight:bold;">{{ $booking->schedule->route->to_location }}</span>
    </div>

    <div class="divider"></div>

    <div class="row">
        <span>Date:</span>
        <span style="font-weight:bold;">{{ $booking->travel_date }}</span>
    </div>
    <div class="row">
        <span>Time:</span>
        <span style="font-weight:bold;">{{ $booking->schedule->departure_time }}</span>
    </div>

    <div class="divider"></div>

    <div class="row">
        <span>Fare:</span>
        <span style="font-weight:bold;">{{ $booking->schedule->route->fare }} BDT</span>
    </div>

    <div class="divider"></div>

    <div class="footer">
        Thank You For Traveling With Us<br>
        Valid only for mentioned date & bus<br>
        Booking ID: #{{ str_pad($booking->id ?? '00001', 6, '0', STR_PAD_LEFT) }}
    </div>

</div>

<div class="text-center mt-6">
    <button onclick="downloadPDF()" 
            class="bg-black hover:bg-gray-800 text-white px-8 py-3 rounded-lg font-medium inline-flex items-center gap-2">
        <i class="fa-solid fa-download"></i>
        Download Ticket (PDF)
    </button>
    <a href="/" 
    class="bg-gray-300 hover:bg-gray-400 text-black px-8 py-3 rounded-lg font-medium inline-flex items-center gap-2 ml-2">
        <i class="fa-solid fa-home"></i>
        Go to Homepage
    </a>
</div>

<script>
function downloadPDF() {
    const element = document.getElementById('ticket');
    
    const opt = {
        margin: [0.15, 0.15, 0.15, 0.15],     // Very tight margins
        filename: 'Bus_Ticket.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { 
            scale: 4,                         // Higher scale = sharper + better fit
            useCORS: true,
            scrollY: 0,
            scrollX: 0
        },
        jsPDF: { 
            unit: 'in', 
            format: [3.9, 5.8],               // Smaller custom size (width x height)
            orientation: 'portrait'
        },
        pagebreak: { mode: ['avoid-all'] }
    };
    
    html2pdf().set(opt).from(element).save();
}
</script>

</body>
</html>