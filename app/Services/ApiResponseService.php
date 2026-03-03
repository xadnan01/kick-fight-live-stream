<?php

namespace App\Services;

class ApiResponseService
{
    /**
     * Success Response
     */
    public static function success($message = 'Success', $data = [], $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $status);
    }

    /**
     * Error Response
     */
    public static function error($message = 'Error', $errors = [], $status = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors'  => $errors,
        ], $status);
    }
}
