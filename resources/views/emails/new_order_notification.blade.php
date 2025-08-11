<!DOCTYPE html>
<html>
<head>
    <title>New Order Received</title>
</head>
<body>
    <h1>New Order Alert!</h1>

    <p>A new order has just been placed by {{ $order->first_name }} {{ $order->last_name }}.</p>

    <p>Order details:</p>
    <ul>
        <li><strong>Order ID:</strong> {{ $order->id }}</li>
        <li><strong>Email:</strong> {{ $order->email }}</li>
        <li><strong>Phone:</strong> {{ $order->phone }}</li>
        <li><strong>Shipping Address:</strong> 
            {{ $order->street }}, {{ $order->apartment }}, {{ $order->city }}
        </li>
        <li><strong>Total:</strong> ${{ number_format($order->total, 2) }}</li>
        <li><strong>Status:</strong> {{ $order->status }}</li>
    </ul>

    <p>Check the admin panel for more details.</p>
</body>
</html>
