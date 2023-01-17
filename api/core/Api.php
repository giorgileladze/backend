<?php

namespace api\core;

use api\core\coreIntefaces\ApiInteface;

class Api implements ApiInteface {

    public function __construct(private array $request)
    {
        $this->hendle_preflight_request();
    }
    public function hendle () : array {

        $uri = $this->request["URI"];
        if(RegisteredRoutes::is_allowed_URI($uri)) {
            return RegisteredRoutes::call_starter_function($this->request);
        } else {
            header("HTTP/1.0 404 Not Found");
            return [
                "message" => "404 Not Found"
            ];
        }
    }

    public function send (array $response) : void {
        echo json_encode($response);
    }

    private function hendle_preflight_request(){
        if($this->request["method"] === "OPTIONS" ){
            header("HTTP/1.0 200 OK");
            exit();
        }
    }
}