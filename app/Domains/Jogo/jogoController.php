<?php

namespace App\Domains\Jogo;

use App\Domains\Jogo\Services\CriarNovoJogo;
use App\Http\Controllers\Controller;
use App\Support\Exceptions\InternalErrorException;
use App\Support\Exceptions\ValidationException;
use Exception;
use Illuminate\Http\Request;

class jogoController extends Controller
{
    public function novoJogo(Request $request)
    {
        try {
            /** @var CriarNovoJogo $servico */
            $servico = app()->make(CriarNovoJogo::class);
            /** @var Jogo $game */
            $jogo = $servico->handle($request->toArray());
            return back()->with([
                'jogo' => $jogo
            ]);
        }catch (ValidationException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (Exception $ex){
            return $this->returnWithException(new InternalErrorException(__('internal-error')));
        }
    }
}
