<?php

namespace App\Domains\Medida;

use App\Domains\Medida\Services\CriarMedida;
use App\Http\Controllers\Controller;
use App\Support\Exceptions\InternalErrorException;
use App\Support\Exceptions\ValidationException;
use Illuminate\Http\Request;

class MedidaController extends Controller
{
    public function novaMedida(Request $request)
    {
        try {
            $dataService = $request->toArray();
            /** @var CriarMedida $servico */
            $servico = app()->make(CriarMedida::class);
            $servico->handle($dataService);
            return route('admin.home');
        }catch (ValidationException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (\Exception $ex){
            return $this->returnWithException(new InternalErrorException(__('internal-error')));
        }
    }

    public function editarMedida(Request $request)
    {
        try {
            $dataService = $request->toArray();
            /** @var CriarMedida $servico */
            $servico = app()->make(CriarMedida::class);
            $servico->handle($dataService);
            return route('admin.home');
        }catch (ValidationException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (\Exception $ex){
            return $this->returnWithException(new InternalErrorException(__('internal-error')));
        }
    }

    public function deletarMedida($id)
    {
        /** @var Medida $medida */
        $medida = Medida::query()->find($id);
        if(is_null($medida)) {
            return route('admin.home');
        }
        if(! $medida->delete()) {
            return $this->returnWithException(new InternalErrorException(__('Erro ao deletar')))->withInput();
        }
        return route('admin.home');
    }

    public function novaMedidaPage()
    {
        return view('admin.criarMedida');
    }

    public function editarMedidaPage()
    {
        return view('admin.editarMedida');
    }
}