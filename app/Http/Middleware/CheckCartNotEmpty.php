<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\CartItem;

class CheckCartNotEmpty
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $hasItems = CartItem::where('user_id', Auth::id())->exists();
        } else {
            $cart = session('cart', []);
            $hasItems = !empty($cart);
        }

        if (!$hasItems) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Please add items before proceeding.');
        }

        $response = $next($request);

        if ($response instanceof \Illuminate\Http\Response 
            && strpos($response->headers->get('Content-Type'), 'text/html') !== false) {
            
            $content = $response->getContent();
            $debugMessage = "console.log('CheckCartNotEmpty hasItems: " . ($hasItems ? 'true' : 'false') . "');";

            $content = str_ireplace('</body>', "<script>$debugMessage</script></body>", $content);
            $response->setContent($content);
        }

        return $response;
    }
}
