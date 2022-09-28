<?php

namespace Src\BoundedContext\Mars\Domain;

use Src\BoundedContext\Mars\Domain\ValueObjects\RoverId;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverDirection;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverPosition;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverCommand;
use Src\BoundedContext\Mars\Domain\Map;

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

    public function toArray()
    {
        return [
            'direction' => $this->direction()->value(), 
            'position_x' => $this->position()->x(),
            'position_y' => $this->position()->y()
        ];
    }

    /**
     * The map grid is a 200x200 2D matrix where the corners (x,y) are:
     *      (0,0) -> Bottom - Left
     *      (199,0) -> Bottom - Right
     *      (0,199) -> Top - Left
     *      (199,199) -> Top - Right
     */
    public function move(RoverCommand $command): Rover
    {
        $mappings = [ //helper array to define the new position and direction
            'N' => [  //if you're facing North
                'F' => [ //and you move forward
                    'D' => 'N',  //you stay facing North
                    'P' => [0,1] //and your position is the result of adding this to your current position
                ],                
                'L' => [
                    'D' => 'W',
                    'P' => [-1,0]
                ],
                'R' => [
                    'D' => 'E',
                    'P' => [1,0]
                ]
            ],
            'W' => [ 
                'F' => [
                    'D' => 'W',  
                    'P' => [-1,0] 
                ],                
                'L' => [
                    'D' => 'S',
                    'P' => [0,-1]
                ],
                'R' => [
                    'D' => 'N',
                    'P' => [0,1]
                ]
            ],
            'S' => [ 
                'F' => [
                    'D' => 'S',  
                    'P' => [0,-1] 
                ],                
                'L' => [
                    'D' => 'E',
                    'P' => [1,0]
                ],
                'R' => [
                    'D' => 'W',
                    'P' => [-1,0]
                ]
            ],
            'E' => [ 
                'F' => [
                    'D' => 'E',  
                    'P' => [1,0] 
                ],                
                'L' => [
                    'D' => 'N',
                    'P' => [0,1]
                ],
                'R' => [
                    'D' => 'S',
                    'P' => [0,-1]
                ]
            ]
        ];
        
        //get the new direction rover is facing from the mappings array
        $oldDirection = $this->direction()->value();

        $newDirection = $mappings[$oldDirection][$command->value()]['D'];
        $newX = $mappings[$oldDirection][$command->value()]['P'][0] + $this->position()->x();
        $newY = $mappings[$oldDirection][$command->value()]['P'][1] + $this->position()->y();

        //check if new point is inside map. Validation done inside RoverPosition
        // any problem here will throw an exception
        $this->direction()->set($newDirection);
        $this->position()->set($newX,$newY);

        return $this;
    }
}
