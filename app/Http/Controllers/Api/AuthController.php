<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param LoginRequest $loginRequest
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $loginRequest)
    {
        if (!auth()->attempt($loginRequest->validated())) {
            return response()->json([
                'data' => [
                    'message' => __('Access denied')
                ]
            ], 422);
        }
        return response()->json([
            'data' => [
                'token' => auth()->user()->createToken('api')->plainTextToken
            ]
        ]);
    }
}
