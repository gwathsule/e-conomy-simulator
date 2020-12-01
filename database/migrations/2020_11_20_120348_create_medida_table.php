<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medida', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_evento')->nullable();
            $table->string('nome')->nullable();
            $table->string('rodadas_para_excutar')->nullable();
            $table->string('url_imagem')->nullable();
            $table->string('tipo')->nullable();
            $table->text('texto_noticia')->nullable();
            $table->decimal('diferenca_financas')->nullable();
            $table->integer('diferenca_popularidade_empresarios')->nullable();
            $table->integer('diferenca_popularidade_trabalhadores')->nullable();
            $table->integer('diferenca_popularidade_estado')->nullable();
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
        Schema::dropIfExists('medida');
    }
}
