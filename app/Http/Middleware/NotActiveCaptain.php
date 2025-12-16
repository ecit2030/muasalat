<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class NotActiveCaptain
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!is_null($request->user())) {
            if ($request->user()->is_active == false) {
                return abort(401);
            }
            if (!$request->user()->hasRole("captain")) {
                return abort(403);
            }
        }
        return $next($request);
//        $user = User::findOrFail(request("captainRequest")) ;
//        if ($user->is_active == false && $user->hasRole("captain"))
//            return $next($request);
//        else
//            return abort(403);
    }
}
