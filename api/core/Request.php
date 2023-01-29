<?php

namespace api\core;
class Request {
    public static function get_request_info() :array {
        $method = $_SERVER["REQUEST_METHOD"];
        $uri = $_SERVER["REQUEST_URI"];

        $data =  json_decode(file_get_contents('php://input'), true);
        if($data == null) $data = [];

        return [
            "method" => $method,
            "URI" => $uri,
            "data" => $data,
        ];
    }
}