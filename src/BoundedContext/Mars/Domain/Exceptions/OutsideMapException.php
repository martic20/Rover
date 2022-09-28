<?php

namespace Src\BoundedContext\Mars\Domain\Exceptions;

use Exception;

class OutsideMapException extends ObstacleException
{
    public function __construct()
    {
        parent::__construct();
    }
}