<?php

namespace Src\BoundedContext\Mars\Domain\ValueObjects;

final class RoverPosition
{
    private $x;
    private $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function value(): array
    {
        return [$this->x,$this->y];
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }
    
}
