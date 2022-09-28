<?php

namespace Src\BoundedContext\Mars\Domain\Exceptions;

use Exception;

class ObstacleException extends Exception
{
    public function __construct()
    {
        parent::__construct();
    }
}