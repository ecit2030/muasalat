<?php

namespace App\Http\Requests\Api\Auth;

use App\Support\Traits\ValidationRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            'email' => ['string', 'email:dns'],
            'phone' => ['exists:users,phone','phone:AUTO,SA', 'numeric'],
            'password' => ['required', Password::min(8)->letters()->numbers()],
            'device_token' => 'nullable|string|max:1000',
        ];
    }

    public function messagesAction()
    {
        return [
            'password.min:8' => t_('the password field must not be less than 8 characters.'),
            'password.regex' => t_('the password field must consist of 8 digits starting with a capital letter and at least one number.'),
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::guard('frontend')->attempt($this->credentials(), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => t_('These credentials do not match our records.'),
            ]);
        }
        throw_if(
            ! auth('frontend')->check(),
            AuthorizationException::class
        );
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => t_('too many login attempts from this ip address :ip . Please try again in {:minutes} minutes and {:seconds} seconds.', [
                'ip' => $this->ip(),
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }

    protected function credentials(): array
    {
        if (is_numeric($this->phone)) {
            return ['phone' => $this->phone, 'password' => $this->password];
        }
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return ['email' => $this->email, 'password' => $this->password];
        }
    }
}
