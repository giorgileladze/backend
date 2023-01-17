<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Content-Type");

include_once "autoloader.php";

use api\core\Api;
use api\core\Request;

$request = Request::get_request_info();

$api = new Api($request);
$response = $api->hendle();

$api->send($response);
