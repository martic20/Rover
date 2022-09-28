<?php

namespace Src\BoundedContext\Mars\Infrastructure\Repositories;

use Src\BoundedContext\Mars\Infrastructure\Models\EloquentRoverModel as EloquentRoverModel;
use Src\BoundedContext\Mars\Domain\Contracts\RoverRepositoryContract;
use Src\BoundedContext\Mars\Domain\Rover;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverDirection;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverPosition;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverId;

final class EloquentRoverRepository implements RoverRepositoryContract
{
    private $eloquentRoverModel;

    public function __construct()
    {
        $this->eloquentRoverModel = new EloquentRoverModel;
    }

    public function get(): ?Rover
    {
        $rover = $this->eloquentRoverModel->first();

        if($rover==null) return null;

        // Return Domain Rover model
        return new Rover(
            new RoverDirection($rover->direction),
            new RoverPosition($rover->position_x,$rover->position_y),            
        );
    }

    public function getId(): ?RoverId
    {
        $rover = $this->eloquentRoverModel->first();

        if($rover==null) return null;

        return new RoverId($rover->id);
    }

    public function save(Rover $rover): void
    {
        $newRover = $this->eloquentRoverModel;

        $data = [
            'direction' => $rover->direction()->value(),
            'position_x' => $rover->position()->x(),
            'position_y' => $rover->position()->y()           
        ];

        $newRover->create($data);
    }

    public function update(RoverId $id, Rover $rover): void
    {
        $roverToUpdate = $this->eloquentRoverModel;

        $data = [
            'direction' => $rover->direction()->value(),
            'position_x' => $rover->position()->x(),
            'position_y' => $rover->position()->y()   
        ];

        $roverToUpdate
            ->findOrFail($id->value())
            ->update($data);
    }
}
