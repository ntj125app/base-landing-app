<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Turnstile
{
    /**
     * Verify challenge response.
     */
    protected function verifyChallenge(string $value): bool
    {
        $response = Http::asForm()->post(config('challenge.url'), [
            'secret' => config('challenge.site_secret'),
            'response' => $value,
        ]);

        return $response->json()['success'];
    }

    /**
     * Verify challenge response.
     */
    protected function verifyMobileChallenge(string $value): bool
    {
        $response = Http::asForm()->post(config('challenge.url'), [
            'secret' => config('challenge.site_secret_mobile'),
            'response' => $value,
        ]);

        return $response->json()['success'];
    }
}
