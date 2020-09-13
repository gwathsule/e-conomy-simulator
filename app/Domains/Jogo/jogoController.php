<?php

namespace App\Domains\Jogo;

use App\Domains\Jogo\Services\CriarNovoJogo;
use App\Domains\User\User;
use App\Http\Controllers\Controller;
use App\Support\Exceptions\InternalErrorException;
use App\Support\Exceptions\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class jogoController extends Controller
{
    public function novoJogo(Request $request)
    {
        try {
            $dataService = $request->toArray();
            if($dataService['genero'] == 'M') {
                $dataService['personagem'] = $dataService['index_pm'];
            } else {
                $dataService['personagem'] = $dataService['index_pf'] + 5;
            }
            /** @var CriarNovoJogo $servico */
            $servico = app()->make(CriarNovoJogo::class);
            /** @var Jogo $game */
            $jogo = $servico->handle($dataService);
            return back()->with([
                'jogo' => $jogo
            ]);
        }catch (ValidationException $ex){
            dd($ex->getMessage());
            return $this->returnWithException($ex)->withInput();
        }catch (Exception $ex){
            dd($ex->getMessage());
            return $this->returnWithException(new InternalErrorException(__('internal-error')));
        }
    }

    public function perfilJogoPage()
    {
        /** @var User $user */
        $user = Auth::user();
        $jogo = $user->getJogoAtivo();
        if(is_null($jogo)) {
            return view('game.novoJogo');
        } else {
            return view('game.perfil')->with([
                'jogo' => $jogo,
                'user' => $user,
            ]);
        }
    }

}
