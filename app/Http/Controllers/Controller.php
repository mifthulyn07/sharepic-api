<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function successResp($message = null, $data = null)
    {
        if (!$data) {
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public function errorResp($message = null, $code = 422)
    {
        return response()->json([
            'status' => false,
            'errors' => $message
        ], $code);
    }
}
