<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NotActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!is_null($request->user())) {
            if ($request->user()->is_active == false && $request->user()->status == "active") {
                return sendError(__("messages.acc_is_deactivated"), [], 401);
            }
        }
        return $next($request);
    }
}
