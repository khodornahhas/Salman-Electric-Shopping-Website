<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Thank you for your order, {{ $order->first_name }}!</h1>

    <p>We have received your order with the following details:</p>

    <ul>
        <li><strong>Order ID:</strong> {{ $order->id }}</li>
        <li><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</li>
        <li><strong>Email:</strong> {{ $order->email }}</li>
        <li><strong>Phone:</strong> {{ $order->phone }}</li>
        <li><strong>Shipping Address:</strong> 
            {{ $order->street }}, {{ $order->apartment }}, {{ $order->city }}
        </li>
        <li><strong>Shipping Cost:</strong> ${{ number_format($order->shipping, 2) }}</li>
        <li><strong>Order Items:</strong>
            <ul>
                @foreach($order->orderItems as $item)
                    <li>
                        {{ $item->product->name }} x{{ $item->quantity }} — 
                        ${{ number_format($item->price, 2) }}
                    </li>
                @endforeach
            </ul>
        </li>
        <li><strong>Total:</strong> ${{ number_format($order->total, 2) }}</li>
    </ul>

    @if($order->promo_code_id)
        <p style="color:green; font-weight:bold;">
            Promo code applied: {{ $order->promoCode->code }} — 
            {{ $order->promoCode->discount_percent }}% off
        </p>
    @endif

    <p>We will contact you shortly to confirm your order status.</p>

    <p>Thank you for shopping with us!</p>
</body>
</html>
