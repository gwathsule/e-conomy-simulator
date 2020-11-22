<?php

namespace App\Domains\Medida\Services;

use App\Domains\Medida\Medida;
use App\Domains\Medida\MedidaRepository;
use App\Support\Service;
use App\Support\Validator;
use Illuminate\Contracts\Filesystem\Factory;

class CriarMedida extends Service
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
                    'codigo_evento' => ['required', 'max:255'],
                    'nome' => ['required', 'max:255'],
                    'rodadas_para_excutar' => ['required', 'max:255'],
                    'imagem,' => ['required'],
                    'tipo' => ['required', 'max:255'],
                    'texto_noticia' => ['required'],
                ];
            }
        })->validate($data);
    }

    protected function perform(array $data, array $columns = ['*'], array $relations = [])
    {
        $medida = new Medida();
        $medida->codigo_evento = $data['codigo_evento'];
        $medida->nome = $data['nome'];
        $medida->rodadas_para_excutar = $data['rodadas_para_excutar'];
        $medida->tipo = $data['tipo'];
        $medida->texto_noticia = $data['texto_noticia'];
        //$medida->url_imagem = $data['imagem'];
        $medida->save();
        return $medida;
    }
}