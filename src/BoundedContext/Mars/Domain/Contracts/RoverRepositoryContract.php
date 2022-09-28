<?php

namespace Src\BoundedContext\Mars\Domain\Contracts;

use Src\BoundedContext\Mars\Domain\Rover;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverId;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverPosition;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverDirection;

interface RoverRepositoryContract
{
    public function get(): ?Rover;

    public function getId(): ?RoverId;

    public function save(Rover $rover): void;

    public function update(RoverId $roverId, Rover $rover): void;
}
