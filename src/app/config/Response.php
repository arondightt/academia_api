<?php

class Response
{
    public static function send($status, $message, $data = ""): void 
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');

        $body = [
            'status'  => $status,
            'message' => $message
        ];

        if (!empty($data)) {
            $body['data'] = $data;
        }

        echo json_encode($body, JSON_UNESCAPED_UNICODE);
    }

}
