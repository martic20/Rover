<?php

namespace Src\BoundedContext\Mars\Application;

use Src\BoundedContext\Mars\Domain\Contracts\RoverRepositoryContract;
use Src\BoundedContext\Mars\Domain\Rover;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverId;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverDirection;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverPosition;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverCommand;

final class MoveRoverUseCase
{
    private $repository;
    private $rover;

    public function __construct(RoverRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        Rover $rover,
        string $commandsTxt
    ): void
    {
        if(strlen($commandsTxt)==0) throw new \Exception('Commands expected');

        $this->rover = $rover;
        $commands = [];
        foreach(str_split($commandsTxt) as $cmd){
            $command = new RoverCommand($cmd);
            $this->rover->move($command);

            $roverId = $this->repository->getId();
            $this->repository->update($roverId, $rover);
        } 
    }
}
