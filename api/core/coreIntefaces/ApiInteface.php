<?php

namespace api\core\coreIntefaces;

interface ApiInteface
{
    public function hendle() : array;

    public function send(array $response);

}