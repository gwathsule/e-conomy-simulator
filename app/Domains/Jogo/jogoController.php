<?php

namespace App\Domains\Jogo;

use App\Domains\Jogo\Services\AlterarJogo;
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
            return view('game.home')->with([
                'jogo' => $jogo
            ]);
        }catch (ValidationException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (Exception $ex){
            return $this->returnWithException(new InternalErrorException(__('user-messages.internal-error')))->withInput();
        }
    }

    public function alterarJogo(Request $request)
    {
        try {
            $dataService = $request->toArray();
            /** @var User $user */
            $user = Auth::user();
            $jogo = $user->getJogoAtivo();
            $dataService['id'] = $jogo->id;
            if($dataService['genero'] == 'M') {
                $dataService['personagem'] = $dataService['index_pm'];
            } else {
                $dataService['personagem'] = $dataService['index_pf'] + 5;
            }
            /** @var CriarNovoJogo $servico */
            $servico = app()->make(AlterarJogo::class);
            /** @var Jogo $game */
            $jogo = $servico->handle($dataService);
            return view('game.perfil')->with([
                'jogo' => $jogo,
            ]);
        }catch (ValidationException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (Exception $ex) {
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

    public function alterarJogoPage()
    {
        /** @var User $user */
        $user = Auth::user();
        $user->jogos->toArray();
        $jogo = $user->getJogoAtivo();
        if(is_null($jogo)) {
            return view('game.novoJogo');
        } else {
            return view('game.alterarJogo')->with([
                'jogo' => $jogo,
                'user' => $user,
            ]);
        }
    }

    public function novoJogoPage()
    {
        return view('game.novoJogo');
    }

    public function relatoriosMensaisPage()
    {
        /** @var User $user */
        $user = Auth::user();
        if(is_null($user->getJogoAtivo())) {
            return view('game.novoJogo');
        } else {
            return view('game.relatorios-mensais')->with([
                'jogo' => $user->getJogoAtivo()
            ]);
        }
    }

    public function relatoriosAnuaisPage()
    {
        /** @var User $user */
        $user = Auth::user();
        if(is_null($user->getJogoAtivo())) {
            return view('game.novoJogo');
        } else {
            return view('game.relatorios-anuais')->with([
                'jogo' => $user->getJogoAtivo()
            ]);
        }
    }
}
