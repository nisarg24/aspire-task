<?php
namespace App\Http\Traits;

trait ResponseTrait {
    
    public function success($message, $data = null)
    {
        return response()->json(
            [
                'status' => 200,
                'message' => $message,
                'data' => $data
            ]
        );
    }

    public function error($status, $message, $data = null)
    {
        return response()->json(
            [
                'status' => $status,
                'message' => $message,
                'data' => $data
            ]
        );
    }
}