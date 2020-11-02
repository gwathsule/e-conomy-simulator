<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRodadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rodada', function (Blueprint $table) {
            $table->id();
            $table->json('medidas')->nullable();
            $table->json('noticias')->nullable();
            $table->unsignedInteger('rodada')->nullable();
            $table->integer('populacao')->nullable();
            $table->decimal('pmgc', 2, 2)->nullable();
            $table->decimal('pib_previsao_anual', 2, 2)->nullable();
            $table->decimal('imposto_renda', 2, 2)->nullable();
            $table->decimal('total_investimentos_anual', 13, 2, true)->nullable();
            $table->decimal('investimentos_mesal', 13, 2, true)->nullable();
            $table->decimal('total_gastos_governamentais_anual', 13, 2, true)->nullable();
            $table->decimal('gastos_governamentais_mensal', 13, 2, true)->nullable();
            $table->decimal('total_transferencias_anual', 13, 2, true)->nullable();
            $table->unsignedBigInteger('jogo_id');
            $table->foreign('jogo_id')
                ->references('id')
                ->on('jogo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rodada');
    }
}
