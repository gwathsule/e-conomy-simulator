<?php

namespace App\Domains\Jogo;

use App\Domains\Jogo\Services\CreateNewGame;
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
            /** @var Jogo $game */
            $game = $service->handle($request->toArray());
            return back()->with([
                'game' => $game
            ]);
        }catch (ValidationException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (Exception $ex){
            return $this->returnWithException(new InternalErrorException(__('internal-error')));
        }
    }
}
