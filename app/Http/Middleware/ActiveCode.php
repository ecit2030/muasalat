<?php

namespace App\Http\Middleware;

use App\Models\Otp;
use App\Support\Api\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class ActiveCode
{
    use ApiResponse;

    protected SessionManager $session;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $checkActivation = $this->activationCode($request);
        RateLimiter::hit($this->throttleKey(), 6000);
        if (! $checkActivation) {
            $this->body['actionUrl'] = $request->getUri();
            $this->body['method'] = $request->method();
            self::apiMessage(__('please enter valid activation code'));

            return $request->expectsJson()
                    ? self::apiResponse()
                    : (new Response(view('frontend.activation-code', ['actionUrl' => $request->getUri(), 'method' => $request->method()])));
        }
        Otp::firstWhere(['phone' => request('phone'), 'code' => request('code')])?->delete();

        return $next($request);
    }

    public function throttleKey()
    {
        return Str::lower(session('activation.code'));
    }

    private function activationCode(Request $request)
    {
        $otp = Otp::firstWhere(['phone' => request('phone'),
            'code' => request('code'),
        ]);
        return (int) request('code', '1') === (int) $otp?->code;
    }
}
