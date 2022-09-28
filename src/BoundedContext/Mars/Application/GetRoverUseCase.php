<?php

namespace Src\BoundedContext\Mars\Application;

use Src\BoundedContext\Mars\Domain\Contracts\RoverRepositoryContract;
use Src\BoundedContext\Mars\Domain\Rover;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverId;

final class GetRoverUseCase
{
    private $repository;
    
    //by default we always use the same Rover, so we don't need to store than one.
    private $roverId = 1; 

    public function __construct(RoverRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): Rover
    {
        $id = new RoverId($this->roverId);

        $rover = $this->repository->find($id);

        return $rover;
    }
}
