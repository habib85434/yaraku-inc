<?php
if (!function_exists('responseOk')) {
    function responseOk($data = null, $message = "Request processed successfully")
    {
        $response = [
            'success' => true,
            'message' => $message
        ];

        if ($data) {
            $response = $data;
        }
        return response()->json($response, 200);
    }
}

if (!function_exists('responseCreated')) {
    function responseCreated($data = null, $message = null)
    {
        $response = [
            'success' => true,
            'message' => $message?:'Record created successfully'
        ];
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response, 201);
    }
}

if (!function_exists('responsePatched')) {
    function responsePatched($data = null)
    {
        $response = [
            'success' => true,
            'message' => 'Record patched successfully'
        ];
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response, 200);
    }
}

if (!function_exists('responseDeleted')) {
    function responseDeleted()
    {
        $response = [
            'success' => true,
            'message' => 'Record deleted successfully'
        ];
        return response()->json($response, 200);
    }
}

if (!function_exists('responseCantProcess')) {
    function responseCantProcess(\Throwable $t = null, $message = null)
    {
        if (!$message){
            $message2 = (config('app.debug') && $t ) ? $t->getMessage().'. Location : '.$t->getFile() .' at line : '.$t->getLine() : 'Cannot process request';
        }
        $response = [
            'success' => false,
            'message' =>  'Internal server error'
        ];
        return response()->json($response, 400);
    }
}

if (!function_exists('responseUnauthorized')) {
    function responseUnauthorized()
    {
        $response = [
            'success' => false,
            'message' => 'Unauthorized'
        ];
        return response()->json($response, 401);
    }
}

if (!function_exists('serverError')) {
    function serverError($message = 'Internal server error')
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        return response()->json($response, 500);
    }
}

if (!function_exists('validationError')) {
    function validationError($message = 'Please check input fields.')
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        return response()->json($response, 422);
    }
}

if (!function_exists('validationWithDetailsError')) {
    function validationWithDetailsError( $data = null)
    {
        $response = [
            'success' => false,
            'message' => 'Validation fails. Please check all fields carefully.',
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return response()->json($response, 422);
    }
}

if (!function_exists('responseContactAdmin')) {
    function responseContactAdmin($message)
    {
        $response = [
            'success' => false,
            'message' => $message
        ];
        return response()->json($response, 400);
    }
}

if (!function_exists('authSuccess')) {
    function authSuccess($data = null, $message = "Login processed successfully")
    {
        $response = [
            'success' => true,
            'message' => $message?:'Login processed successfully'
        ];
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response, 202);
    }
}

if (!function_exists('authFail')) {
    function authFail($message = "Incorrect email or password")
    {
        $response = [
            'success' => false,
            'message' => $message?:'Incorrect email or password'
        ];

        return response()->json($response, 203);
    }
}

if (!function_exists('noContent')) {
    function noContent($message = "There is no data found")
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        return response()->json($response, 200);
    }
}

if (!function_exists('alreadyExist')) {
    function alreadyExist($message = "The record is already exist")
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        return response()->json($response, 409);
    }
}


