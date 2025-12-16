<?php

namespace App\Rules;

use Auth;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniquqIban implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $userExists = DB::table('users')
        ->where('iban', $value)
        ->exists();

    // Check in join_requests table
    $joinRequestExists = DB::table('join_requests')
        ->where('iban', $value)
        ->exists();

    // Return false if the number exists in either table
    return !$userExists && !$joinRequestExists;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('The organization iban has already been taken.');
    }
}
