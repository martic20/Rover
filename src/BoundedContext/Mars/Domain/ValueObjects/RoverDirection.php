<?php

namespace Src\BoundedContext\Mars\Domain\ValueObjects;

use InvalidArgumentException;

final class RoverDirection
{
    private $direction;

    public function __construct(string $direction)
    {
        $this->validate($direction);
        $this->direction = $direction;
    }

    public function value(): string
    {
        return $this->direction;
    }

    /**
     * @param int $id
     * @throws InvalidArgumentException
     */
    private function validate(string $direction): void
    {
        $valid_options = ['N','S','E','W'];

        if (!in_array($direction,$valid_options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $direction)
            );
        }
    }
}
