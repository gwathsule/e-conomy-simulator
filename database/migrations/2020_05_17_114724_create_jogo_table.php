<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJogoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jogo', function (Blueprint $table) {
            $table->id();
            $table->string('pais')->nullable();
            $table->string('presidente')->nullable();
            $table->string('ministro')->nullable();
            $table->char('genero')->nullable();
            $table->tinyInteger('personagem')->nullable();
            $table->string('moeda')->nullable();
            $table->string('descricao')->nullable();
            $table->boolean('ativo')->nullable();
            $table->integer('rodadas')->nullable();
            $table->integer('populacao')->nullable();
            $table->decimal('pib_prox_ano', 4, 4, true)->nullable();
            $table->decimal('pib', 13, 2, true)->nullable();
            $table->decimal('pib_consumo', 13, 2, true)->nullable();
            $table->decimal('pib_investimento', 13, 2, true)->nullable();
            // user relation
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('user');
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
        Schema::dropIfExists('game');
    }
}
