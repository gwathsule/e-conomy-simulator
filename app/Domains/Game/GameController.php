<?php

namespace App\Domains\Game;

use App\Domains\Game\Services\CreateNewGame;
use App\Domains\Timeline\Timeline;
use App\Http\Controllers\Controller;
use App\Support\Exceptions\InternalErrorException;
use App\Support\Exceptions\ValidationException;
use Exception;
use Illuminate\Http\Request;

class GameController extends Controller
{
    //create a new game
    public function newGame(Request $request)
    {
        try {
            /** @var CreateNewGame $service */
            $service = app()->make(CreateNewGame::class);
            /** @var Game $game */
            $game = $service->handle($request->toArray());
            /** @var Timeline $timeLine */
            $timeLine = $game->getRound(0);
            return back()->with([
                'game' => $game,
                'timeline' => $timeLine,
            ]);
        }catch (ValidationException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (Exception $ex){
            return $this->returnWithException(new InternalErrorException(__('internal-error')));
        }
    }
}
