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
            $table->string('resumo')->nullable();
            $table->boolean('medida_imediata')->nullable();
            $table->string('url_imagem')->nullable();
            $table->string('tipo_noticia')->nullable();
            $table->text('texto_noticia')->nullable();
            $table->text('titulo_noticia')->nullable();
            $table->decimal('diferenca_financas', 13, 3)->nullable();
            $table->decimal('diferenca_popularidade_empresarios', 4, 3)->nullable();
            $table->decimal('diferenca_popularidade_trabalhadores', 4, 3)->nullable();
            $table->decimal('diferenca_popularidade_estado', 4, 3)->nullable();
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
