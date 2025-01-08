@extends('layouts.master-without-nav')

@section('title')
    Invoice
@endsection

@section('content')
    <style>
        body {
            background-color: #FFF !important;
            font-family: Arial, sans-serif;
        }

        .invoice-container {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            font-size: 24px;
            font-weight: bold;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice-details h6 {
            margin: 0;
            font-weight: bold;
        }

        .customer-info {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .table {
            border: 1px solid #ccc;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .table th, .table td {
            text-align: center;
            border: 1px solid #ccc;
        }

        .table th {
            background-color: #e6e6e6;
            font-weight: bold;
        }

        .invoice-footer {
            text-align: right;
            font-weight: bold;
        }
    </style>

    <div class="container-fluid invoice-container">
        <div class="invoice-header">
            <img src="{{ asset('storage/' . $settings->logo_dark) }}" alt="Logo" class="img-fluid" width="100">
            <h1>INVOICE</h1>
        </div>

        <div class="invoice-details">
            <div>
                <h6>Invoice #:</h6>
                <span>#{{ $data->id }}</span>
            </div>
            <div>
                <h6>Date:</h6>
                <span>{{ \Carbon\Carbon::parse($data->created_at)->format($settings->date_format) }}</span>
            </div>
        </div>

        <div class="customer-info">
            <h6>Event Details:</h6>
            @if ($event)
                <div style="margin-top: 20px">
                    <p><strong style="width: 130px; display: inline-block;">Event Name</strong> {{ $event->title }}</p>
                    <p style="margin-top: -15px"><strong style="width: 130px; display: inline-block;">Customer</strong> {{ $event->customer }}</p>
                    <p style="margin-top: -15px"><strong style="width: 130px; display: inline-block;">Lecturer</strong> {{ $event->lecturer }}</p>
                    <p style="margin-top: -15px"><strong style="width: 130px; display: inline-block;">Start</strong> {{ \Carbon\Carbon::parse($event->start)->format('d-m-Y') }}</p>
                    <p style="margin-top: -15px"><strong style="width: 130px; display: inline-block;">End</strong> {{ \Carbon\Carbon::parse($event->end)->format('d-m-Y') }}</p>
                </div>
            @else
                <p>No event details found.</p>
            @endif
        </div>
        

        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Fee</th>
                    <th>Hours</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $settings->currency }} {{ number_format($data->fee, 2) }}</td>
                    <td>{{ $data->hours }}</td>
                    <td>{{ $settings->currency }} {{ number_format($data->fee, 2) }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right;">Sub Total</td>
                    <td>{{ $settings->currency }} {{ number_format($data->fee, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;">Tax</td>
                    <td>{{ $settings->currency }} 0.00</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Total</strong></td>
                    <td><strong>{{ $settings->currency }} {{ number_format($data->fee, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            window.print();
        });
    </script>
@endsection
