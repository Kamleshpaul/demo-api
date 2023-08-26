<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success(mixed $data, $message = 'Success'): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], 200);
    }

    public static function failed($message = 'No result Found'): JsonResponse
    {
        return response()->json([
            'data' => [],
            'message' => $message,
        ], 200);
    }
}
