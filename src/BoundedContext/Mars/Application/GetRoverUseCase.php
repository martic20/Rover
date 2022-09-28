<?php

namespace Src\BoundedContext\Mars\Application;

use Src\BoundedContext\Mars\Domain\Contracts\RoverRepositoryContract;
use Src\BoundedContext\Mars\Domain\Rover;

final class GetRoverUseCase
{
    private $repository;
    private $rover;

    public function __construct(RoverRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): ?Rover
    {        
        return $this->repository->get();
    }

}
