<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChiefGearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chief__gears', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('Tier')->nullable();
            $table->string('Stars')->nullable();
            $table->string('Hardened_Alloy')->nullable();
            $table->string('Polishing_Solution')->nullable();
            $table->string('Design_Plans')->nullable();
            $table->string('Lunar_Amber')->nullable();
            $table->string('Power')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chief__gears');
    }
}
