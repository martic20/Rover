<?php

namespace Src\BoundedContext\Mars\Domain;

use Src\BoundedContext\Mars\Domain\ValueObjects\RoverId;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverDirection;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverPosition;

final class Rover
{
    private $id;
    private $direction;
    private $position;

    public function __construct(
        RoverDirection $direction,
        RoverPosition $position
    )
    {
        $this->direction = $direction;
        $this->position = $position;
    }

    public function id(): RoverId
    {
        return $this->id;
    }

    public function direction(): RoverDirection
    {
        return $this->direction;
    }

    public function position(): RoverPosition
    {
        return $this->position;
    }

    public static function create(
        RoverDirection $direction,
        RoverPosition $position        
    ): Rover
    {
        $rover = new self($direction, $position);

        return $rover;
    }
}
