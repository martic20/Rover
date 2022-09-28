<?php

namespace Src\BoundedContext\Mars\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Src\BoundedContext\Mars\Application\GetRoverUseCase;
use Src\BoundedContext\Mars\Application\MoveRoverUseCase;
use Src\BoundedContext\Mars\Infrastructure\Repositories\EloquentRoverRepository;
use Src\BoundedContext\Mars\Domain\Exceptions\ObstacleException;

final class MoveRoverController
{
    private $repository;

    public function __construct(EloquentRoverRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $getRoverUseCase = new GetRoverUseCase($this->repository);
        $rover = $getRoverUseCase->__invoke();
        if ($rover == null){
            return response()->json(['info'=>'Not initialized'], 422);
        }

        if (!$request->filled('commands')) return response()->json(
            ['error' => "Get parameter commands needed"]
            , 422);

        $commandsTxt = $request->input('commands');
        
        try {
            $moveRoverUseCase = new MoveRoverUseCase($this->repository);
            $moveRoverUseCase->__invoke(
                $rover,
                $commandsTxt
            );
                      
        } catch (\InvalidArgumentException $e) {
            return response()->json(['info'=>'Invalid data value','error' => $e->getMessage()], 422);
        } catch (ObstacleException $e) {
            return response()->json([
                'info'=>'Obstacle detected, so sequence aborted. Could not finish the command movements.',
                'rover'=> $rover->toArray()
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['info'=>'Error'], 422);
        }  catch (\TypeError $e) {
            return response()->json(['info'=>'Wrong data format','error' => $e->getMessage()], 422);
        }

        return response()->json(['info'=>'Ok','rover'=> $rover->toArray()], 200);
    }
}
