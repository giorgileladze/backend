<?php

namespace api\core\coreIntefaces;

interface RegisteredRoutesInteface
{
    public function call_starter_function(array $request) : array;

    public function request_method_validator (string $request_method, string $request_uri) : void;
}