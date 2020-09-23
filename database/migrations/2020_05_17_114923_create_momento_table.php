<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMomentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('momento', function (Blueprint $table) {
            $table->id();
            $table->json('medidas')->nullable();
            $table->json('noticias')->nullable();
            $table->unsignedInteger('rodada')->nullable();
            $table->decimal('pib_prox_ano', 4, 4, true)->nullable();
            $table->decimal('pib', 13, 2, true)->nullable();
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
        Schema::dropIfExists('timeline');
    }
}
