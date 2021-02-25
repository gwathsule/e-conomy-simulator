<?php

namespace App\Domains\Jogo;

use App\Domains\Jogo\Services\CriarNovoJogo;
use App\Domains\User\User;
use App\Http\Controllers\Controller;
use App\Support\Exceptions\ValidationException;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class JogoApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function novoJogo()
    {
        try {
            $dataService = json_decode(request()->getContent(), true);
            if($dataService['genero'] == 'M') {
                $dataService['personagem'] = $dataService['index_pm'];
            } else {
                $dataService['personagem'] = $dataService['index_pf'] + 5;
            }
            /** @var CriarNovoJogo $servico */
            $servico = app()->make(CriarNovoJogo::class);
            /** @var Jogo $game */
            $jogo = $servico->handle($dataService);
            return response()->json($jogo);
        }catch (ValidationException $ex){
            return response()->json(['error' => $ex->getErrors()], 400);
        }catch (Exception $ex){
            return response()->json(['error' => __('user-messages.internal-error')], 500);
        }
    }

    public function getJogo()
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Jogo $jogo */
        $jogo = $user->getJogoAtivo();
        if($jogo === null) {
            return response()->json([
                'jogo' => null
            ]);
        }
        return response()->json($jogo->toArray());
    }
}