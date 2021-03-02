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
            $table->decimal('pib', 13, 2)->nullable();
            $table->decimal('previsão_anual', 2, 2)->nullable();
            $table->decimal('yd', 13, 2)->nullable();
            $table->decimal('pib_consumo', 13, 2)->nullable();
            $table->decimal('pib_investimento_potencial', 13, 2)->nullable();
            $table->decimal('pib_investimento_realizado', 13, 2)->nullable();
            $table->decimal('gastos_governamentais', 13, 2)->nullable();
            $table->decimal('transferências', 13, 2)->nullable();
            $table->decimal('impostos', 13, 2)->nullable();
            $table->decimal('bs', 13, 2)->nullable();
            $table->decimal('títulos', 13, 2)->nullable();
            $table->decimal('juros_dívida_interna', 13, 2)->nullable();
            $table->decimal('caixa', 13, 2)->nullable();
            $table->decimal('dívida_total', 13, 2)->nullable();
            $table->decimal('taxa_de_juros_base', 2, 2)->nullable();
            $table->decimal('efmk', 2, 2)->nullable();
            $table->decimal('investimento_em_títulos', 2, 2)->nullable();
            $table->decimal('inflação_total', 2, 2)->nullable();
            $table->decimal('inflação_de_custo', 2, 2)->nullable();
            $table->decimal('inflação_de_demanda', 2, 2)->nullable();
            $table->decimal('desemprego', 2, 2)->nullable();
            $table->decimal('pmgc', 2, 2)->nullable();
            $table->decimal('k', 2, 2)->nullable();
            $table->decimal('imposto_de_renda', 2, 2)->nullable();
            $table->decimal('k_com_imposto', 2, 2)->nullable();
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
