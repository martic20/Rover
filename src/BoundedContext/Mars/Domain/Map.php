<?php

namespace Src\BoundedContext\Mars\Domain;

final class Map
{
    
    private $size_x;
    private $size_y;

    //by default the size is 200x200
    public function __construct(
        int $size_x = 200,
        int $size_y = 200
    )
    {
        $this->size_x = $size_x;
        $this->size_y = $size_y;
    }

    public function size_x(): int
    {
        return $this->size_x;
    }

    public function size_y(): int
    {
        return $this->size_y;
    }

    public static function create(
        int $size_x,
        int $size_y      
    ): Map
    {
        $map = new self($size_x, $size_y);

        return $map;
    }
}
