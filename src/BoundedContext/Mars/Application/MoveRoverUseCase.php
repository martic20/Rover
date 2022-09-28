<?php

namespace Src\BoundedContext\Mars\Application;

use Src\BoundedContext\Mars\Domain\Contracts\RoverRepositoryContract;
use Src\BoundedContext\Mars\Domain\Rover;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverId;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverDirection;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverPosition;

final class MoveRoverUseCase
{
    private $repository;

    public function __construct(RoverRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $roverId,
        string $roverDirection,
        int $roverXPosition,
        int $roverYPosition
    ): void
    {
        $id = new RoverId($roverId);
        $direction = new RoverDirection($roverDirection);
        $position = new RoverPosition($roverXPosition,$roverYPosition);

        $rover = Rover::create($direction, $position);

        $this->repository->update($id, $rover);
    }
}
