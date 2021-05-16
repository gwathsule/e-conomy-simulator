<?php

namespace App\Domains\Rodada;

use App\Domains\Rodada\Services\CriarNovaRodada;
use App\Http\Controllers\Controller;
use App\Support\Exceptions\InternalErrorException;
use App\Support\Exceptions\UserException;
use App\Support\Exceptions\ValidationException;

class RodadaController extends Controller
{
    public function criarNovaRodada(int $jogoId, int $medidaId)
    {
        if($medidaId == -1) {
            $medidaId = null;
        }
        try {
            /** @var CriarNovaRodada $servico */
            $servico = app()->make(CriarNovaRodada::class);
            $servico->handle([
                'jogo_id' => $jogoId,
                'medida_id' => $medidaId,
            ]);
            return redirect()->route('user.home');
        }catch (ValidationException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (UserException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (\Exception $ex){
            return $this->returnWithException(new InternalErrorException(__('user-messages.internal-error')))->withInput();
        }
    }
}
