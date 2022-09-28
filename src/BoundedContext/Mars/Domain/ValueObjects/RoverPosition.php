<?php

namespace Src\BoundedContext\Mars\Domain\ValueObjects;

use Src\BoundedContext\Mars\Domain\Map;
use InvalidArgumentException;

final class RoverPosition
{
    private $x;
    private $y;
    private $map;

    public function __construct(int $x, int $y)
    {
        $this->map = new Map();
        $this->validate($x, $y);
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

    /**
     * @param int $id
     * @throws InvalidArgumentException
     */
    private function validate(int $x, int $y): void
    {
        if ($x<0 || $x>=$this->map->size_x()) {
            throw new InvalidArgumentException(
                sprintf('Position x=<%s> has to be a value beetwen 0 and <%s>.', $x, $this->map->size_x())
            );
        }
        if ($y<0 || $y>=$this->map->size_y()) {
            throw new InvalidArgumentException(
                sprintf('Position y=<%s> has to be a value beetwen 0 and <%s>.', $y, $this->map->size_y())
            );
        }
    }
    
}
