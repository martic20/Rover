<?php

namespace Src\BoundedContext\Mars\Domain\ValueObjects;

use InvalidArgumentException;

final class RoverCommand
{
    private $command;

    public function __construct(string $command)
    {
        $this->validate($command);
        $this->command = $command;
    }

    public function value(): string
    {
        return $this->command;
    }

    /**
     * @param int $id
     * @throws InvalidArgumentException
     */
    private function validate(string $command): void
    {
        $valid_options = ['F','R','L'];

        if (!in_array($command,$valid_options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $command)
            );
        }
    }
}
