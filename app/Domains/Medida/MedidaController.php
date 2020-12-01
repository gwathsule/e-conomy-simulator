<?php

namespace App\Domains\Medida;

use App\Domains\Medida\Services\CriarMedida;
use App\Http\Controllers\Controller;
use App\Support\Exceptions\InternalErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator as CoreValidator;
use Illuminate\Validation\ValidationException as CoreValidationException;
use App\Support\Exceptions\ValidationException;

class MedidaController extends Controller
{
    public function novaMedida(Request $request)
    {
        try {
            $validator = CoreValidator::make(
                $request->toArray(),
                [
                    'codigo_evento' => ['required', 'max:255'],
                    'nome' => ['required', 'max:255'],
                    'rodadas_para_excutar' => ['required', 'max:255'],
                    'imagem_noticia' => ['required'],
                    'tipo' => ['required', 'max:255'],
                    'texto_noticia' => ['required'],
                ]
            );
            $validator->validate();
            $medida = new Medida();
            $medida->codigo_evento = $request['codigo_evento'];
            $medida->nome = $request['nome'];
            $medida->rodadas_para_excutar = $request['rodadas_para_excutar'];
            $medida->tipo = $request['tipo'];
            $medida->texto_noticia = $request['texto_noticia'];
            $medida->diferenca_popularidade_empresarios = $request['popularidade_empresarios'];
            $medida->diferenca_popularidade_trabalhadores = $request['popularidade_trabalhadores'];
            $medida->diferenca_popularidade_estado = $request['popularidade_estado'];
            $medida->save();
            $path = Storage::disk('public')->put('medidas/' . $medida->id, $request->file('imagem_noticia'));
            $medida->url_imagem = $path;
            $medida->update();

            return redirect()->route('admin.home');
        }catch (CoreValidationException $e){
            return $this->returnWithException(new ValidationException($e->errors(), $e->getMessage()))->withInput();
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
        Storage::delete($medida->url_imagem);
        if(! $medida->delete()) {
            return $this->returnWithException(new InternalErrorException(__('Erro ao deletar')))->withInput();
        }
        return redirect()->route('admin.home');
    }

    public function novaMedidaPage()
    {
        return view('admin.criarMedida');
    }

    public function editarMedidaPage($id)
    {
        $medida = Medida::query()->find($id);
        if(is_null($medida)) {
            return route('admin.home');
        }
        return view('admin.editarMedida')->with(['medida' => $medida]);
    }
}