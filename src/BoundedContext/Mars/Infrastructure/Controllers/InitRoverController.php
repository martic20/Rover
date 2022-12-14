<?php

namespace Src\BoundedContext\Mars\Infrastructure\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Src\BoundedContext\Mars\Application\InitRoverUseCase;
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
        $direction = $request->input('direction');
        $positionX = $request->input('position_x');
        $positionY = $request->input('position_y'); 

        $initRoverUseCase = new InitRoverUseCase($this->repository);

        try {
            $initRoverUseCase->__invoke(
                $direction,
                $positionX,
                $positionY
            );            
        } catch (\InvalidArgumentException $e) {
            return response()->json(['info'=>'Invalid data value','error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['info'=>'Error','error' => 'Internal error'], 422);
        } catch (\TypeError $e) {
            return response()->json(['info'=>'Wrong data format','error' => $e->getMessage()], 422);
        }

        return response()->json(['info'=>'Ok'], 200);
    }
}
