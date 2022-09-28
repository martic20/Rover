<?php

namespace Src\BoundedContext\Mars\Infrastructure\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Src\BoundedContext\Mars\Application\InitRoverUseCase;
use Src\BoundedContext\Mars\Application\GetRoverUseCase;
use Src\BoundedContext\Mars\Infrastructure\Repositories\EloquentRoverRepository;
use App\Http\Controllers\Controller;

final class InitRoverController extends Controller
{
    private $repository;

    public function __construct(EloquentRoverRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $direction             = $request->input('direction');
        if($direction==null) return response('Direction needs to be specified.', 422);
        $positionX             = $request->input('position_x');
        $positionY             = $request->input('position_y'); 

        // $getRoverUseCase = new GetRoverUseCase($this->repository);
        // $rover = $getRoverUseCase->__invoke();

        $initRoverUseCase = new InitRoverUseCase($this->repository);
        print_r($initRoverUseCase->__invoke(
            $direction,
            $positionX,
            $positionY
        ));
        

        return response('OK', 201);
    }
}
