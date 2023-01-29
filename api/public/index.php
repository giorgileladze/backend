<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Content-Type");

require_once __DIR__.'/../vendor/autoload.php';

use api\core\Request;
use api\core\Api;

$request = Request::get_request_info();

$src = new Api($request);
$response = $src->hendle();

$src->send($response);
