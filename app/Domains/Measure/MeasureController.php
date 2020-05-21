<?php

namespace App\Domains\Measure;

use App\Domains\Game\Game;
use App\Domains\Measure\Services\CalcularRecolhimentoCompulsorio;
use App\Http\Controllers\Controller;
use App\Support\Exceptions\InternalErrorException;
use App\Support\Exceptions\ValidationException;
use Exception;
use Illuminate\Http\Request;

class MeasureController extends Controller
{
    public function calcularRecolhimentoCompulsorio(Request $request)
    {
        try {
            /** @var CalcularRecolhimentoCompulsorio $service */
            $service = app()->make(CalcularRecolhimentoCompulsorio::class);
            /** @var Game $game */
            $game = $service->handle($request->toArray());
            return back()->with([
                'game' => $game
            ]);
        }catch (ValidationException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (Exception $ex){
            dd($ex);
            return $this->returnWithException(new InternalErrorException(__('internal-error')));
        }
    }
}
