<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed</title>

    {{-- Include your CSS --}}
    <link rel="stylesheet" href="{{ URL::to('public/assets/web/css/appointment/appoint-style.css') }}">
    <link rel="stylesheet" href="{{ URL::to('public/assets/web/css/appointment/appoint-responsive.css') }}">

    {{-- Google Fonts (optional) --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Optional: Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f8fc;
            margin: 0;
            padding: 0;
        }

        .success-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .success-card {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            text-align: center;
            max-width: 500px;
            width: 100%;
            animation: fadeIn 0.7s ease-in-out;
        }

        .success-icon {
            color: #28a745;
            font-size: 60px;
            margin-bottom: 20px;
        }

        .success-message {
            font-size: 26px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .booking-id {
            font-size: 18px;
            color: #4a5568;
            margin-bottom: 25px;
        }

        .back-home {
            display: inline-block;
            padding: 12px 24px;
            background-color: #007bff;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .back-home:hover {
            background-color: #0056b3;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .redirect-msg {
            margin-top: 15px;
            font-size: 14px;
            color: #6b7280;
        }

        #countdown {
            font-weight: 600;
            color: #007bff;
            transition: opacity 0.3s ease;
        }
    </style>
</head>
<body>

    <div class="success-wrapper">
        <div class="success-card">
            <i class="fas fa-check-circle success-icon"></i>
            <p class="success-message">Payment Successful!</p>
            <p class="booking-id">Your Transaction ID: <strong>{{ $order_id }}</strong></p>
            <a href="{{ url('/') }}" class="back-home">Back to Home</a>
            <p class="redirect-msg">
                You’ll be redirected in <span id="countdown">7</span> seconds...
            </p>
        </div>
    </div>

    <script>
        let timeLeft = 7;
        const countdownEl = document.getElementById('countdown');

        const interval = setInterval(() => {
            timeLeft--;
            if (timeLeft <= 0) {
                clearInterval(interval);
                window.location.href = "{{ url('/') }}";
            } else {
                countdownEl.textContent = timeLeft;
                countdownEl.style.opacity = countdownEl.style.opacity === '1' ? '0.3' : '1'; // blinking
            }
        }, 1000);
    </script>
</body>
</html>
