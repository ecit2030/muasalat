<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends DashboardController
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function loginForm()
    {
        return view('dashboard.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Dashboard\Auth\LoginRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doLogin(LoginRequest $request)
    {
        $request->session()->invalidate();

        $request->authenticate();
        $request->session()->regenerateToken();

        return redirect()->intended(route('dashboard.home'));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        auth(activeGuard())->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin');
    }
}
