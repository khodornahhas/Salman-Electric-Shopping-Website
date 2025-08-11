<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderNotificationMail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                    ->with(['orderItems.product'])
                    ->latest()
                    ->get();

        return view('profile.orders', compact('orders'));
    }

    public function placeOrder(Request $request)
    {
        $order = Order::create([
            'user_id' => Auth::id(),
        ]);

        Mail::to(Auth::user()->email)->send(new OrderConfirmationMail($order));

        Mail::to(config('mail.owner_email'))->send(new OrderNotificationMail($order));

        return redirect()->route('order.success')->with('message', 'Order placed successfully!');
    }
}
