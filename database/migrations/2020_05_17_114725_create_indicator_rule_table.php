<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicatorRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicator_rule', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 50)
                ->nullable();
            $table->string('indicator', 50)
                ->nullable();
            $table->string('condition', 50)
                ->nullable();
            $table->string('value', 50)
                ->nullable();
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
        Schema::dropIfExists('indicator_rule');
    }
}
