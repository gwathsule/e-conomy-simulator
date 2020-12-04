<?php

namespace App\Domains\Medida;

use App\Support\Repository;

class MedidaRepository extends Repository
{
    public function getModel(): string
    {
        return Medida::class;
    }

    public function getTiposDeNoticias() : array
    {
        return Medida::TIPOS_NOTICIA;
    }

    public function getAllMedidas() : array
    {
        return Medida::all();
    }
}