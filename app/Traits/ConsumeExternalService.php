<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait ConsumeExternalService
{
    /**
     * Send a GET request to any service
     */
    public function request(string $requestUrl, array $params = [], array $headers = []): string
    {
        $response = Http::retry(3, 1000)
            ->withQueryParameters($params)
            ->withHeaders($headers)
            ->asJson()
            ->get($requestUrl);
        if ($response->failed()) {
            throw new \Exception($response->body());
        }

        return $response->body();
    }
}
