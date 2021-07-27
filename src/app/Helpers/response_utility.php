<?php
if (!function_exists('responseSuccess')) {
    function responseSuccess($data = null, $message = "Request processed successfully", $code = 200)
    {
        $response = [
            'success' => true,
            'code' => $code,
            'message' => $message
        ];

        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response, 200);
    }
}

if (!function_exists('responseCreated')) {
    function responseCreated($data = null, $message = null, $code = 201)
    {
        $response = [
            'success' => true,
            'code' => $code,
            'message' => $message?:'Record created successfully'
        ];
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response, 201);
    }
}

if (!function_exists('responseNoContent')) {
    function responseNoContent($message = "There is no data found", $code=404)
    {
        $response = [
            'success' => false,
            'code' => $code,
            'message' => $message
        ];

        return response()->json($response, 200);
    }
}

if (!function_exists('responseFaild')) {
    function responseFaild($message = 'Failed to process', $code=400)
    {
        $response = [
            'success' => false,
            'code' => $code,
            'message' =>  $message
        ];
        return response()->json($response, 400);
    }
}

if (!function_exists('responseInternalServerError')) {
    function responseInternalServerError($message = 'Internal server error', $code=500)
    {
        $response = [
            'success' => false,
            'code' => $code,
            'message' =>  $message
        ];
        return response()->json($response, 500);
    }
}


if (!function_exists('responseDeleted')) {
    function responseDeleted($message = 'Record deleted successfully', $code=200)
    {
        $response = [
            'success' => true,
            'code' => $code,
            'message' => $message
        ];
        return response()->json($response, 200);
    }
}

if (!function_exists('responseValidationError')) {
    function responseValidationError($data = null, $message = 'Please check input fields.', $code= 400)
    {
        $response = [
            'success' => false,
            'code' => $code,
            'message' => $message
        ];
        if ($data) {
            $response['data'] = $data;
        }

        return response()->json($response, 400);
    }
}

if (!function_exists('responseExist')) {
    function responseExist($message = "The record is already exist", $code=409)
    {
        $response = [
            'success' => false,
            'code' => $code,
            'message' => $message
        ];

        return response()->json($response, 409);
    }
}

if (!function_exists('responseUnauthorized')) {
    function responseUnauthorized($message = 'Unauthorized', $code=401)
    {
        $response = [
            'success' => false,
            'code' => $code,
            'message' => $message
        ];
        return response()->json($response, 401);
    }
}

