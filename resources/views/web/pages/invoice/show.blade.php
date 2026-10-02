<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            padding: 2rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .invoice-box {
            background: #ffffff;
            padding: 3rem 2.5rem;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            max-width: 900px;
            margin: auto;
            color: #212529;
        }
        .invoice-header {
            border-bottom: 2px solid #dee2e6;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
        }
        .invoice-header img {
            max-height: 60px;
        }
        .invoice-title {
            font-size: 1.8rem;
            font-weight: 600;
        }
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #495057;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        .info-group p {
            margin: 0.25rem 0;
        }
        .amount-label {
            font-weight: 500;
        }
        .total-box {
            font-size: 1.5rem;
            font-weight: 700;
            color: #198754;
            margin-top: 2rem;
            border-top: 2px dashed #dee2e6;
            padding-top: 1rem;
            text-align: right;
        }
        .btn-download {
            margin-bottom: 2rem;
        }
        @media print {
            .btn-download {
                display: none !important;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Download/Print Button -->
    <div class="text-end btn-download">
        <button class="btn btn-outline-primary" onclick="window.print()">
            ⬇ Download / Print Invoice
        </button>
    </div>

    <!-- Invoice Container -->
    <div class="invoice-box">
        <!-- Header -->
        <div class="invoice-header d-flex justify-content-between align-items-center">
            <img src="https://royneurocare.com/paralysis/res-logo.png" alt="Clinic Logo">
            <div class="text-end">
                <div class="invoice-title">Invoice</div>
                <div class="text-muted">Invoice #{{ $order->id }}</div>
                <small>{{ \Carbon\Carbon::now()->format('d M Y, h:i A') }}</small>
            </div>
        </div>

        <!-- Patient Info -->
        <div>
            <div class="section-title">Patient Information</div>
            <div class="row info-group">
                <div class="col-md-6">
                    <p><span class="amount-label">Name:</span> {{ $order->first_name }} {{ $order->last_name }}</p>
                    <p><span class="amount-label">Mobile:</span> {{ $order->mobile_no }}</p>
                </div>
                <div class="col-md-6">
                    <p><span class="amount-label">Booking Date:</span>
                        {{ $order->booking_date ? \Carbon\Carbon::parse($order->booking_date)->format('d M Y') : 'N/A' }}
                    </p>
                    @if($order->from_time || $order->to_time)
                        <p><span class="amount-label">Time Slot:</span>
                            {{ $order->from_time ?? '' }} - {{ $order->to_time ?? '' }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Payment Info -->
        <div>
            <div class="section-title">Payment Details</div>
            <div class="row info-group">
                <div class="col-md-6">
                    <p><span class="amount-label">Actual Amount:</span> ₹{{ number_format($order->actual_amount, 2) }}</p>
                    <p><span class="amount-label">Paid Amount:</span> ₹{{ number_format($order->total_amount, 2) }}</p>
                </div>
                <div class="col-md-6">
                    <p><span class="amount-label">Payment ID:</span> {{ $order->razorpay_payment_id }}</p>
                    <p><span class="amount-label">Transaction ID:</span> {{ $order->transaction_id }}</p>
                </div>
            </div>
        </div>

        <!-- Total -->
        <div class="total-box">
            Total Paid: ₹{{ number_format($order->total_amount, 2) }}
        </div>
    </div>
</div>

</body>
</html>
