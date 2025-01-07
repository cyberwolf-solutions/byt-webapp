<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details, .footer {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Invoice</h1>
        <p>Invoice Number: {{ $invoiceNumber }}</p>
        <p>Date: {{ $date }}</p>
    </div>

    <div class="details">
        <h3>Event Details</h3>
        <table>
            <tr>
                <th>Title</th>
                <td>{{ $event->title }}</td>
            </tr>
            <tr>
                <th>Start Date</th>
                <td>{{ $event->start }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $event->status }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Thank you for your business!</p>
    </div>
</body>
</html>
