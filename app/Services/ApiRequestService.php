<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiRequestService
{
    /**
     * Make an API request with a given token and return the response.
     *
     * @param string $url The API endpoint URL.
     * @param string $token The Bearer token for authentication.
     * @param int $iterations Number of times the request should be sent (optional).
     * @return array The response from the API.
     */
    public function makeApiRequest(string $url, string $token, int $iterations = 1): array
    {
        $response = [];

        for ($i = 0; $i < $iterations; $i++) {
            // Make the request with the token header
            $response[] = $this->sendRequest($url, $token);
        }

        return $response;
    }

    /**
     * Sends a single API request.
     *
     * @param string $url The API endpoint URL.
     * @param string $token The Bearer token for authentication.
     * @return array The response from the API.
     */
    protected function sendRequest(string $url, string $token): array
    {
        // Send GET request to the API with the provided Bearer token
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->get($url);

        // Return the response as an array with status and body
        return [
            'status' => $response->status(),
            'body' => $response->json(),
        ];
    }
}
