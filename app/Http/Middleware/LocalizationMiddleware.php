<?php

namespace App\Http\Middleware;

use Closure;
use Modules\Language\Models\Language;

class LocalizationMiddleware
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

        $language = auth(activeGuard())->user()?->info?->language;

        if ($request->wantsJson() && $request->header('Accept-Language')) {
            $language = Language::where('code', $request->header('Accept-Language'))->first();
        }

        session()->put([
            'language.code' => data_get($language, 'code', 'ar'),
            'language.rtl' => data_get($language, 'rtl', true),
            'language.direction' => data_get($language, 'direction', 'rtl'),
        ]);

        app()->setLocale(session('language.code', 'ar'));

        return $next($request);
    }
}
