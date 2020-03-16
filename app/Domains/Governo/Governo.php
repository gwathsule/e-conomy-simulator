<?php

namespace App\Domains\Governo;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int        $id
 * @property float      $gasto
 * @property float      $receita
 * @property float      $imposto_renda
 * @property float      $taxa_juros
 * @property float      $taxa_deposito_compulsorio
 * @property float      $salario_minimo
 */
class Governo extends Model
{
    protected $table = 'governo';
    public $timestamps = false;
}