<?php

namespace App\Utils;

class Response
{
    public static function success($data = null, $message = 'success')
    {
        return response()->json([
            'status' => true,
            'result' => [
                'message' => $message,
                'data' => $data
            ]
        ], 200);
    }

    public static function error($data = null, $message = 'error')
    {
        return response()->json([
            'status' => false,
            'result' => [
                'message' => $message,
                'data' => $data
            ]
        ], 400);
    }
}
