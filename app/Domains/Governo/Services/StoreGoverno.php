<?php

namespace App\Domains\Governo\Services;

use App\Domains\Governo\Governo;
use App\Domains\Governo\GovernoRepository;
use App\Domains\Governo\Validators\StoreGovernoValidator;
use App\Support\Service;

class StoreGoverno extends Service
{
    /** @var  GovernoRepository*/
    private $repository;

    public function __construct()
    {
        $this->repository = new GovernoRepository();
    }

    public function validate(array $data)
    {
        return (new StoreGovernoValidator())->validate($data);
    }

    public function perform(array $data, array $columns = ['*'], array $relations = [])
    {
        /** @var Governo $governo */
        $governo = new Governo();
        $governo->gasto = $data['gasto'];
        $governo->receita = $data['receita'];
        $governo->imposto_renda = $data['imposto_renda'];
        $governo->taxa_juros = $data['taxa_juros'];
        $governo->taxa_deposito_compulsorio = $data['taxa_deposito_compulsorio'];
        $governo->salario_minimo = $data['salario_minimo'];
        $this->repository->save($governo);
        return $governo;
    }
}