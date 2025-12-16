<?php

namespace Modules\Student\Actions\Api;

use Modules\Client\Entities\Student;

class SocialLoginAction
{
    public function handle(string $provider, string $providerId, string $email, string $first_name, string $last_name, ?string $birth_date, int $gender)
    {
        $user = Student::where('provider', $provider)->where('provider_id', $providerId)->first();

        if ($user) {
            return [$user,  $user->createToken('tokens')->plainTextToken];
        }

        $user = Student::where('email', $email)->first();

        if (! $user) {
            $user = Student::create([
                'email' => $email,
                'first_name'  => $first_name,
                'last_name'  => $last_name,
                'email_verified_at' => now(),
                'birth_date' => $birth_date,
                'gender' => $gender,
                'password' => bcrypt((string) rand(1, 10000)),
            ]);
        }

        $user->update([
            'provider_id' => $providerId,
            'provider' => $provider,
        ]);

        return [$user,  $user->createToken('tokens')->plainTextToken];
    }
}
