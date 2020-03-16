<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('governo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('gasto');
            $table->decimal('receita');
            $table->decimal('imposto_renda');
            $table->decimal('taxa_juros');
            $table->decimal('taxa_deposito_compulsorio');
            $table->decimal('salario_minimo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('governo');
    }
}
