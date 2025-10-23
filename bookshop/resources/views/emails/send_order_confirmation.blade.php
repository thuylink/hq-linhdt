<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Order Confirmation</h1>

    <p>Hello {{ $user->name }},</p>

    <p>Thank you for your order! Below is information about your order:</p>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalAmount = 0;
            @endphp

            @foreach ($orderItems as $item)
                @php
                    $itemTotal = $item->quantity * $item->price;
                    $totalAmount += $itemTotal;
                @endphp
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
                    <td>{{ number_format($itemTotal, 0, ',', '.') }} VND</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Total: {{ number_format($totalAmount, 0, ',', '.') }} VND</p>
    <p>Thank you for shopping with us!</p>

</body>

</html>
