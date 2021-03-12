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
            $table->unsignedInteger('medida_id')->nullable();
            $table->json('noticias')->nullable();
            $table->unsignedInteger('rodada')->nullable();

            $table->decimal('pib_investimento_potencial', 13, 2)->nullable();
            $table->decimal('gastos_governamentais', 13, 2)->nullable();
            $table->decimal('transferencias', 13, 2)->nullable();
            $table->decimal('taxa_de_juros_base', 5, 4)->nullable();
            $table->decimal('inflacao_de_demanda', 5, 4)->nullable();
            $table->decimal('inflacao_de_custo', 5, 4)->nullable();
            $table->decimal('inflacao_total', 5, 4)->nullable();
            $table->decimal('pmgc', 5, 4)->nullable();
            $table->decimal('imposto_de_renda', 5, 4)->nullable();
            $table->decimal('pib', 13, 2)->nullable();
            $table->decimal('previsao_anual', 13, 2)->nullable();
            $table->decimal('yd', 13, 2)->nullable();
            $table->decimal('pib_consumo', 13, 2)->nullable();
            $table->decimal('pib_investimento_realizado', 13, 2)->nullable();
            $table->decimal('impostos', 13, 2)->nullable();
            $table->decimal('bs', 13, 2)->nullable();
            $table->decimal('efmk', 5, 4)->nullable();
            $table->decimal('titulos', 13, 2)->nullable();
            $table->decimal('juros_divida_interna', 13, 2)->nullable();
            $table->decimal('caixa', 13, 2)->nullable();
            $table->decimal('divida_total', 13, 2)->nullable();
            $table->decimal('investimento_em_titulos', 5, 4)->nullable();
            $table->decimal('desemprego', 5, 4)->nullable();
            $table->decimal('k', 5, 4)->nullable();
            $table->decimal('k_com_imposto', 5, 4)->nullable();

            $table->decimal('popularidade_empresarios')->nullable();
            $table->decimal('popularidade_trabalhadores')->nullable();
            $table->decimal('popularidade_estado')->nullable();
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
