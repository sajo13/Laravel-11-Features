<?php

namespace App\Http\Controllers;

use App\Services\ApiRequestService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $apiRequestService;

    // Inject the ApiRequestService into the controller
    public function __construct(ApiRequestService $apiRequestService)
    {
        $this->apiRequestService = $apiRequestService;
    }

    // Method to test API requests with different users and tokens
    public function testApiRequest(Request $request)
    {
        // Define the API URL
        $apiUrl = "http://laravel-11.test/api/user";

        // Test for free plan user (replace token with actual free user token)
        $freeUserToken = '21sW4T2IeuheGTMSR013EZmndST15IMo0g@eg0Tdp1884fb974';
        $responseFreeUser = $this->apiRequestService->makeApiRequest($apiUrl, $freeUserToken, 12);

        // Test for paid plan user (replace token with actual paid user token)
        $paidUserToken = '1|DBdpWLq20Lq5InhVTUkn7o1tAZXUthviiYeSgR8W168d1db2';
        $responsePaidUser = $this->apiRequestService->makeApiRequest($apiUrl, $paidUserToken, 12);

        // Test for unauthorized user (without token)
        $unauthorizedToken = '';
        $responseUnauthorized = $this->apiRequestService->makeApiRequest($apiUrl, $unauthorizedToken);

        // Return the responses as JSON
        return response()->json([
            'free_user_response' => $responseFreeUser,
            'paid_user_response' => $responsePaidUser,
            'unauthorized_response' => $responseUnauthorized,
        ]);
    }
}
