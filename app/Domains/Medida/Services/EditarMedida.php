<?php

namespace App\Domains\Medida\Services;

use App\Domains\Medida\Medida;
use App\Domains\Medida\MedidaRepository;
use App\Support\Service;
use App\Support\Validator;
use Illuminate\Contracts\Filesystem\Factory;

class EditarMedida extends Service
{
    /**
     * @var MedidaRepository
     */
    private $repository;
    /**
     * @var Factory
     */
    private $storage;

    public function __construct(MedidaRepository $repository, Factory $storage)
    {
        $this->repository = $repository;
        $this->storage = $storage;
    }

    public function validate(array $data)
    {
        return (new class extends Validator {
            public function rules()
            {
                return [
                    'id' => ['required', 'int'],
                    'codigo_evento' => ['required', 'max:255'],
                    'nome' => ['required', 'max:255'],
                    'medida_imediata' => ['required', 'boolean'],
                    'imagem,' => ['required'],
                    'tipo' => ['required', 'max:255'],
                    'texto_noticia' => ['required'],
                ];
            }
        })->validate($data);
    }

    protected function perform(array $data, array $columns = ['*'], array $relations = [])
    {
        $medida = Medida::query()->find($data['id']);
        if(is_null($medida)) {
            throw new \Exception('Usuário não encontrado.');
        }
        $medida->codigo_evento = $data['codigo_evento'];
        $medida->nome = $data['nome'];
        $medida->medida_imediata = $data['medida_imediata'];
        $medida->tipo_noticia = $data['tipo'];
        $medida->texto_noticia = $data['texto_noticia'];
        //$medida->url_imagem = $data['imagem'];
        $medida->update();
        return $medida;
    }
}