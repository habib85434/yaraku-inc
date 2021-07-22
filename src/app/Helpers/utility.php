<?php

use Illuminate\Support\Facades\Hash;

if (!function_exists('getDataType')) {
    function getDataType($data, $columnName = null)
    {
        if (is_array($data) || is_object(json_decode($data))) {
            return 'json';
        } elseif (preg_match('/\d{4}-\d{2}-\d{2} - \d{4}-\d{2}-\d{2}/', $data)) {
            return 'string';
        } elseif (date_parse($data)['year'] && date_parse($data)['month']
            && date_parse($data)['error_count'] == 0
            && date_parse($data)['warning_count'] == 0
            && !is_numeric($data)) {
            return 'dateTime';
        } elseif (is_numeric($data)) {
            if ((int)$data == $data && !preg_match('/\D/', $data) && $columnName == 'id') {
                return 'bigInteger';
            } elseif (is_float($data)) {
                return 'double';
            }
        }
        return 'text';
    }
}
if (!function_exists('startsWith')) {
    function startsWith($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }
}

if (!function_exists('sanitizeColumn')) {
    function sanitizeColumn($value)
    {
        return preg_replace('/[^a-z0-9_]/', '_', strtolower(trim($value)));
    }
}

if (!function_exists('generateToken')) {
    function generateToken($id)
    {
        $today = date('Y-d-m H:i:s');
        //return Hash::make($today.$id);
        $stOne = md5($today.$id);
        return md5($stOne);
    }
}
if (!function_exists('generateRegistrationToken')) {
    function generateRegistrationToken($email)
    {
        $today = date('Y-d-m H:i:s');
        //return Hash::make($today.$id);
        $stOne = md5($today.$email);
        return md5($stOne);
    }
}

