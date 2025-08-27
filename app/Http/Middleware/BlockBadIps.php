<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\BlockedIp; 

class BlockBadIps
{
    public function handle(Request $request, Closure $next)
    {
        if (BlockedIp::where('ip_address', $request->ip())->exists()) {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
