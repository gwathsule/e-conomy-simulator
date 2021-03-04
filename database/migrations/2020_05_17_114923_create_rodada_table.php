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

            $table->decimal('pib_investimento_potencial', 13, 3)->nullable();
            $table->decimal('gastos_governamentais', 13, 3)->nullable();
            $table->decimal('transferencias', 13, 3)->nullable();
            $table->decimal('taxa_base_de_juros', 4, 3)->nullable();
            $table->decimal('efmk', 4, 3)->nullable();
            $table->decimal('inflacao_de_demanda', 4, 3)->nullable();
            $table->decimal('inflacao_de_custo', 4, 3)->nullable();
            $table->decimal('inflacao_total', 4, 3)->nullable();
            $table->decimal('pmgc', 4, 3)->nullable();
            $table->decimal('imposto_renda', 4, 3)->nullable();

            $table->integer('popularidade_empresarios')->nullable();
            $table->integer('popularidade_trabalhadores')->nullable();
            $table->integer('popularidade_estado')->nullable();
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
