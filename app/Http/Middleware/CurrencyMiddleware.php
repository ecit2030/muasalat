<?php

namespace App\Http\Middleware;

use App\Models\Currency;
use Closure;

class CurrencyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Schema::hasTable('migrations')) {
            config()->set('app.timezone', data_get(setting('info'), 'timezone', 'Asia/Riyadh'));
            date_default_timezone_set(data_get(setting('info'), 'timezone', 'Asia/Riyadh'));
        }

        $currency = auth(activeGuard())->user()?->info?->currency;

        if ($request->wantsJson() && $request->header('Currency-Code')) {
            $currency = Currency::where('code', $request->header('Currency-Code'))->firstOrFail();
        }

        session()->put([
            'currency.code' => data_get($currency, 'code', 'SAR'),
            'currency.title' => data_get($currency, 'title', 'SAR'),
            'currency.exchange' => data_get($currency, 'direction', 1),
        ]);

        return $next($request);
    }
}
