<?php

namespace Src\BoundedContext\Mars\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Src\BoundedContext\Mars\Application\GetRoverUseCase;
use Src\BoundedContext\Mars\Infrastructure\Repositories\EloquentRoverRepository;
use App\Http\Controllers\Controller;

final class GetRoverController extends Controller
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
            return response()->json(['info'=>'Not initialized'], 200);
        }

        return response()->json(['info'=>'Ok','rover'=> $rover->toArray()], 200);
    }
}
