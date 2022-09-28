<?php

namespace Src\BoundedContext\Mars\Domain;

/**
 * The map grid is a 200x200 2D matrix where the corners (x,y) are:
 *      (0,0) -> Bottom - Left
 *      (199,0) -> Bottom - Right
 *      (0,199) -> Top - Left
 *      (199,199) -> Top - Right
 */
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

    public function isInside(int $x, int $y): bool
    {
        if($x<0) return false;
        if($x>=$this->size_x) return false;
        if($y<0) return false;
        if($y>=$this->size_y) return false;

        return true;
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
