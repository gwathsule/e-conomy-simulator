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
        Schema::create('timeline', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('round');
            $table->decimal('pib');
            $table->decimal('unemployment_tax');
            $table->decimal('inflation');
            $table->string('measure_code')->nullable();
            $table->string('measure_value')->nullable();
            $table->boolean('decision_choice')->nullable();

            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')
                ->references('id')
                ->on('game');

            $table->unsignedInteger('decision_id')->nullable();
            $table->foreign('decision_id')
                ->references('id')
                ->on('decision');

            $table->unsignedInteger('news_id')->nullable();
            $table->foreign('news_id')
                ->references('id')
                ->on('news');

            $table->unsignedInteger('crisis_id')->nullable();
            $table->foreign('crisis_id')
                ->references('id')
                ->on('crisis');

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
