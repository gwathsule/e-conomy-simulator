<?php

namespace App\Domains\Medida\Services;

use App\Domains\Medida\MedidaRepository;
use App\Domains\Rodada\Rodada;
use App\Support\Service;
use App\Support\Validator;
use Exception;
use Illuminate\Contracts\Filesystem\Factory;

class ExecutarMedida extends Service
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
                    'medida_id' => ['required', 'int'],
                    'jogo_id' => ['required', 'int'],
                ];
            }
        })->validate($data);
    }

    protected function perform(array $data, array $columns = ['*'], array $relations = [])
    {
        //pega o jogo
    }


}