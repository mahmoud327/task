<?php

if (!function_exists('sendJsonError')) {
    /**
     * @param $result
     * @param $message
     */
    function sendJsonError($errorMessages, $code = 200)
    {
        $response = [
            'success' => false,
            'message' => $errorMessages,
            'data' => null,
        ];

        return response()->json($response, $code);
    }
}
if (!function_exists('sendJsonResponse')) {
    /**
     * @param $result
     * @param $message
     */
    function sendJsonResponse($result, $message = '')
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }
}

///////////// active menu function //////////////
if(! function_exists('active_menu'))
{
    function active_menu($link)
    {
        if(preg_match('/' .$link. '/', Request::segment(2)))
        {
            return ['active', 'display:block'];
        }else
        {
            return ['', '' ];
        }

    }
}
