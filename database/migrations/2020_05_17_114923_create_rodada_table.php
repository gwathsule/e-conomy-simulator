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
            $table->decimal('pib_ano_anterior', 13, 2, true)->nullable();
            $table->decimal('consumo', 13, 2, true)->nullable();
            $table->decimal('investimento', 13, 2, true)->nullable();
            $table->decimal('gastos_governamentais', 13, 2, true)->nullable();
            $table->decimal('transferencias', 13, 2, true)->nullable();
            $table->decimal('impostos', 13, 2, true)->nullable();
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
