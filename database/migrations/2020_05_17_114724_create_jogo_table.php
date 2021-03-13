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
            $table->string('ministro')->nullable();
            $table->char('genero')->nullable();
            $table->tinyInteger('personagem')->nullable();
            $table->string('moeda')->nullable();
            $table->boolean('ativo')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('qtd_rodadas')->nullable();
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
        Schema::dropIfExists('jogo');
    }
}
