<?php

namespace Src\BoundedContext\Mars\Application;

use Src\BoundedContext\Mars\Domain\Contracts\RoverRepositoryContract;
use Src\BoundedContext\Mars\Domain\Rover;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverId;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverDirection;
use Src\BoundedContext\Mars\Domain\ValueObjects\RoverPosition;

final class InitRoverUseCase
{
    private $repository;

    public function __construct(RoverRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $roverDirection,
        int $roverXPosition,
        int $roverYPosition
    ): void
    {
        $direction = new RoverDirection($roverDirection);
        $position = new RoverPosition($roverXPosition,$roverYPosition);

        $rover = Rover::create($direction, $position);
        
        //check if exists
        
        $roverId = $this->repository->getId();
        // try {
        //     $user= User::FindOrFail($id);
        //     return response()->json(['user'=>user], 200);
        // } catch (\Exception $e) {
        //     return response()->json(['message'=>'user not found!'], 404);
        // }

        // print_r($dbRover);
        if ($roverId != null){
            $this->repository->update($roverId, $rover);
        }else{
            $this->repository->save($rover);
        }
    }
}
