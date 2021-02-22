<?php

namespace App\Domains\Rodada;

use App\Domains\Jogo\Jogo;
use App\Domains\Rodada\Services\CriarNovaRodada;
use App\Domains\User\User;
use App\Http\Controllers\Controller;
use App\Support\Exceptions\UserException;
use App\Support\Exceptions\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RodadaApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function criarNovaRodada()
    {
        try {
            /** @var CriarNovaRodada $servico */
            $servico = app()->make(CriarNovaRodada::class);
            /** @var Jogo $jogo */
            $jogo = $servico->handle(request()->toArray());
            return $jogo->toArray();
        }catch (ValidationException $ex){
            return response()->json(['error' => $ex->getErrors()], 400);
        }catch (UserException $ex){
            return response()->json(['error' => $ex->getUserMessage()], 400);
        }catch (\Exception $ex){
            return response()->json(['error' => __('user-messages.internal-error')], 500);
        }
    }
}