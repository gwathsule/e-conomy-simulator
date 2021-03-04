<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultadoAnualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultado_anual', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('ano')->nullable();
            $table->decimal('pib', 13, 3)->nullable();
            $table->decimal('previsao_anual', 4, 3)->nullable();
            $table->decimal('yd', 13, 3)->nullable();
            $table->decimal('pib_consumo', 13, 3)->nullable();
            $table->decimal('pib_investimento_potencial', 13, 3)->nullable();
            $table->decimal('pib_investimento_realizado', 13, 3)->nullable();
            $table->decimal('gastos_governamentais', 13, 3)->nullable();
            $table->decimal('transferencias', 13, 3)->nullable();
            $table->decimal('impostos', 13, 3)->nullable();
            $table->decimal('bs', 13, 3)->nullable();
            $table->decimal('titulos', 13, 3)->nullable();
            $table->decimal('juros_divida_interna', 13, 3)->nullable();
            $table->decimal('caixa', 13, 3)->nullable();
            $table->decimal('divida_total', 13, 3)->nullable();
            $table->decimal('taxa_de_juros_base', 4, 3)->nullable();
            $table->decimal('efmk', 4, 3)->nullable();
            $table->decimal('investimento_em_titulos', 4, 3)->nullable();
            $table->decimal('inflacao_total', 4, 3)->nullable();
            $table->decimal('inflacao_de_custo', 4, 3)->nullable();
            $table->decimal('inflacao_de_demanda', 4, 3)->nullable();
            $table->decimal('desemprego', 4, 3)->nullable();
            $table->decimal('pmgc', 4, 3)->nullable();
            $table->decimal('k', 4, 3)->nullable();
            $table->decimal('imposto_de_renda', 4, 3)->nullable();
            $table->decimal('k_com_imposto', 4, 3)->nullable();
            $table->unsignedBigInteger('jogo_id');
            $table->foreign('jogo_id')
                ->references('id')
                ->on('jogo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultado_anual');
    }
}
