<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Order</title>
</head>
<body>
    <p>A new order has just been placed by {{ $order->first_name }} {{ $order->last_name }}.</p>

    <p><strong>Order details:</strong></p>
    <p>Order ID: {{ $order->id }}</p>
    <p>Email: {{ $order->email }}</p>
    <p>Phone: {{ $order->phone }}</p>
    <p>Shipping Address: {{ $order->address }}</p>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price (per unit)</th>
                <th>Promo Applied</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>
                        @php
                          $appliedPromo = $item->product->promocodes->where('id', $item->promo_code_id)->first();

                        @endphp

                        @if ($appliedPromo)
                            {{ $appliedPromo->code }}
                        @else
                            —
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
    <p><strong>Status:</strong> {{ $order->status }}</p>

    <p>Check the admin panel for more details.</p>
</body>
</html>