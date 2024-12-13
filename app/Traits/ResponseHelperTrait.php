<?php

namespace App\Traits;

trait ResponseHelperTrait
{
    public function response($statusCode, $data, $message)
    {
        return response()->json([
            'status' => $statusCode,
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }
}
