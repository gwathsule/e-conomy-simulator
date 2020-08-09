<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimelineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instante', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('rodada');
            $table->json('medida')->nullable();
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')
                ->references('id')
                ->on('game');
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
